<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use App\Models\CindramataDetail;
use App\Models\Ekraf;
use App\Models\CindramataGambar;
use App\Models\CindramataPenyedia;
use Illuminate\Http\Request;
use App\Models\SosialMedia;
use App\Models\Cindramata;
use App\Models\ObjekWisata;
use App\Models\Kabupaten;
use Carbon\Carbon;
use DataTables;
use Toastr;
use File;
use Auth;

class CendramataController extends Controller
{
    private $data;
    private $kabupatenClass;
    private $cendramataClass;
    private $objekWisataClass;
    private $cendramataDetailClass;
    private $sosialMediaClass;
    private $cindramataGambar;
    private $cindramataPenyedia;

    public function __construct()
    {
        $this->middleware(['role:super_admin,auth_sdp,auth_kabupaten']);

        $this->kabupatenClass = new Kabupaten;
        $this->objekWisataClass = new ObjekWisata;
        $this->cendramataClass = new Cindramata;
        $this->cendramataDetailClass = new CindramataDetail;
        $this->sosialMediaClass = new SosialMedia;
        $this->cindramataGambar = new CindramataGambar;
        $this->cindramataPenyedia = new CindramataPenyedia;

        $this->data = [
            'category_name' => 'Ekraf',
            'page_name' => 'Cindramata',
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
        return view('dashboard.pages.cendramata.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['kabupaten'] = $this->kabupatenClass->orderBy("nama",'desc')->get();
        return view('dashboard.pages.cendramata.create',$this->data);
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
                'nama' => 'required',
                'gambar'=> 'required',
                'deskripsi'=> 'required',
                'jenis'=> 'required',
                'sumber_gambar_header'=> 'required',
                'tos' => 'required',
            ]);
        else:
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'gambar'=> 'required',
                'deskripsi'=> 'required',
                'jenis'=> 'required',
                'sumber_gambar_header'=> 'required',
                'tos' => 'required',
            ]);
        endif;

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $kab_id = (Auth::user()->level == 1 || Auth::user()->level == 4 ) ? $request->kabupaten : Auth::user()->kabupaten_id;

        $nama_bersih = bersih($request->nama,'-');

        $content = $request->deskripsi;
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
                $filepath = public_path('uploads/images/deskripsi-cindramata').'/'.$filename.'.'.$mimetype;
                $nama = $filename.'.'.$mimetype;
                $image = Image::make($src)
                        ->encode($mimetype, 60)
                        ->save($filepath);
                $truepath = asset('uploads/images/deskripsi-cindramata').'/'.$filename.'.'.$mimetype;
                $new_src =$truepath;
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }
            $hitungGambar++;
        }

        if($request->file('gambar'))
        {
            $destination = public_path('uploads/images/gambar-header-cindramata');
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

        $this->cendramataClass->kabupaten_id = $kab_id;
        $this->cendramataClass->nama = $request->nama;
        $this->cendramataClass->slug = $nama_bersih;
        $this->cendramataClass->jenis = $request->jenis;
        $this->cendramataClass->gambar = $filename_header;
        $this->cendramataClass->deskripsi = $dom->saveHTML();
        $this->cendramataClass->sumber_gambar_header = $request->sumber_gambar_header;
        $this->cendramataClass->status = (Auth::user()->level == 1 || Auth::user()->level == 4 ) ? 3 : 1;
        $this->cendramataClass->save();

        if($this->cendramataClass)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/cindramata');
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
        $this->data['edit'] = $this->cendramataClass->find($id);
        $this->data['kabupaten'] = $this->kabupatenClass->orderBy("nama",'desc')->get();
        $this->data['objek_wisata'] = $this->objekWisataClass->getDataByKab($this->data['edit']->kabupaten_id);
        return view('dashboard.pages.cendramata.edit',$this->data);
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
                'nama' => 'required',
                'gambar'=> 'required',
                'deskripsi'=> 'required',
                'jenis'=> 'required',
                'sumber_gambar_header'=> 'required',
                'tos' => 'required',
                'status' => 'required',
            ]);
        else:
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'gambar'=> 'required',
                'deskripsi'=> 'required',
                'jenis'=> 'required',
                'sumber_gambar_header'=> 'required',
                'tos' => 'required',
            ]);
        endif;

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $kab_id = (Auth::user()->level == 1 || Auth::user()->level == 4 ) ? $request->kabupaten : Auth::user()->kabupaten_id;

        $nama_bersih = bersih($request->nama,'-');

        $content = $request->deskripsi;
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
                $filepath = public_path('uploads/images/deskripsi-cindramata').'/'.$filename.'.'.$mimetype;
                $nama = $filename.'.'.$mimetype;
                $image = Image::make($src)
                        ->encode($mimetype, 60)
                        ->save($filepath);
                $truepath = asset('uploads/images/deskripsi-cindramata').'/'.$filename.'.'.$mimetype;
                $new_src =$truepath;
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }
            $hitungGambar++;
        }

        if($request->file('gambar'))
        {
            $destination = public_path('uploads/images/gambar-header-cindramata');
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

        $edit = Cindramata::find($id);
        $edit->kabupaten_id = $kab_id;
        $edit->nama = $request->nama;
        $edit->slug = $nama_bersih;
        $edit->jenis = $request->jenis;
        $edit->gambar = $filename_header;
        $edit->deskripsi = $dom->saveHTML();
        $edit->sumber_gambar_header = $request->sumber_gambar_header;
        $edit->status = (Auth::user()->level == 1 || Auth::user()->level == 4 ) ? $request->status : 1;
        $edit->save();

        if($edit)
        {
            Toastr::success('Data Berhasil Diubah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/cindramata');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->cendramataClass->find($id);

        $gambar = $this->cendramataDetailClass->where('cindramata_id',$id)->get();
        $path_gambar = public_path('uploads/images/produk-cindramata');
        foreach($gambar as $key)
        {   
            if(isset($key->id)):
            $deleteGambar = $this->cendramataDetailClass->find($key->id);
            File::delete($path_gambar.'/'.$key->gambar);
            $deleteGambar->delete();
            endif;
        }

        /* DELETE DATA GAMBAR HEADER */
        $path = public_path('uploads/images/gambar-header-cindramata');
        File::delete($path.'/'.$data->gambar);

        $data->delete();
        return ['status'=>'1'];
    }

    public function table(Request $request)
    {   
        
        $data = (Auth::user()->level == 7) ? $this->cendramataClass->getData(Auth::user()->kabupaten_id) : $this->cendramataClass->getData();
            return DataTables::of($data)
            ->addColumn('status', function($data)
            {
               return  status($data->status);
            })
            ->addColumn('option', function($data)
            {
                $button = '<a href="'.url('dashboard/cindramata/edit/'.$data->id).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
                $button .= '<button data-id="'.$data->id.'" data-nama="'.$data->nama.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
                return  $button;
            })

            ->addColumn('detail', function($data)
            {
                $button = '<div class="btn-group mb-4 mr-2">
                    <button type="button" class="btn btn-primary">Detail</button>
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" style="will-change: transform;">
                        <a class="dropdown-item" href="'.url("/dashboard/cindramata/gambar").'/'.$data->id.'">Gallery Cindramata</a>
                        <a class="dropdown-item" href="'.url("/dashboard/cindramata/penyedia").'/'.$data->id.'">Penyedia/Penjual</a>
                        <a class="dropdown-item" href="'.url("/dashboard/cindramata/sosial-media").'/'.$data->id.'">Sosial Media</a>
                    </div>
                </div>';

               
                return  $button;
            })

            ->addColumn('gambar', function($data)
            {
               return  "<img width='150px' src='".asset('uploads/images/gambar-header-cindramata/'.$data->gambar)."'>";
            })

            ->addColumn('deskripsi', function($data)
            {
               return  meta_description($data->deskripsi);
            })

            ->addColumn('nama_objek_wisata', function($data)
            {
               return  isset($data->nama_objek_wisata) ? $data->nama_objek_wisata : '-';
            })

            ->addIndexColumn()
            ->rawColumns(['status','option','gambar','jenis','detail','deskripsi'])
            ->make(true);
    }

    public function getListObjekWisata($id_kabupaten)
    {
        $get = $this->objekWisataClass->getDataByKab($id_kabupaten);
        return response()->json($get);
    }

    public function gambarIndex($id)
    {  
        $data = $this->cendramataClass->find($id);
        $this->data['sub_page'] = $data->nama;
        $this->data['cindramata_id'] = $id;
        return view('dashboard.pages.cendramata.gambar.index',$this->data); 
    }

    public function gambarTable($id)
    {
        
        $data = $this->cindramataGambar->where('cindramata_id',$id)->orderBy('updated_at','desc')->get();
        
        return DataTables::of($data)
        ->addColumn('option', function($data)
        {
            $event = $this->cendramataClass->find($data->cindramata_id);
            $nama_objek = $event->nama;
            // $button = '<a href="'.url('dashboard/cindramata/gambar/edit/'.$data->id.'/'.$data->cindramata_id).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
            $button = '<button data-id="'.$data->id.'" data-nama="'.$nama_objek.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
            return  $button;
        })
        
        ->addColumn('tanggal', function($data)
        {
           return  Carbon::parse($data->updated_at)->diffForHumans();
        })

        ->addColumn('gambar', function($data)
        {
           return  "<img width='250px' src='".asset('uploads/images/gallery-cindramata/'.$data->gambar)."'>";
        })
        ->addIndexColumn()
        ->rawColumns(['status','option','gambar','jenis','detail'])
        ->make(true);
    }

    public function gambarCreate($id)
    {
        
        $data = $this->cendramataClass->find($id);
        $this->data['sub_page'] = $data->nama;
        $this->data['cindramata_id'] = $id;
        $this->data['nama_objek'] = $data->nama;
        return view('dashboard.pages.cendramata.gambar.create',$this->data); 
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

        $data = $this->cendramataClass->find($request->cindramata_id);
        $nama_objek = bersih($data->nama,'-');

        $destination = public_path('uploads/images/gallery-cindramata');
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

        
        $save = new CindramataGambar;
        $save->cindramata_id = $request->cindramata_id;
        $save->sumber = $request->sumber;
        $save->gambar = $filename;
        $save->save();
        
        Toastr::success('Data Berhasil Ditambah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        return redirect::to('dashboard/cindramata/gambar/'.$request->cindramata_id);
    }

    public function gambarDestroy($id)
    {
        $delete = $this->cindramataGambar->find($id);
        $path = public_path('uploads/images/gallery-cindramata');
        File::delete($path.'/'.$delete->gambar);
        $delete->delete();
        return ['status'=>'1'];
    }

    public function detailIndex($id)
    {  
        $data = $this->cendramataClass->find($id);
        $this->data['sub_page'] = $data->nama;
        $this->data['id'] = $id;
        return view('dashboard.pages.cendramata.detail.index',$this->data); 
    }

    public function detailTable($id)
    {
        
        $data = $this->cendramataDetailClass->where('cindramata_id',$id)->orderBy('updated_at','desc')->get();
        
        return DataTables::of($data)
        ->addColumn('option', function($data)
        {
            $cindramata = $this->cendramataClass->find($data->cindramata_id);
            $nama_objek = $cindramata->nama;
            $button = '<a href="'.url('dashboard/cindramata/detail/edit/'.$data->id.'/'.$data->cindramata_id).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
            $button .= '<button data-id="'.$data->id.'" data-nama="'.$nama_objek.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
            return  $button;
        })
        
        ->addColumn('tanggal', function($data)
        {
           return  Carbon::parse($data->updated_at)->diffForHumans();
        })

        ->addColumn('gambar', function($data)
        {
           return  "<img width='250px' src='".asset('uploads/images/produk-cindramata/'.$data->gambar)."'>";
        })
        ->addIndexColumn()
        ->rawColumns(['status','option','gambar','jenis','detail'])
        ->make(true);
    }

    public function detailCreate($cindramata_id)
    {
        
        $data = $this->cendramataClass->find($cindramata_id);
        $this->data['sub_page'] = $data->nama;
        $this->data['id'] = $cindramata_id;
        return view('dashboard.pages.cendramata.detail.create',$this->data); 
    }

    public function detailStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'required',
            'nama_produk' => 'required',
            'tos' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $data = $this->cendramataClass->find($request->cindramata_id);
        $nama_objek = bersih($data->nama,'-');
        $nama_menu = bersih($request->nama_produk,'-');
        $nama_gambar = $nama_objek.'-'.$nama_menu;
        if($request->file('gambar'))
        {
            $gambar = $request->file('gambar');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/produk-cindramata');
            $filename_header = $nama_gambar.".".$ext;
            $gambar->move($destination, $filename_header);
        }

        $save = new CindramataDetail;
        $save->cindramata_id = $request->cindramata_id;
        $save->nama = $request->nama_produk;
        $save->gambar = $filename_header;
        $save->save();

        Toastr::success('Data Berhasil Ditambah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        return redirect::to('dashboard/cindramata/detail/'.$request->cindramata_id);
    }

    public function detailEdit($id,$cindramata_id)
    {   
        $data = $this->cendramataClass->find($cindramata_id);
        $this->data['sub_page'] = $data->nama;
        $this->data['id'] = $cindramata_id;
        $this->data['edit'] = $this->cendramataDetailClass->find($id);
        return view('dashboard.pages.cendramata.detail.edit',$this->data); 
    }

    public function detailUpdate($id,Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'required',
            'nama_produk' => 'required',
            'tos' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $data = $this->cendramataClass->find($request->cindramata_id);
        $nama_objek = bersih($data->nama,'-');
        $nama_menu = bersih($request->nama_produk,'-');
        $nama_gambar = $nama_objek.'-'.$nama_menu;
        if($request->file('gambar'))
        {
            $gambar = $request->file('gambar');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/produk-cindramata');
            $filename_header = $nama_gambar.".".$ext;
            $gambar->move($destination, $filename_header);
        }

        $save = CindramataDetail::find($id);
        $save->cindramata_id = $request->cindramata_id;
        $save->nama = $request->nama_produk;
        $save->gambar = $filename_header;
        $save->save();

        Toastr::success('Data Berhasil Diubah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        return redirect::to('dashboard/cindramata/detail/'.$request->cindramata_id);
    }

    public function detailDestroy($id)
    {
        $delete = $this->cendramataDetailClass->find($id);
        $path = public_path('uploads/images/produk-cindramata');
        File::delete($path.'/'.$delete->gambar);
        $delete->delete();
        return ['status'=>'1'];
    }

    public function sosmedIndex($id)
    {  
        $data = $this->cendramataClass->find($id);
        $this->data['sub_page'] = $data->nama;
        $this->data['id'] = $id;
        return view('dashboard.pages.cendramata.sosial-media.index',$this->data); 
    }

    public function sosmedTable($id)
    {
        
        $data = $this->sosialMediaClass->where('id_tempat',$id)->where('kode_tempat',4)->orderBy('updated_at','desc')->get();
        
        return DataTables::of($data)
        ->addColumn('option', function($data)
        {
            
            $button = '<a href="'.url('dashboard/cindramata/sosial-media/edit/'.$data->id.'/'.$data->id_tempat).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
            $button .= '<button data-id="'.$data->id.'" data-nama="'.$data->nama.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
            return  $button;
        })
        
        ->addColumn('tanggal', function($data)
        {
           return  Carbon::parse($data->updated_at)->diffForHumans();
        })

        ->addColumn('sosmed', function($data)
        {
           return  getSosmed($data->kode_sosmed);
        })
        ->addIndexColumn()
        ->rawColumns(['status','option','sosmed','tanggal'])
        ->make(true);
    }

    public function sosmedCreate($restaurant_id)
    {
        $data = $this->cendramataClass->find($restaurant_id);
        $this->data['sub_page'] = $data->nama;
        $this->data['id'] = $restaurant_id;
        return view('dashboard.pages.cendramata.sosial-media.create',$this->data); 
    }

    public function sosmedStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sosial_media' => 'required',
            'alamat_sosial_media' => 'required',
            'tos' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }
        
        $this->sosialMediaClass->id_tempat = $request->id;
        $this->sosialMediaClass->kode_tempat = 4;
        $this->sosialMediaClass->kode_sosmed = $request->sosial_media;
        $this->sosialMediaClass->alamat_sosmed = $request->alamat_sosial_media;
        $this->sosialMediaClass->save();

        Toastr::success('Data Berhasil Ditambah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        return redirect::to('dashboard/cindramata/sosial-media/'.$request->id);
    }

    public function sosmedEdit($id,$id_tempat)
    {   
        $data = $this->cendramataClass->find($id_tempat);
        $this->data['sub_page'] = $data->nama;
        $this->data['id'] = $id_tempat;
        $this->data['edit'] = $this->sosialMediaClass->find($id);
        return view('dashboard.pages.cendramata.sosial-media.edit',$this->data); 
    }

    public function sosmedUpdate($id,Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sosial_media' => 'required',
            'alamat_sosial_media' => 'required',
            'tos' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }
        
        $edit =  SosialMedia::find($id);
        $edit->id_tempat = $request->id;
        $edit->kode_tempat = 4;
        $edit->kode_sosmed = $request->sosial_media;
        $edit->alamat_sosmed = $request->alamat_sosial_media;
        $edit->save();

        Toastr::success('Data Berhasil Diubah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        return redirect::to('dashboard/cindramata/sosial-media/'.$request->id);
    }

    public function sosmedDestroy($id)
    {
        $delete = $this->sosialMediaClass->find($id);
        $delete->delete();
        return ['status'=>'1'];
    }

    public function penyediaIndex($id)
    {
        $data = $this->cendramataClass->find($id);
        // dd($data);
        $this->data['sub_page'] = $data->nama;
        $this->data['id'] = $id;
        return view('dashboard.pages.cendramata.penyedia.index',$this->data); 
    }

    public function penyediaCreate($id)
    {
        $penyedia = Ekraf::leftJoin('kabupatens','kabupatens.id','ekrafs.kabupaten_id')
            ->leftJoin('kategori_ekrafs','kategori_ekrafs.id','ekrafs.kategori_ekraf_id')
            ->select('ekrafs.id','kabupatens.nama as nama_kabupaten','ekrafs.jenis_usaha','ekrafs.nama as nama_pelaku','kategori_ekrafs.nama as nama_kategori')
            ->orderBy('ekrafs.nama','asc')
            ->get();
        $data = $this->cendramataClass->find($id);
        $this->data['sub_page'] = $data->nama;
        // $this->data['tempat_ibadah'] = $this->penyedia->orderBy('nama','asc')->get();
        $this->data['penyedia'] = $penyedia;
        $this->data['id'] = $id;
        return view('dashboard.pages.cendramata.penyedia.create',$this->data); 
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
            $save = new CindramataPenyedia;
            $save->cindramata_id = $request->id;
            $save->ekraf_id = $item;
            $save->save();
        }
 
        Toastr::success('Data Berhasil Diubah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        return redirect::to('dashboard/cindramata/penyedia/'.$request->id);
    }

    public function penyediaTable($id)
    {
        $data = $this->cindramataPenyedia->getData($id);
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
        $delete =   $this->cindramataPenyedia->find($id);
        $delete->delete();
        return ['status'=>'1'];
    }
}
