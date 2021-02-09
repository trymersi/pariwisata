<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use App\Models\KategoriEkraf;
use Illuminate\Http\Request;
use App\Models\Kabupaten;
use DataTables;
use Toastr;
use File;

class KategoriEkrafController extends Controller
{
    private $data;
    private $kabupatenClass;
    private $kategoriEkrafClass;

    public function __construct()
    {
        $this->middleware(['role:super_admin']);

        $this->kabupatenClass = new Kabupaten;
        $this->kategoriEkrafClass = new KategoriEkraf;

        $this->data = [
            'category_name' => 'Master',
            'page_name' => 'Kategori Ekraf',
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
        return view('dashboard.pages.kategori-ekraf.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.kategori-ekraf.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required',
            'deskripsi_lengkap' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $nama_kategori_bersih = bersih($request->nama_kategori,'_');

        $content = $request->deskripsi_lengkap;
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
                $filename = $nama_kategori_bersih.'_'.$hitungGambar;
                $filepath = public_path('uploads/images/keterangan-kategori-ekraf').'/'.$filename.'.'.$mimetype;
                $nama = $filename.'.'.$mimetype;
                $image = Image::make($src)
                        ->encode($mimetype, 75)
                        ->save($filepath);
                $truepath = asset('uploads/images/keterangan-kategori-ekraf').'/'.$filename.'.'.$mimetype;
                $new_src =$truepath;
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }

            $hitungGambar++;
        }

        if($request->file('gambar_kategori'))
        {
            $destination = public_path('uploads/images/kategori-ekraf');
            $filename_gambar = $nama_bersih.".jpg";
            $gambar = Image::make($request->file('gambar_kategori'));
            $gambar->encode('jpg', 60);
            $gambar->resize(500, null, function ($constraint) {$constraint->aspectRatio();});
            $gambar->save($destination.'/'.$filename_header);
        }
        
        $slug = bersih($request->nama_kategori,'-');
        $this->kategoriEkrafClass->nama = $request->nama_kategori;
        $this->kategoriEkrafClass->deskripsi = $dom->saveHTML();
        $this->kategoriEkrafClass->gambar = (isset($filename_gambar)) ? $filename_gambar :'default.jpg';
        $this->kategoriEkrafClass->slug = $slug;
        $this->kategoriEkrafClass->save();

        if($this->kategoriEkrafClass)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/kategori-ekraf');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['edit'] = $this->kategoriEkrafClass->find($id);
        return view('dashboard.pages.kategori-ekraf.edit',$this->data);
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
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required',
            'deskripsi_lengkap' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $nama_kategori_bersih = bersih($request->nama_kategori,'_');

        $content = $request->deskripsi_lengkap;
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
                $filename = $nama_kategori_bersih.'_'.$hitungGambar;
                $filepath = public_path('uploads/images/keterangan-kategori-ekraf').'/'.$filename.'.'.$mimetype;
                $nama = $filename.'.'.$mimetype;
                $image = Image::make($src)
                        ->encode($mimetype, 75)
                        ->save($filepath);
                $truepath = asset('uploads/images/keterangan-kategori-ekraf').'/'.$filename.'.'.$mimetype;
                $new_src =$truepath;
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }

            $hitungGambar++;
        }

        if($request->file('gambar_kategori'))
        {
            $gambar_kategori = $request->file('gambar_kategori');
            $ext = $gambar_kategori->getClientOriginalExtension();
            $destination = public_path('uploads/images/kategori-ekraf');
            $filename_gambar= $nama_kategori_bersih.".".$ext;
            $gambar_kategori->move($destination, $filename_gambar);
        }
        
        $slug = bersih($request->nama_kategori,'-');
        $edit = $this->kategoriEkrafClass->find($id);
        $edit->nama = $request->nama_kategori;
        $edit->deskripsi = $dom->saveHTML();
        if(isset($filename_gambar)):
            $edit->gambar = $filename_gambar;
        endif;
        $edit->slug = $slug;
        $edit->save();

        if($edit)
        {
            Toastr::success('Data Berhasil Diubah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/kategori-ekraf');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->kategoriEkrafClass->find($id);
        
        /* DELETE DATA GAMBAR */
        $path = public_path('uploads/images/kategori-ekraf');
        File::delete($path.'/'.$data->gambar);

        /* DELETE DATA GAMBAR KETERANGAN*/
        $path_keterangan = public_path('uploads/images/keterangan-kategori-ekraf');
        $content = $data->deskripsi;
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        foreach($images as $img)
        {
            $src = $img->getAttribute('src');
            File::delete($path_keterangan.'/'.basename($src));
        }
        $data->delete();
        return ['status'=>'1'];
    }

    public function table(Request $request)
    {   
        $data = $this->kategoriEkrafClass->getData();
            return DataTables::of($data)
            ->addColumn('image', function($data)
            {
               return  "<img width='150px' src='".asset('uploads/images/kategori-ekraf/'.$data->gambar)."'>";
            })

            ->addColumn('option', function($data)
            {
                $button = '<a href="'.url('dashboard/kategori-ekraf/edit/'.$data->id).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
                $button .= '<button data-id="'.$data->id.'" data-nama="'.$data->nama.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
                return  $button;
            })

            ->addColumn('deskripsi', function($data)
            {
                return meta_description($data->deskripsi);
            })
    
            ->addIndexColumn()
            ->rawColumns(['option','image','deskripsi'])
            ->make(true);
    }
}
