<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use DataTables;
use Toastr;
use File;

class KecamatanController extends Controller
{
    private $data;
    private $kabupatenClass;
    private $kecamatanClass;

    public function __construct()
    {
        $this->middleware(['role:super_admin']);

        $this->kabupatenClass = new Kabupaten;
        $this->kecamatanClass = new Kecamatan;

        $this->data = [
            'category_name' => 'Master',
            'page_name' => 'Kecamatan',
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
        return view('dashboard.pages.kecamatan.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['kabupaten'] = $this->kabupatenClass->orderBy("nama",'desc')->get();
        return view('dashboard.pages.kecamatan.create',$this->data);
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
            'kabupaten' => 'required',
            'nama_kecamatan' => 'required',
            'foto_kecamatan' => 'required',
            'tos' => 'required',
            'keterangan_lengkap'=> 'required',
            'longitude'=> 'required',
            'latitude'=> 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $nama_kecamatan_bersih = bersih($request->nama_kecamatan,'_');

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
                $filepath = public_path('uploads/images/keterangan-kecamatan').'/'.$filename.'.'.$mimetype;
                $nama = $filename.'.'.$mimetype;
                $image = Image::make($src)
                        ->encode($mimetype, 75)
                        ->save($filepath);
                $truepath = asset('uploads/images/keterangan-kecamatan').'/'.$filename.'.'.$mimetype;
                $new_src =$truepath;
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }

            $hitungGambar++;
        }

        if($request->file('foto_kecamatan'))
        {
            $foto_kecamatan = $request->file('foto_kecamatan');
            $ext = $foto_kecamatan->getClientOriginalExtension();
            $destination = public_path('uploads/images/foto-kecamatan');
            $filename_kecamatan = $nama_kecamatan_bersih.".".$ext;
            $foto_kecamatan->move($destination, $filename_kecamatan);
        }
        
        $this->kecamatanClass->kabupaten_id = $request->kabupaten;
        $this->kecamatanClass->nama = $request->nama_kecamatan;
        $this->kecamatanClass->keterangan = $dom->saveHTML();
        $this->kecamatanClass->gambar = $filename_kecamatan;
        $this->kecamatanClass->longitude = $request->longitude;
        $this->kecamatanClass->latitude = $request->latitude;
        $this->kecamatanClass->save();

        if($this->kecamatanClass)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/kecamatan');
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
        $this->data['edit'] = $this->kecamatanClass->find($id);
        $this->data['path'] = asset('uploads/images/foto-kecamatan/');
        return view('dashboard.pages.kecamatan.edit',$this->data);
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
            'kabupaten' => 'required',
            'nama_kecamatan' => 'required',
            'tos' => 'required',
            'keterangan_lengkap'=> 'required',
            'longitude'=> 'required',
            'latitude'=> 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $nama_kecamatan_bersih = bersih($request->nama_kecamatan,'_');

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
                $filename = $nama_kecamatan_bersih.'_'.$hitungGambar;
                $filepath = public_path('uploads/images/keterangan-kecamatan').'/'.$filename.'.'.$mimetype;
                $nama = $filename.'.'.$mimetype;
                $image = Image::make($src)
                        ->encode($mimetype, 75)
                        ->save($filepath);
                $truepath = asset('uploads/images/keterangan-kecamatan').'/'.$filename.'.'.$mimetype;
                $new_src =$truepath;
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }

            
            $hitungGambar++;
        }

        if($request->file('foto_kecamatan'))
        {
            $foto_kecamatan = $request->file('foto_kecamatan');
            $ext = $foto_kecamatan->getClientOriginalExtension();
            $filename_kecamatan = $nama_kecamatan_bersih.".".$ext;
            $destination = public_path('uploads/images/foto-kecamatan');
            $foto_kecamatan->move($destination, $filename_kecamatan);
        }
        $edit = $this->kecamatanClass->find($id);
        $edit->kabupaten_id = $request->kabupaten;
        $edit->nama = $request->nama_kecamatan;
        $edit->keterangan = $dom->saveHTML();
        if(isset($filename_kecamatan)):
            $edit->gambar = $filename_kecamatan;
        endif;
        $edit->longitude = $request->longitude;
        $edit->latitude = $request->latitude;
        $edit->save();

        if($edit)
        {
            Toastr::success('Data Berhasil Diubah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/kecamatan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->kecamatanClass->find($id);
        
        /* DELETE DATA GAMBAR */
        $path = public_path('uploads/images/foto-kecamatan');
        File::delete($path.'/'.$data->gambar);

        /* DELETE DATA GAMBAR KETERANGAN*/
        $path_keterangan = public_path('uploads/images/keterangan-kecamatan');
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

    public function getList($id_kabupaten)
    {
        $get = $this->kecamatanClass->getListByKab($id_kabupaten);
        return response()->json($get);
    }

    public function table(Request $request)
    {   
        
        $data = $this->kecamatanClass->getData();
            return DataTables::of($data)
            ->addColumn('image', function($data)
            {
               return  "<img width='150px' src='".asset('uploads/images/foto-kecamatan/'.$data->gambar)."'>";
            })
            ->addColumn('option', function($data)
            {
                $button = '<a href="'.url('dashboard/kecamatan/edit/'.$data->id).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
                $button .= '<button data-id="'.$data->id.'" data-nama="'.$data->nama_kecamatan.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
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
