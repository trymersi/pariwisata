<?php

namespace App\Http\Controllers\Backend;

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;

use App\Models\objekWisataAksebilitas;
use App\Models\objekWisataAmenitas;
use App\Models\objekWisataDetail;
use App\Models\objekWisataGambar;

use Illuminate\Http\Request;
use App\Models\ObjekWisata;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use DataTables;
use Toastr;
use File;
use Auth;

class ObjekWisataController extends Controller
{
    private $data;
    private $kabupatenClass;
    private $kecamatanClass;
    private $objekWisataClass;
    private $objekAksesibilitasClass;
    private $objekAmenitasClass;
    private $objekDetailClass;
    private $objekGambarClass;
    

    public function __construct()
    {
        $this->middleware(['role:super_admin,auth_destinasi,auth_kabupaten']);

        $this->kabupatenClass = new Kabupaten;
        $this->kecamatanClass = new Kecamatan;
        $this->objekWisataClass = new ObjekWisata;
        $this->objekAksebilitasClass = new objekWisataAksebilitas;
        $this->objekAmenitasClass = new ObjekWisataAmenitas;
        $this->objekDetailClass = new ObjekWisataDetail;
        $this->objekGambarClass = new ObjekWisataGambar;

        $this->data = [
            'category_name' => 'Objek',
            'page_name' => 'Objek Wisata',
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
        return view('dashboard.pages.objek-wisata.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['kabupaten'] = $this->kabupatenClass->orderBy("nama",'desc')->get();
        return view('dashboard.pages.objek-wisata.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->level == 1 || Auth::user()->level == 2):
            $validator = Validator::make($request->all(), [
                'kabupaten' => 'required',
                'kecamatan' => 'required',
                'desa' => 'required',
                'nama'=> 'required',
                'jenis'=> 'required',
                'gambar_header'=> 'required',
                'deskripsi'=> 'required',
                'alamat'=> 'required',
                'tos' => 'required',
            ]);
        else:
            $validator = Validator::make($request->all(), [
                'kecamatan' => 'required',
                'desa' => 'required',
                'nama'=> 'required',
                'jenis'=> 'required',
                'gambar_header'=> 'required',
                'deskripsi'=> 'required',
                'alamat'=> 'required',
                'tos' => 'required',
            ]);
        endif;

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $latLong = $request->latitude.",".$request->longitude;
        $kab_id = (Auth::user()->level == 1 || Auth::user()->level == 2 ) ? $request->kabupaten : Auth::user()->kabupaten_id;
        $kabLatLong = $this->kabupatenClass->find($kab_id);
        $kabLatLong = $kabLatLong->latitude.",".$kabLatLong->longitude;
        $jarak_kabupaten = getDistance($latLong,$kabLatLong);
        $jarak_provinsi = getDistance($latLong,latLongProv());

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
                $filepath = public_path('uploads/images/deskripsi-objek-wisata').'/'.$filename.'.'.$mimetype;
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

        if($request->file('gambar_header'))
        {
            $gambar = $request->file('gambar_header');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/gambar-header-objek-wisata');
            $filename_header = $nama_bersih.".".$ext;
            $gambar->move($destination, $filename_header);
        }

        $this->objekWisataClass->kabupaten_id = $kab_id;
        $this->objekWisataClass->kecamatan_id = $request->kecamatan;
        $this->objekWisataClass->nama = $request->nama;
        $this->objekWisataClass->slug = $request->nama;
        $this->objekWisataClass->deskripsi = $dom->saveHTML();
        $this->objekWisataClass->jenis = implode(',',$request->jenis);
        $this->objekWisataClass->video_promosi = ($request->video_promosi) ? $request->video_promosi : "#";
        $this->objekWisataClass->gambar_header = $filename_header;
        $this->objekWisataClass->desa = $request->desa;
        $this->objekWisataClass->latitude = $request->latitude;
        $this->objekWisataClass->longitude = $request->longitude;
        $this->objekWisataClass->alamat = $request->alamat;
        $this->objekWisataClass->status = (Auth::user()->level == 1 || Auth::user()->level == 2 ) ? 3 : 1;
        $this->objekWisataClass->jarak_provinsi = $jarak_kabupaten;
        $this->objekWisataClass->jarak_kabuten = $jarak_provinsi;
        $this->objekWisataClass->save();

        if($this->objekWisataClass)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/objek-wisata');

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
        $this->data['edit'] = $this->objekWisataClass->find($id);
        $check = strpos($this->data['edit']->jenis,",");
        if($check !== FALSE)
        {
            $jenis = explode(',',$this->data['edit']->jenis);
        }
        else
        {
            $jenis = [$this->data['edit']->jenis];
        }
        $this->data['jenis'] = $jenis;
        return view('dashboard.pages.objek-wisata.edit',$this->data);
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
        if(Auth::user()->level == 1 || Auth::user()->level == 2):
            $validator = Validator::make($request->all(), [
                'kabupaten' => 'required',
                'kecamatan' => 'required',
                'desa' => 'required',
                'nama'=> 'required',
                'jenis'=> 'required',
                'deskripsi'=> 'required',
                'alamat'=> 'required',
                'tos' => 'required',
                'status'=> 'required',
            ]);
        else:
            $validator = Validator::make($request->all(), [
                'kecamatan' => 'required',
                'desa' => 'required',
                'nama'=> 'required',
                'jenis'=> 'required',
                'deskripsi'=> 'required',
                'alamat'=> 'required',
                'tos' => 'required',
            ]);
        endif;

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $latLong = $request->latitude.",".$request->longitude;
        $kab_id = (Auth::user()->level == 1 || Auth::user()->level == 2 ) ? $request->kabupaten : Auth::user()->kabupaten_id;
        $kabLatLong = $this->kabupatenClass->find($kab_id);
        $kabLatLong = $kabLatLong->latitude.",".$kabLatLong->longitude;
        $jarak_kabupaten = getDistance($latLong,$kabLatLong);
        $jarak_provinsi = getDistance($latLong,latLongProv());

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
                $filepath = public_path('uploads/images/deskripsi-objek-wisata').'/'.$filename.'.'.$mimetype;
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

        if($request->file('gambar_header'))
        {
            $gambar = $request->file('gambar_header');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/gambar-header-objek-wisata');
            $filename_header = $nama_bersih.".".$ext;
            $gambar->move($destination, $filename_header);
        }
        

        $edit = $this->objekWisataClass->find($id);
        $edit->kabupaten_id = $kab_id;
        $edit->kecamatan_id = $request->kecamatan;
        $edit->nama = $request->nama;
        $edit->slug = $request->nama;
        $edit->deskripsi = $dom->saveHTML();
        $edit->jenis = implode(',',$request->jenis);
        $edit->video_promosi = ($request->video_promosi) ? $request->video_promosi : "#";
        if(isset($filename_header)):
            $edit->gambar_header = $filename_header;
        endif;
        $edit->desa = $request->desa;
        $edit->latitude = $request->latitude;
        $edit->longitude = $request->longitude;
        $edit->alamat = $request->alamat;
        $edit->status = (Auth::user()->level == 1 || Auth::user()->level == 3 ) ? $request->status : 1;
        $edit->jarak_provinsi = $jarak_kabupaten;
        $edit->jarak_kabuten = $jarak_provinsi;
        $edit->save();

        if($edit)
        {
            Toastr::success('Data Berhasil Diubah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/objek-wisata');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->objekWisataClass->find($id);

        $aksebilitas = $this->objekAksebilitasClass->where('objek_wisata_id',$id)->first();
        if(isset($aksebilitas->id)):
            $aksebilitas = $aksebilitas->find($aksebilitas->id);
            $aksebilitas->delete();
        endif;

        $amenitas = $this->objekAmenitasClass->where('objek_wisata_id',$id)->first();
        if(isset($amenitas->id)):
            $amenitas = $amenitas->find($amenitas->id);
            $amenitas->delete();
        endif;

        $detail = $this->objekDetailClass->where('objek_wisata_id',$id)->first();
        if(isset($detail->id)):
            $detail = $detail->find($detail->id);
            $detail->delete();
        endif; 

        $gambar = $this->objekGambarClass->where('objek_wisata_id',$id)->get();
        $path_gambar = public_path('uploads/images/gallery-objek-wisata');
        foreach($gambar as $key)
        {   
            
            if(isset($key->id)):
            $deleteGambar = $this->ObjekWisataGambarClass->find($key->id);
            File::delete($path_gambar.'/'.$key->gambar);
            $deleteGambar->delete();
            endif;

        }

        /* DELETE DATA GAMBAR HEADER */
        $path = public_path('uploads/images/gambar-header-objek-wisata');
        File::delete($path.'/'.$data->gambar_header);

        /* DELETE DATA GAMBAR KETERANGAN*/
        $path_keterangan = public_path('uploads/images/deskripsi-objek-wisata');
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
        
        
        $data = (Auth::user()->level == 7) ? $this->objekWisataClass->getData(Auth::user()->kabupaten_id) : $this->objekWisataClass->getData();
            return DataTables::of($data)
            ->addColumn('status', function($data)
            {
               return  status($data->status);
            })
            ->addColumn('option', function($data)
            {
                $button = '<a href="'.url('dashboard/objek-wisata/edit/'.$data->id).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
                $button .= '<button data-id="'.$data->id.'" data-nama="'.$data->nama.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
                return  $button;
            })

            ->addColumn('detail', function($data)
            {
                $button = '<div class="btn-group mb-4 mr-2">
                    <button type="button" class="btn btn-primary">Tambah</button>
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" style="will-change: transform;">
                        <a class="dropdown-item" href="javascript:void(0);">Aksesibilitas</a>
                        <a class="dropdown-item" href="javascript:void(0);">Amenitas</a>
                        <a class="dropdown-item" href="javascript:void(0);">Detail Objek Wisata</a>
                        <a class="dropdown-item" href="javascript:void(0);">Gambar Gallery</a>
                    </div>
                </div>';

               
                return  $button;
            })

            ->addColumn('gambar', function($data)
            {
               return  "<img width='150px' src='".asset('uploads/images/gambar-header-objek-wisata/'.$data->gambar_header)."'>";
            })

            ->addColumn('jenis', function($data)
            {
               return  jenisWisata($data->jenis);
            })
            

            ->addIndexColumn()
            ->rawColumns(['status','option','gambar','jenis','detail'])
            ->make(true);
    }

    public function getListKecamatan($id_kabupaten)
    {
        $get = $this->kecamatanClass->getListByKab($id_kabupaten);
        return response()->json($get);
    }
}
