<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\SadarWisata;
use DataTables;
use Toastr;
use File;
use Auth;

class SadarWisataController extends Controller
{
    private $data;
    private $sadarWisata;
    private $kabupatenClass;
    private $kecamatanClass;

    public function __construct()
    {
        $this->middleware(['role:super_admin,auth_sdp,auth_kabupaten']);

        $this->kabupatenClass = new Kabupaten;
        $this->sadarWisata = new SadarWisata;
        $this->kecamatanClass = new Kecamatan;

        $this->data = [
            'category_name' => 'Sadar Wisata',
            'page_name' => 'Sadar Wisata',
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
        return view('dashboard.pages.sadar-wisata.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['kabupaten'] = $this->kabupatenClass->orderBy("nama",'desc')->get();
        return view('dashboard.pages.sadar-wisata.create',$this->data);
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
                'nama'=> 'required',
                'alamat'=> 'required',
                'potensi'=> 'required',
                'kontak'=> 'required',
                'tos' => 'required',
            ]);
        else:
            $validator = Validator::make($request->all(), [
                'kecamatan' => 'required',
                'nama'=> 'required',
                'alamat'=> 'required',
                'potensi'=> 'required',
                'kontak'=> 'required',
                'tos' => 'required',
            ]);
        endif;

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $kab_id = (Auth::user()->level == 1 || Auth::user()->level == 4 ) ? $request->kabupaten : Auth::user()->kabupaten_id;

        $this->sadarWisata->kabupaten_id = $kab_id;
        $this->sadarWisata->kecamatan_id = $request->kecamatan;
        $this->sadarWisata->nama = $request->nama;
        $this->sadarWisata->alamat = $request->alamat;
        $this->sadarWisata->potensi_wisata = implode(',',$request->potensi);
        $this->sadarWisata->kontak = $request->kontak;
        $this->sadarWisata->status = (Auth::user()->level == 1 || Auth::user()->level == 4 ) ? 3 : 1;
        $this->sadarWisata->save();

        if($this->sadarWisata)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/sadar-wisata');
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
        
        $this->data['edit'] = $this->sadarWisata->find($id);
        $this->data['kabupaten'] = $this->kabupatenClass->orderBy("nama",'desc')->get();
        $this->data['kecamatan'] = $this->kecamatanClass->getListByKab($this->data['edit']->kabupaten_id);
        $cekPotensi = strpos($this->data['edit']->potensi_wisata,',');
        if($cekPotensi !== FALSE)
        {
            $potensi = explode(',',$this->data['edit']->potensi_wisata);
        }
        else
        {
            $potensi = [$this->data['edit']->potensi_wisata];
        }
        $this->data['potensi'] = $potensi;
        return view('dashboard.pages.sadar-wisata.edit',$this->data);
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
                'nama'=> 'required',
                'alamat'=> 'required',
                'potensi'=> 'required',
                'kontak'=> 'required',
                'status'=> 'required',
                'tos' => 'required',
            ]);
        else:
            $validator = Validator::make($request->all(), [
                'kecamatan' => 'required',
                'nama'=> 'required',
                'alamat'=> 'required',
                'potensi'=> 'required',
                'kontak'=> 'required',
                'tos' => 'required',
            ]);
        endif;

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $kab_id = (Auth::user()->level == 1 || Auth::user()->level == 4 ) ? $request->kabupaten : Auth::user()->kabupaten_id;

        $edit = SadarWisata::find($id);
        $edit->kabupaten_id = $kab_id;
        $edit->kecamatan_id = $request->kecamatan;
        $edit->nama = $request->nama;
        $edit->alamat = $request->alamat;
        $edit->potensi_wisata = implode(',',$request->potensi);
        $edit->kontak = $request->kontak;
        $edit->status = (Auth::user()->level == 1 || Auth::user()->level == 4 ) ? $request->status : 1;
        $edit->save();

        if($this->sadarWisata)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/sadar-wisata');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->sadarWisata->find($id);
        $data->delete();
        return ['status'=>'1'];
    }

    public function table(Request $request)
    {   
        $data = (Auth::user()->level == 7) ? $this->sadarWisata->getData(Auth::user()->kabupaten_id) : $this->sadarWisata->getData();
            return DataTables::of($data)
            ->addColumn('status', function($data)
            {
               return  status($data->status);
            })
            ->addColumn('option', function($data)
            {
                $button = '<a href="'.url('dashboard/sadar-wisata/edit/'.$data->id).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
                $button .= '<button data-id="'.$data->id.'" data-nama="'.$data->nama.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
                return  $button;
            })

            ->addIndexColumn()
            ->rawColumns(['status','option'])
            ->make(true);
    }
}
