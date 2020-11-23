<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kabupaten;
use DataTables;
use Toastr;
use File;

class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $data;
    private $kabupatenClass;

    public function __construct()
    {
        $this->middleware(['role:super_admin']);

        $this->kabupatenClass = new Kabupaten;

        $this->data = [
            'category_name' => 'Master',
            'page_name' => 'Kabupaten',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'alt_menu' => 1,
        ];
    }

    public function index()
    {   
        
        return view('dashboard.pages.kabupaten.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.kabupaten.create',$this->data);
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
            'nama_kabupaten' => 'required',
            'foto_kabupaten' => 'required',
            'tos' => 'required',
            'keterangan_lengkap'=> 'required',
            'longitude'=> 'required',
            'latitude'=> 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $nama_kabupaten_bersih = bersih($request->nama_kabupaten,'_');

        $content = $request->keterangan_lengkap;
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
                $filename = $nama_kabupaten_bersih.'_'.$hitungGambar;
                $filepath = public_path('uploads/images/keterangan-kabupaten').'/'.$filename.'.'.$mimetype;
                $nama = $filename.'.'.$mimetype;
                $image = Image::make($src)
                        ->encode($mimetype, 75)
                        ->save($filepath);
                $truepath = asset('uploads/images/keterangan-kabupaten').'/'.$filename.'.'.$mimetype;
                $new_src =$truepath;
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }

            $hitungGambar++;
        }

        if($request->file('foto_kabupaten'))
        {
            $foto_kabupaten = $request->file('foto_kabupaten');
            $ext = $foto_kabupaten->getClientOriginalExtension();
            $destination = public_path('uploads/images/foto-kabupaten');
            $filename_kabupaten = $nama_kabupaten_bersih.".".$ext;
            $foto_kabupaten->move($destination, $filename_kabupaten);
        }
        
        $this->kabupatenClass->nama = $request->nama_kabupaten;
        $this->kabupatenClass->keterangan = $dom->saveHTML();
        $this->kabupatenClass->gambar = $filename_kabupaten;
        $this->kabupatenClass->slug = $nama_kabupaten_bersih;
        $this->kabupatenClass->meta_description = meta_description($dom->saveHTML());
        $this->kabupatenClass->meta_keywords = meta_keywords($request->nama_kabupaten);
        $this->kabupatenClass->longitude = $request->longitude;
        $this->kabupatenClass->latitude = $request->latitude;
        $this->kabupatenClass->save();

        if($this->kabupatenClass)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/kabupaten');
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
        $this->data['edit'] = $this->kabupatenClass->find($id);
        $this->data['path'] = asset('uploads/images/foto-kabupaten/');
        return view('dashboard.pages.kabupaten.edit',$this->data);
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
            'nama_kabupaten' => 'required',
            'tos' => 'required',
            'keterangan_lengkap'=> 'required',
            'longitude'=> 'required',
            'latitude'=> 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $nama_kabupaten_bersih = bersih($request->nama_kabupaten,'_');

        $content = $request->keterangan_lengkap;
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
                $filename = $nama_kabupaten_bersih.'_'.$hitungGambar;
                $filepath = public_path('uploads/images/keterangan-kabupaten').'/'.$filename.'.'.$mimetype;
                $nama = $filename.'.'.$mimetype;
                $image = Image::make($src)
                        ->encode($mimetype, 75)
                        ->save($filepath);
                $truepath = asset('uploads/images/keterangan-kabupaten').'/'.$filename.'.'.$mimetype;
                $new_src =$truepath;
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }

            
            $hitungGambar++;
        }

        if($request->file('foto_kabupaten'))
        {
            $foto_kabupaten = $request->file('foto_kabupaten');
            $ext = $foto_kabupaten->getClientOriginalExtension();
            $filename_kabupaten = $nama_kabupaten_bersih.".".$ext;
            $destination = public_path('uploads/images/foto-kabupaten');
            $foto_kabupaten->move($destination, $filename_kabupaten);
        }
        
        $edit = $this->kabupatenClass->find($id);
        $edit->nama = $request->nama_kabupaten;
        $edit->keterangan = $dom->saveHTML();
        if(isset($filename_kabupaten)):
            $edit->gambar = $filename_kabupaten;
        endif;
        $edit->slug = $nama_kabupaten_bersih;
        $edit->meta_description = meta_description($dom->saveHTML());
        $edit->meta_keywords = meta_keywords($request->nama_kabupaten);
        $edit->longitude = $request->longitude;
        $edit->latitude = $request->latitude;
        $edit->save();

        if($edit)
        {
            Toastr::success('Data Berhasil Diubah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/kabupaten');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->kabupatenClass->find($id);
        
        /* DELETE DATA GAMBAR */
        $path = public_path('uploads/images/foto-kabupaten');
        File::delete($path.'/'.$data->gambar);

        /* DELETE DATA GAMBAR KETERANGAN*/
        $path_keterangan = public_path('uploads/images/keterangan-kabupaten');
        $content = $data->keterangan;
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
        
        $data = $this->kabupatenClass->orderBy('created_at','desc')->get();
            return DataTables::of($data)
            ->addColumn('image', function($data)
            {
               return  "<img width='150px' src='".asset('uploads/images/foto-kabupaten/'.$data->gambar)."'>";
            })

            ->addColumn('option', function($data)
            {
                $button = '<a href="'.url('dashboard/kabupaten/edit/'.$data->id).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
                $button .= '<button data-id="'.$data->id.'" data-nama="'.$data->nama.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
                return  $button;
            })

            ->addColumn('keterangan_lengkap', function($data)
            {
                return meta_description($data->keterangan);
            })
    
            ->addIndexColumn()
            ->rawColumns(['option','image','keterangan_lengkap'])
            ->make(true);
    }
}
