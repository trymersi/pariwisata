<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use App\Models\CindramataDetail;
use Illuminate\Http\Request;
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

    public function __construct()
    {
        $this->middleware(['role:super_admin,auth_sdp,auth_kabupaten']);

        $this->kabupatenClass = new Kabupaten;
        $this->objekWisataClass = new ObjekWisata;
        $this->cendramataClass = new Cindramata;
        $this->cendramataDetailClass = new CindramataDetail;

        $this->data = [
            'category_name' => 'Objek',
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
                'alamat'=> 'required',
                'gambar'=> 'required',
                'nomor_kontak'=> 'required',
                'latitude'=> 'required',
                'longitude'=> 'required',
                'tos' => 'required',
            ]);
        else:
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'alamat'=> 'required',
                'gambar'=> 'required',
                'nomor_kontak'=> 'required',
                'latitude'=> 'required',
                'longitude'=> 'required',
                'tos' => 'required',
            ]);
        endif;

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $latLong = $request->latitude.",".$request->longitude;
        $kab_id = (Auth::user()->level == 1 || Auth::user()->level == 4 ) ? $request->kabupaten : Auth::user()->kabupaten_id;
        $kabLatLong = $this->kabupatenClass->find($kab_id);
        $kabLatLong = $kabLatLong->latitude.",".$kabLatLong->longitude;

        $nama_bersih = bersih($request->nama,'-');

        if($request->file('gambar'))
        {
            $gambar = $request->file('gambar');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/gambar-header-cindramata');
            $filename_header = $nama_bersih.".".$ext;
            $gambar->move($destination, $filename_header);
        }

        $this->cendramataClass->kabupaten_id = $kab_id;
        $this->cendramataClass->objek_wisata_id = $request->objek_wisata;
        $this->cendramataClass->nama = $request->nama;
        $this->cendramataClass->slug = $nama_bersih;
        $this->cendramataClass->alamat = $request->alamat;
        $this->cendramataClass->gambar = $filename_header;
        $this->cendramataClass->latitude = $request->latitude;
        $this->cendramataClass->longitude = $request->longitude;
        $this->cendramataClass->nomor_kontak = $request->nomor_kontak;
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
                'alamat'=> 'required',
                'gambar'=> 'required',
                'nomor_kontak'=> 'required',
                'latitude'=> 'required',
                'longitude'=> 'required',
                'tos' => 'required',
                'status' => 'required',
            ]);
        else:
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'alamat'=> 'required',
                'gambar'=> 'required',
                'nomor_kontak'=> 'required',
                'latitude'=> 'required',
                'longitude'=> 'required',
                'tos' => 'required',
            ]);
        endif;

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $latLong = $request->latitude.",".$request->longitude;
        $kab_id = (Auth::user()->level == 1 || Auth::user()->level == 4 ) ? $request->kabupaten : Auth::user()->kabupaten_id;
        $kabLatLong = $this->kabupatenClass->find($kab_id);
        $kabLatLong = $kabLatLong->latitude.",".$kabLatLong->longitude;

        $nama_bersih = bersih($request->nama,'-');

        if($request->file('gambar'))
        {
            $gambar = $request->file('gambar');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/gambar-header-cindramata');
            $filename_header = $nama_bersih.".".$ext;
            $gambar->move($destination, $filename_header);
        }

        $edit = Cindramata::find($id);
        $edit->kabupaten_id = $kab_id;
        $edit->objek_wisata_id = $request->objek_wisata;
        $edit->nama = $request->nama;
        $edit->slug = $nama_bersih;
        $edit->alamat = $request->alamat;
        $edit->gambar = $filename_header;
        $edit->latitude = $request->latitude;
        $edit->longitude = $request->longitude;
        $edit->nomor_kontak = $request->nomor_kontak;
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
                        <a class="dropdown-item" href="'.url("/dashboard/cindramata/detail").'/'.$data->id.'">Produk Cindramata</a>
                        <a class="dropdown-item" href="'.url("/dashboard/cindramata/gambar").'/'.$data->id.'">Gambar Gallery</a>
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
}
