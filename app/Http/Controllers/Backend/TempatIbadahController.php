<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ObjekWisata;
use App\Models\TempatIbadah;
use App\Models\Kabupaten;
use Carbon\Carbon;
use DataTables;
use Toastr;
use File;
use Auth;

class TempatIbadahController extends Controller
{
    private $data;
    private $kabupatenClass;
    private $tempatIbadahClass;
    private $objekWisataClass;


    public function __construct()
    {
        $this->middleware(['role:super_admin,auth_sdp,auth_kabupaten']);

        $this->kabupatenClass = new Kabupaten;
        $this->objekWisataClass = new ObjekWisata;
        $this->tempatIbadahClass = new TempatIbadah;

        $this->data = [
            'category_name' => 'Objek',
            'page_name' => 'Tempat Ibadah',
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
        return view('dashboard.pages.tempat-ibadah.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['kabupaten'] = $this->kabupatenClass->orderBy("nama",'desc')->get();
        return view('dashboard.pages.tempat-ibadah.create',$this->data);
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
                'nama_tempat_ibadah' => 'required',
                'agama'=> 'required',
                'alamat'=> 'required',
                'gambar'=> 'required',
                'latitude'=> 'required',
                'longitude'=> 'required',
                'tos' => 'required',
            ]);
        else:
            $validator = Validator::make($request->all(), [
                'nama_tempat_ibadah' => 'required',
                'agama'=> 'required',
                'alamat'=> 'required',
                'gambar'=> 'required',
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

        $nama_bersih = bersih($request->nama_tempat_ibadah,'-');

        if($request->file('gambar'))
        {
            $gambar = $request->file('gambar');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/gambar-header-tempat-ibadah');
            $filename_header = $nama_bersih.".".$ext;
            $gambar->move($destination, $filename_header);
        }

        $this->tempatIbadahClass->kabupaten_id = $kab_id;
        // $this->tempatIbadahClass->objek_wisata_id = $request->objek_wisata;
        $this->tempatIbadahClass->nama = $request->nama_tempat_ibadah;
        $this->tempatIbadahClass->slug = $nama_bersih;
        $this->tempatIbadahClass->alamat = $request->alamat;
        $this->tempatIbadahClass->gambar = $filename_header;
        $this->tempatIbadahClass->latitude = $request->latitude;
        $this->tempatIbadahClass->longitude = $request->longitude;
        $this->tempatIbadahClass->agama = $request->agama;
        $this->tempatIbadahClass->status = (Auth::user()->level == 1 || Auth::user()->level == 4 ) ? 3 : 1;
        $this->tempatIbadahClass->save();

        if($this->tempatIbadahClass)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/tempat-ibadah');
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
        $this->data['edit'] = $this->tempatIbadahClass->find($id);
        $this->data['kabupaten'] = $this->kabupatenClass->orderBy("nama",'desc')->get();
        $this->data['objek_wisata'] = $this->objekWisataClass->getDataByKab($this->data['edit']->kabupaten_id);
        return view('dashboard.pages.tempat-ibadah.edit',$this->data);
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
                'nama_tempat_ibadah' => 'required',
                'agama'=> 'required',
                'alamat'=> 'required',
                'latitude'=> 'required',
                'longitude'=> 'required',
                'status' => 'required',
                'tos' => 'required',
            ]);
        else:
            $validator = Validator::make($request->all(), [
                'nama_tempat_ibadah' => 'required',
                'agama'=> 'required',
                'alamat'=> 'required',
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

        $nama_bersih = bersih($request->nama_tempat_ibadah,'-');

        if($request->file('gambar'))
        {
            $gambar = $request->file('gambar');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/gambar-header-tempat-ibadah');
            $filename_header = $nama_bersih.".".$ext;
            $gambar->move($destination, $filename_header);
        }

        $edit = TempatIbadah::find($id);
        $edit->kabupaten_id = $kab_id;
        // $edit->objek_wisata_id = $request->objek_wisata;
        $edit->nama = $request->nama_tempat_ibadah;
        $edit->slug = $nama_bersih;
        $edit->alamat = $request->alamat;
        if(isset($filename_header)):
            $edit->gambar = $filename_header;
        endif;
        $edit->latitude = $request->latitude;
        $edit->longitude = $request->longitude;
        $edit->agama = $request->agama;
        $edit->status = (Auth::user()->level == 1 || Auth::user()->level == 4 ) ? $request->status : 1;
        $edit->save();

        if($edit)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/tempat-ibadah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->tempatIbadahClass->find($id);

        
        /* DELETE DATA GAMBAR HEADER */
        $path = public_path('uploads/images/gambar-header-tempat-ibadah');
        File::delete($path.'/'.$data->gambar);
    
        $data->delete();
        return ['status'=>'1'];
    }

    public function table(Request $request)
    {   
        
        $data = (Auth::user()->level == 7) ? $this->tempatIbadahClass->getData(Auth::user()->kabupaten_id) : $this->tempatIbadahClass->getData();
            return DataTables::of($data)

            ->addColumn('status', function($data)
            {
               return  status($data->status);
            })

            ->addColumn('option', function($data)
            {
                $button = '<a href="'.url('dashboard/tempat-ibadah/edit/'.$data->id).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
                $button .= '<button data-id="'.$data->id.'" data-nama="'.$data->nama.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
                return  $button;
            })

            ->addColumn('gambar', function($data)
            {
               return  "<img width='150px' src='".asset('uploads/images/gambar-header-tempat-ibadah/'.$data->gambar)."'>";
            })

            ->addColumn('nama_objek_wisata', function($data)
            {
               return  isset($data->nama_objek_wisata) ? $data->nama_objek_wisata : '-';
            })

            ->addIndexColumn()
            ->rawColumns(['status','option','gambar'])
            ->make(true);
    }

    public function getListObjekWisata($id_kabupaten)
    {
        $get = $this->objekWisataClass->getDataByKab($id_kabupaten);
        return response()->json($get);
    }
}
