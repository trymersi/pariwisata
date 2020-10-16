<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use App\Models\KategoriEkraf;
use Illuminate\Http\Request;
use App\Models\Kabupaten;
use App\Models\Ekraf;
use DataTables;
use Toastr;
use File;
use Auth;

class EkrafController extends Controller
{
    private $data;
    private $ekrafClass;
    private $kabupatenClass;
    private $kategoriEkrafClass;

    public function __construct()
    {
        $this->middleware(['role:super_admin,auth_ekraf,auth_kabupaten']);

        $this->ekrafClass = new Ekraf;
        $this->kabupatenClass = new Kabupaten;
        $this->kategoriEkrafClass = new KategoriEkraf;
        
        $this->data = [
            'category_name' => 'Master',
            'page_name' => 'Ekraf',
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
        return view('dashboard.pages.ekraf.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['kabupaten'] = $this->kabupatenClass->orderBy("nama",'desc')->get();
        $this->data['kategori'] = $this->kategoriEkrafClass->orderBy("nama",'desc')->get();
        return view('dashboard.pages.ekraf.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->level == 1 || Auth::user()->level == 3):
            $validator = Validator::make($request->all(), [
                'kabupaten' => 'required',
                'kategori_ekraf' => 'required',
                'alamat' => 'required',
                'pelaku_usaha'=> 'required',
            ]);
        else:
            $validator = Validator::make($request->all(), [
                'kategori_ekraf' => 'required',
                'alamat' => 'required',
                'pelaku_usaha'=> 'required',
            ]);
        endif;

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $this->ekrafClass->kabupaten_id = (Auth::user()->level == 1 || Auth::user()->level == 3 ) ? $request->kabupaten : Auth::user()->kabupaten_id;
        $this->ekrafClass->kategori_ekraf_id = $request->kategori_ekraf;
        $this->ekrafClass->nama = $request->pelaku_usaha;
        $this->ekrafClass->alamat = $request->alamat;
        $this->ekrafClass->nomor_kontak = $request->nomor_kontak;
        $this->ekrafClass->jenis_usaha = $request->jenis_usaha;
        $this->ekrafClass->status = (Auth::user()->level == 1 || Auth::user()->level == 3 ) ? 3 : 1;
        $this->ekrafClass->save();

        if($this->ekrafClass)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/ekraf');
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
        $this->data['kategori'] = $this->kategoriEkrafClass->orderBy("nama",'desc')->get();
        $this->data['edit'] = $this->ekrafClass->find($id);
        return view('dashboard.pages.ekraf.edit',$this->data);
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
        if(Auth::user()->level == 1 || Auth::user()->level == 3):
            $validator = Validator::make($request->all(), [
                'kabupaten' => 'required',
                'kategori_ekraf' => 'required',
                'alamat' => 'required',
                'pelaku_usaha'=> 'required',
                'status'=> 'required',
            ]);
        else:
            $validator = Validator::make($request->all(), [
                'kategori_ekraf' => 'required',
                'alamat' => 'required',
                'pelaku_usaha'=> 'required',
            ]);
        endif;

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $edit = $this->ekrafClass->find($id);
        $edit->kabupaten_id = (Auth::user()->level == 1 || Auth::user()->level == 3 ) ? $request->kabupaten : Auth::user()->kabupaten_id;
        $edit->kategori_ekraf_id = $request->kategori_ekraf;
        $edit->nama = $request->pelaku_usaha;
        $edit->alamat = $request->alamat;
        $edit->nomor_kontak = $request->nomor_kontak;
        $edit->jenis_usaha = $request->jenis_usaha;
        $edit->status = (Auth::user()->level == 1 || Auth::user()->level == 3 ) ? $request->status : 1;
        $edit->save();

        if($edit)
        {
            Toastr::success('Data Berhasil Diubah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/ekraf');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->ekrafClass->find($id);
        $data->delete();
        return ['status'=>'1'];
    }

    public function table(Request $request)
    {   
        
        $data = $this->ekrafClass->getData();
            return DataTables::of($data)
            ->addColumn('status', function($data)
            {
               return  status($data->status);
            })
            ->addColumn('option', function($data)
            {
                $button = '<a href="'.url('dashboard/ekraf/edit/'.$data->id).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
                $button .= '<button data-id="'.$data->id.'" data-nama="'.$data->nama.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
                return  $button;
            })

            ->addIndexColumn()
            ->rawColumns(['status','option'])
            ->make(true);
    }
}
