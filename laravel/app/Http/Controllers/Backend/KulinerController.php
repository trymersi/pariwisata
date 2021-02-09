<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostCategory;
use App\Models\ObjekWisata;
use App\Models\Kabupaten;
use App\Models\Label;
use App\Models\LabelMeta;
use App\Models\Kuliner;
use App\Models\KulinerGambar;
use App\Models\Ekraf;
use App\Models\KulinerPenyedia;
use Carbon\Carbon;
use DataTables;
use Toastr;
use File;
use Auth;

class KulinerController extends Controller
{
    private $data;
    private $kulinerClass;
    private $kulinerGambar;
    private $kulinerPenyedia;
    private $kabupatenClass;

    public function __construct()
    {
        $this->middleware('auth');

        $this->kabupatenClass = new Kabupaten;
        $this->kulinerClass = new Kuliner;
        $this->kulinerGambar = new KulinerGambar;
        $this->kulinerPenyedia = new KulinerPenyedia;
      

        $this->data = [
            'category_name' => 'Ekraf',
            'page_name' => 'Kuliner',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'alt_menu' => 1,
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pages.kuliner.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['kabupaten'] = $this->kabupatenClass->orderBy("nama",'desc')->get();
        return view('dashboard.pages.kuliner.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->level == 1 || Auth::user()->level == 4):
            $validator = Validator::make($request->all(), [
                'kabupaten' => 'required',
                'nama'=> 'required',
                'gambar'=> 'required',
                'isi_berita'=> 'required',
                'tos' => 'required',
            ]);
        else:
            $validator = Validator::make($request->all(), [
                'nama'=> 'required',
                'gambar'=> 'required',
                'isi_berita'=> 'required',
                'tos' => 'required',
            ]);
        endif;

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $kab_id = (Auth::user()->level != 7) ? $request->kabupaten : Auth::user()->kabupaten_id;

        $nama_bersih = bersih($request->nama,'-');

        $content = $request->isi_berita;
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $hitungGambar = 1;
        $images = $dom->getElementsByTagName('img');
        foreach($images as $img)
        {
            $src = $img->getAttribute('src');
            if(preg_match('/data:image/', $src))
            {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $filename = $nama_bersih.'_'.$hitungGambar;
                $filepath = public_path('uploads/images/gambar-kuliner').'/'.$filename.'.'.$mimetype;
                $nama = $filename.'.'.$mimetype;
                $image = Image::make($src)
                        ->encode($mimetype, 75)
                        ->save($filepath);
                $truepath = asset('uploads/images/gambar-kuliner').'/'.$filename.'.'.$mimetype;
                $new_src =$truepath;
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }
        }

        if($request->file('gambar'))
        {
            $destination = public_path('uploads/images/gambar-kuliner');
            $filename_header = $nama_bersih.".jpg";
            $gambar = Image::make($request->file('gambar'));
            $gambar->encode('jpg', 60);
            $gambar->resize(500, null, function ($constraint) {$constraint->aspectRatio();});
            if($request->sumber_gambar_header != '')
            {
                $gambar->text("SUMBER : ".$request->sumber_gambar_header, 3, $gambar->height() - 3, function($font) {
                    $font->color('#fdf6e3');
                    $font->size(24);
                });
            }
            $gambar->save($destination.'/'.$filename_header);
        }

        $this->kulinerClass->kabupaten_id = $kab_id;
        $this->kulinerClass->slug = $nama_bersih;
        $this->kulinerClass->title = $request->nama;
        $this->kulinerClass->sumber_gambar = $request->sumber_gambar_header;
        $this->kulinerClass->isi = $dom->saveHTML();
        $this->kulinerClass->thumbnail = $filename_header;
        $this->kulinerClass->video = implode(',',$request->video);
        $this->kulinerClass->meta_description = meta_description($dom->saveHTML());
        $this->kulinerClass->meta_keyword = meta_keywords($request->nama);
        $this->kulinerClass->status = (Auth::user()->level == 7 ) ? 1 : 3;        
        $this->kulinerClass->save();

        

        if($this->kulinerClass)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/kuliner');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['kabupaten'] = $this->kabupatenClass->orderBy("nama",'desc')->get();
        $this->data['edit'] = $this->kulinerClass->find($id);
        return view('dashboard.pages.kuliner.edit',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->level == 1 || Auth::user()->level == 4):
            $validator = Validator::make($request->all(), [
                'kabupaten' => 'required',
                'nama'=> 'required',
                'isi_berita'=> 'required',
                'status'=> 'required',
                'tos' => 'required',
            ]);
        else:
            $validator = Validator::make($request->all(), [
                'nama'=> 'required',
                'isi_berita'=> 'required',
                'tos' => 'required',
            ]);
        endif;

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $edit = Kuliner::find($id);

        $kab_id = (Auth::user()->level != 7) ? $request->kabupaten : Auth::user()->kabupaten_id;

        $nama_bersih = bersih($request->nama,'-');

        $content = $request->isi_berita;
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $hitungGambar = 1;
        $images = $dom->getElementsByTagName('img');
        foreach($images as $img)
        {
            $src = $img->getAttribute('src');
            if(preg_match('/data:image/', $src))
            {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $filename = $nama_bersih.'_'.$hitungGambar;
                $filepath = public_path('uploads/images/gambar-kuliner').'/'.$filename.'.'.$mimetype;
                $nama = $filename.'.'.$mimetype;
                $image = Image::make($src)
                        ->encode($mimetype, 75)
                        ->save($filepath);
                $truepath = asset('uploads/images/gambar-kuliner').'/'.$filename.'.'.$mimetype;
                $new_src =$truepath;
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $hitungGambar++;
                
            }
            
        }

        if($request->file('gambar'))
        {
            $destination = public_path('uploads/images/gambar-kuliner');
            $filename_header = $nama_bersih.".jpg";
            $gambar = Image::make($request->file('gambar'));
            $gambar->encode('jpg', 60);
            $gambar->resize(500, null, function ($constraint) {$constraint->aspectRatio();});
            if($request->sumber_gambar_header != '')
            {
                $gambar->text("SUMBER : ".$request->sumber_gambar_header, 3, $gambar->height() - 3, function($font) {
                    $font->color('#fdf6e3');
                    $font->size(24);
                });
            }
            $gambar->save($destination.'/'.$filename_header);
        }

        $edit->kabupaten_id = $kab_id;
        $edit->slug = $nama_bersih;
        $edit->title = $request->nama;
        $edit->video = implode(',',$request->video);
        $edit->sumber_gambar = $request->sumber_gambar_header;
        $edit->isi = $dom->saveHTML();
        if(isset($filename_header)):
            $edit->thumbnail = $filename_header;
        endif;
        $edit->meta_description = meta_description($dom->saveHTML());
        $edit->meta_keyword = meta_keywords($request->nama);
        $edit->status = (Auth::user()->level == 7 ) ? 1 : 3;        
        $edit->save();

        
        if($edit)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/kuliner');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data = $this->kulinerClass->find($id);
        if($data->thumbnail != "default.jpg")
        {
            /* DELETE DATA GAMBAR KETERANGAN*/
            $path_keterangan = public_path('uploads/images/gambar-kuliner');
            $content = $data->isi;
            $dom = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');
            foreach($images as $img)
            {
                $src = $img->getAttribute('src');
                File::delete($path_keterangan.'/'.basename($src));
            }
        }
    
        $data->delete();
        return ['status'=>'1'];
    }

    public function table(Request $request)
    {   
        
        $data = (Auth::user()->level == 7) ? $this->kulinerClass->getData(Auth::user()->kabupaten_id) : $this->kulinerClass->getData();
            return DataTables::of($data)
            ->addColumn('option', function($data)
            {
                $button = '<a href="'.url('dashboard/kuliner/edit/'.$data->id).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
                $button .= '<button data-id="'.$data->id.'" data-nama="'.$data->title.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
                return  $button;
            })

            ->addColumn('tanggal', function($data)
            {
            return  Carbon::parse($data->updated_at)->diffForHumans();
            })

            ->addColumn('video', function($data)
            {
            return  str_replace(',','<br>',$data->video);
            })

            ->addColumn('gambar', function($data)
            {
               return  "<img width='150px' src='".asset('uploads/images/gambar-kuliner/'.$data->thumbnail)."'>";
            })
            ->addColumn('status', function($data)
            {
               return  status($data->status);
            })

            ->addColumn('detail', function($data)
            {
                $button = '<div class="btn-group mb-4 mr-2">
                    <button type="button" class="btn btn-primary">Detail</button>
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" style="will-change: transform;">
                        <a class="dropdown-item" href="'.url("/dashboard/kuliner/gambar").'/'.$data->id.'">Gallery Kuliner</a>
                        <a class="dropdown-item" href="'.url("/dashboard/kuliner/penyedia").'/'.$data->id.'">Penyedia/Penjual</a>
                    </div>
                </div>';

               
                return  $button;
            })
            
            ->addIndexColumn()
            ->rawColumns(['tanggal','option','gambar','status','video','detail'])
            ->make(true);
    }

    public function getListObjekWisata($id_kabupaten)
    {
        $get = $this->objekWisataClass->getDataByKab($id_kabupaten);
        return response()->json($get);
    }

    public function gambarIndex($id)
    {  
        $data = $this->kulinerClass->find($id);
        $this->data['sub_page'] = $data->nama;
        $this->data['kuliner_id'] = $id;
        return view('dashboard.pages.kuliner.gambar.index',$this->data); 
    }

    public function gambarTable($id)
    {
        
        $data = $this->kulinerGambar->where('kuliner_id',$id)->orderBy('updated_at','desc')->get();
        
        return DataTables::of($data)
        ->addColumn('option', function($data)
        {
            $event = $this->kulinerClass->find($data->kuliner_id);
            $nama_objek = $event->nama;
            // $button = '<a href="'.url('dashboard/cindramata/gambar/edit/'.$data->id.'/'.$data->kuliner_id).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
            $button = '<button data-id="'.$data->id.'" data-nama="'.$nama_objek.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
            return  $button;
        })
        
        ->addColumn('tanggal', function($data)
        {
           return  Carbon::parse($data->updated_at)->diffForHumans();
        })

        ->addColumn('gambar', function($data)
        {
           return  "<img width='250px' src='".asset('uploads/images/gallery-kuliner/'.$data->gambar)."'>";
        })
        ->addIndexColumn()
        ->rawColumns(['status','option','gambar','jenis','detail'])
        ->make(true);
    }

    public function gambarCreate($id)
    {
        
        $data = $this->kulinerClass->find($id);
        $this->data['sub_page'] = $data->nama;
        $this->data['kuliner_id'] = $id;
        $this->data['nama_objek'] = $data->nama;
        return view('dashboard.pages.kuliner.gambar.create',$this->data); 
    }

    public function gambarStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'required',
            'sumber' => 'required',
            'tos' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $data = $this->kulinerClass->find($request->kuliner_id);
        $nama_objek = bersih($data->nama,'-');

        $destination = public_path('uploads/images/gallery-kuliner');
        $filename = rand().'-'.$nama_objek.".jpg";
        $gambar = Image::make($request->file('gambar'));
        $gambar->encode('jpg', 60);
        $gambar->resize(500, null, function ($constraint) {$constraint->aspectRatio();});
        if($request->sumber != '')
        {
            $gambar->text("SUMBER : ".$request->sumber, 3, $gambar->height() - 3, function($font) {
                $font->color('#fdf6e3');
                $font->size(24);
            });
        }

        $gambar->save($destination.'/'.$filename);

        
        $save = new KulinerGambar;
        $save->kuliner_id = $request->kuliner_id;
        $save->sumber = $request->sumber;
        $save->gambar = $filename;
        $save->save();
        
        Toastr::success('Data Berhasil Ditambah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        return redirect::to('dashboard/kuliner/gambar/'.$request->kuliner_id);
    }

    public function gambarDestroy($id)
    {
        $delete = $this->kulinerGambar->find($id);
        $path = public_path('uploads/images/gallery-kuliner');
        File::delete($path.'/'.$delete->gambar);
        $delete->delete();
        return ['status'=>'1'];
    }

    public function penyediaIndex($id)
    {
        $data = $this->kulinerClass->find($id);
        // dd($data);
        $this->data['sub_page'] = $data->nama;
        $this->data['id'] = $id;
        return view('dashboard.pages.kuliner.penyedia.index',$this->data); 
    }

    public function penyediaCreate($id)
    {
        $penyedia = Ekraf::leftJoin('kabupatens','kabupatens.id','ekrafs.kabupaten_id')
            ->leftJoin('kategori_ekrafs','kategori_ekrafs.id','ekrafs.kategori_ekraf_id')
            ->select('ekrafs.id','kabupatens.nama as nama_kabupaten','ekrafs.jenis_usaha','ekrafs.nama as nama_pelaku','kategori_ekrafs.nama as nama_kategori')
            ->orderBy('ekrafs.nama','asc')
            ->get();
        $data = $this->kulinerClass->find($id);
        $this->data['sub_page'] = $data->nama;
        // $this->data['tempat_ibadah'] = $this->penyedia->orderBy('nama','asc')->get();
        $this->data['penyedia'] = $penyedia;
        $this->data['id'] = $id;
        return view('dashboard.pages.kuliner.penyedia.create',$this->data); 
    }

    public function penyediaStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'penyedia' => 'required',
            'tos' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }


        foreach($request->penyedia as $item)
        {
            $save = new KulinerPenyedia;
            $save->kuliner_id = $request->id;
            $save->ekraf_id = $item;
            $save->save();
        }
 
        Toastr::success('Data Berhasil Diubah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        return redirect::to('dashboard/kuliner/penyedia/'.$request->id);
    }

    public function penyediaTable($id)
    {
        $data = $this->kulinerPenyedia->getData($id);
        return DataTables::of($data)
        ->addColumn('option', function($data)
        {
            $button = '<button data-id="'.$data->id.'" data-nama="'.$data->nama.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
            return  $button;
        })
        
        ->addColumn('tanggal', function($data)
        {
           return  Carbon::parse($data->updated_at)->diffForHumans();
        })

        ->addIndexColumn()
        ->rawColumns(['status','option','gambar','jenis','detail'])
        ->make(true);
    }

    public function penyediaDestroy($id)
    {
        $delete =   $this->kulinerPenyedia->find($id);
        $delete->delete();
        return ['status'=>'1'];
    }
}
