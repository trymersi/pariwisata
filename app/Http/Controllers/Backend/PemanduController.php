<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\ObjekWisata;
use App\Models\PemanduWisata;
use DataTables;
use Toastr;
use File;
use Auth;

class PemanduController extends Controller
{
    private $data;
    private $pemanduWisata;
    private $kabupatenClass;
    private $kecamatanClass;
    private $objekWisata;

    public function __construct()
    {
        $this->middleware(['role:super_admin,auth_sdp,auth_kabupaten']);

        $this->kabupatenClass = new Kabupaten;
        $this->pemanduWisata = new PemanduWisata;
        $this->kecamatanClass = new Kecamatan;
        $this->objekWisata = new ObjekWisata;

        $this->data = [
            'category_name' => 'Pemandu',
            'page_name' => 'Pemandu',
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
        return view('dashboard.pages.pemandu.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['kabupaten'] = $this->kabupatenClass->orderBy("nama",'desc')->get();
        return view('dashboard.pages.pemandu.create',$this->data);
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
                'objek' => 'required',
                'nama'=> 'required',
                'alamat'=> 'required',
                'bahasa'=> 'required',
                'kontak'=> 'required',
                'tos' => 'required',
            ]);
        else:
            $validator = Validator::make($request->all(), [
                'kecamatan' => 'required',
                'objek'=> 'required',
                'alamat'=> 'required',
                'bahasa'=> 'required',
                'kontak'=> 'required',
                'tos' => 'required',
            ]);
        endif;

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $kab_id = (Auth::user()->level == 1 || Auth::user()->level == 4 ) ? $request->kabupaten : Auth::user()->kabupaten_id;

        $this->pemanduWisata->kabupaten_id = $kab_id;
        $this->pemanduWisata->objek_wisata_id = $request->objek;
        $this->pemanduWisata->nama = $request->nama;
        $this->pemanduWisata->alamat = $request->alamat;
        $this->pemanduWisata->bahasa = implode(',',$request->bahasa);
        $this->pemanduWisata->nomor_kontak = $request->kontak;
        $this->pemanduWisata->status = (Auth::user()->level == 1 || Auth::user()->level == 4 ) ? 3 : 1;
        $this->pemanduWisata->save();

        ($this->pemanduWisata) ? Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]) : Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
        return redirect::to('dashboard/pemandu-wisata');
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
        
        $this->data['edit'] = $this->pemanduWisata->find($id);
        $this->data['kabupaten'] = $this->kabupatenClass->orderBy("nama",'desc')->get();
        $this->data['kecamatan'] = $this->objekWisata->getDataByKab($this->data['edit']->kabupaten_id);
        $cekPotensi = strpos($this->data['edit']->bahasa,',');
        if($cekPotensi !== FALSE)
        {
            $potensi = explode(',',$this->data['edit']->bahasa);
        }
        else
        {
            $potensi = [$this->data['edit']->bahasa];
        }
        $this->data['potensi'] = $potensi;
        return view('dashboard.pages.pemandu.edit',$this->data);
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
                'objek' => 'required',
                'nama'=> 'required',
                'alamat'=> 'required',
                'bahasa'=> 'required',
                'kontak'=> 'required',
                'status'=> 'required',
                'tos' => 'required',
            ]);
        else:
            $validator = Validator::make($request->all(), [
                'objek' => 'required',
                'nama'=> 'required',
                'alamat'=> 'required',
                'bahasa'=> 'required',
                'kontak'=> 'required',
                'tos' => 'required',
            ]);
        endif;

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $kab_id = (Auth::user()->level == 1 || Auth::user()->level == 4 ) ? $request->kabupaten : Auth::user()->kabupaten_id;

        $edit = PemanduWisata::find($id);
        $edit->kabupaten_id = $kab_id;
        $edit->objek_wisata_id = $request->objek;
        $edit->nama = $request->nama;
        $edit->alamat = $request->alamat;
        $edit->bahasa = implode(',',$request->bahasa);
        $edit->nomor_kontak = $request->kontak;
        $edit->status = (Auth::user()->level == 1 || Auth::user()->level == 4 ) ? $request->status : 1;
        $edit->save();

        ($edit) ? Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]) :Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
       
        return redirect::to('dashboard/pemandu-wisata');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->pemanduWisata->find($id);
        $data->delete();
        return ['status'=>'1'];
    }

    public function table(Request $request)
    {   
        $data = (Auth::user()->level == 7) ? $this->pemanduWisata->getData(Auth::user()->kabupaten_id) : $this->pemanduWisata->getData();
            return DataTables::of($data)
            ->addColumn('status', function($data)
            {
               return  status($data->status);
            })
            ->addColumn('option', function($data)
            {
                $button = '<a href="'.url('dashboard/pemandu-wisata/edit/'.$data->id).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
                $button .= '<button data-id="'.$data->id.'" data-nama="'.$data->nama.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
                return  $button;
            })

            ->addIndexColumn()
            ->rawColumns(['status','option'])
            ->make(true);
    }

    public function objekWisataByKab($id)
    {
        $get = $this->objekWisata->getDataByKab($id);
        return response()->json($get);
    }
}
