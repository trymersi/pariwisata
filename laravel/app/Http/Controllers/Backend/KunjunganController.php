<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kunjungan;
use App\Models\ObjekWisata;
use Carbon\Carbon;
use DataTables;
use Toastr;
use File;
use Auth;

class KunjunganController extends Controller
{
    private $data;
    private $kunjungan;
    private $objekWisata;

    public function __construct()
    {
        $this->middleware(['role:super_admin,auth_pemasaran']);


        $this->kunjungan = new Kunjungan;
        $this->objekWista = new ObjekWisata;

        $this->data = [
            'category_name' => 'Destinasi',
            'page_name' => 'Kunjungan',
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
        return view('dashboard.pages.kunjungan.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['objek'] = $this->objekWista->orderBy("nama",'desc')->where('status',3)->get();
        return view('dashboard.pages.kunjungan.create',$this->data);
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
            'objek_wisata' => 'required',
            'bulan' => 'required',
            'tahun'=> 'required',
            'pengunjung_lokal' => 'required',
            'pengunjung_internasional'=> 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $this->kunjungan->objek_wisata_id = $request->objek_wisata;
        $this->kunjungan->lokal = $request->pengunjung_lokal;
        $this->kunjungan->internasional = $request->pengunjung_internasional;
        $this->kunjungan->bulan = $request->bulan;
        $this->kunjungan->tahun = $request->tahun;  
        $this->kunjungan->save();

        if($this->kunjungan)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/kunjungan');
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
       
        $this->data['edit'] = $this->kunjungan->find($id);
        $this->data['objek'] = $this->objekWista->orderBy("nama",'desc')->where('status',3)->get();
        return view('dashboard.pages.kunjungan.edit',$this->data);
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
            'objek_wisata' => 'required',
            'bulan' => 'required',
            'tahun'=> 'required',
            'pengunjung_lokal' => 'required',
            'pengunjung_internasional'=> 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $nama_bersih = bersih($request->nama_link,'-');

        $edit = Kunjungan::find($id);
        $edit->objek_wisata_id = $request->objek_wisata;
        $edit->lokal = $request->pengunjung_lokal;
        $edit->internasional = $request->pengunjung_internasional;
        $edit->bulan = $request->bulan;
        $edit->tahun = $request->tahun;  
        $edit->save();

        if($edit)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/kunjungan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->kunjungan->find($id);
        
    
        $data->delete();
        return ['status'=>'1'];
    }

    public function table(Request $request)
    {   
        
        $data = $this->kunjungan->getData();
            return DataTables::of($data)
            ->addColumn('option', function($data)
            {
                $button = '<a href="'.url('dashboard/kunjungan/edit/'.$data->id).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
                $button .= '<button data-id="'.$data->id.'" data-nama="'.$data->nama.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
                return  $button;
            })

            ->addColumn('tanggal', function($data)
            {
                return  Carbon::parse($data->updated_at)->diffForHumans();
            })

            ->addColumn('bulantahun', function($data)
            {
                return  getBulan($data->bulan).' '.$data->tahun;
            })
            
            
            ->addIndexColumn()
            ->rawColumns(['tanggal','option','bulantahun','status'])
            ->make(true);
    }

    public function getListObjekWisata($id_kabupaten)
    {
        $get = $this->objekWisataClass->getDataByKab($id_kabupaten);
        return response()->json($get);
    }
}
