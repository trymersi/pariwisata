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
use Carbon\Carbon;
use DataTables;
use Toastr;
use File;
use Auth;

class KulinerController extends Controller
{
    private $data;
    private $kulinerClass;
    private $kabupatenClass;

    public function __construct()
    {
        $this->middleware('auth');

        $this->kabupatenClass = new Kabupaten;
        $this->kulinerClass = new Kuliner;
      

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
                'alamat'=> 'required',
                'isi_berita'=> 'required',
                'tos' => 'required',
            ]);
        else:
            $validator = Validator::make($request->all(), [
                'nama'=> 'required',
                'alamat'=> 'required',
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

            if($hitungGambar == 1)
            {
                $thumbnail = $nama;
            }
            $hitungGambar++;
        }

        $thumb = isset($thumbnail) ? $thumbnail : 'default.jpg';

        $this->kulinerClass->kabupaten_id = $kab_id;
        $this->kulinerClass->slug = $nama_bersih;
        $this->kulinerClass->title = $request->nama;
        $this->kulinerClass->alamat = $request->alamat;
        $this->kulinerClass->isi = $dom->saveHTML();
        $this->kulinerClass->thumbnail = $thumb;
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
                'alamat'=> 'required',
                'isi_berita'=> 'required',
                'status'=> 'required',
                'tos' => 'required',
            ]);
        else:
            $validator = Validator::make($request->all(), [
                'nama'=> 'required',
                'alamat'=> 'required',
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
                $hitungGambar++;
                
            }
            if($hitungGambar == 2)
            {   
                if($edit->thumbnail == 'default.jpg' || $edit->thumbnail == '')
                {
                    $thumbnail = $nama;
                    $thumb = isset($thumbnail) ? $thumbnail : 'default.jpg';
                }
                
            }
        }

       

        $edit = Kuliner::find($id);
        $edit->kabupaten_id = $kab_id;
        $edit->slug = $nama_bersih;
        $edit->title = $request->nama;
        $edit->alamat = $request->alamat;
        $edit->isi = $dom->saveHTML();
        if(isset($thumb)):
            $edit->thumbnail = $thumb;
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

            ->addColumn('gambar', function($data)
            {
               return  "<img width='150px' src='".asset('uploads/images/gambar-kuliner/'.$data->thumbnail)."'>";
            })
            ->addColumn('status', function($data)
            {
               return  status($data->status);
            })
            
            ->addIndexColumn()
            ->rawColumns(['tanggal','option','gambar','status'])
            ->make(true);
    }

    public function getListObjekWisata($id_kabupaten)
    {
        $get = $this->objekWisataClass->getDataByKab($id_kabupaten);
        return response()->json($get);
    }
}
