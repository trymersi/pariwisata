<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Travel;
use DataTables;
use Toastr;
use File;
use Auth;

class TravelController extends Controller
{
    private $data;
    private $travelClass;
    private $kabupatenClass;
    private $kecamatanClass;

    public function __construct()
    {
        $this->middleware(['role:super_admin,auth_pemasaran']);

        $this->kabupatenClass = new Kabupaten;
        $this->travelClass = new Travel;
        $this->kecamatanClass = new Kecamatan;

        $this->data = [
            'category_name' => 'Objek',
            'page_name' => 'Travel',
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
        return view('dashboard.pages.travel.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['kabupaten'] = $this->kabupatenClass->orderBy("nama",'desc')->get();
        return view('dashboard.pages.travel.create',$this->data);
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
            'nama'=> 'required',
            'alamat'=> 'required',
            'kontak'=> 'required',
            'tos' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $nama_bersih = bersih($request->nama,'-');

        if($request->file('gambar'))
        {
            $destination = public_path('uploads/images/gambar-travel');
            $filename_header = rand().'-'.$nama_bersih.".jpg";
            $gambar = Image::make($request->file('gambar'));
            $gambar->encode('jpg', 60);
            $gambar->resize(500, null, function ($constraint) {$constraint->aspectRatio();});
            if($request->sumber_gambar_header != '')
            {
                $gambar->text("SUMBER : ".$request->sumber_gambar_header, 3, $gambar->height() - 3, function($font) {
                    $font->color('#fdf6e3');
                    $font->size(24);
                });
            }
            $gambar->save($destination.'/'.$filename_header);
        }

        $this->travelClass->kabupaten_id = $request->kabupaten;
        $this->travelClass->nama = $request->nama;
        if(isset($filename_header)):
            $this->travelClass->gambar = $filename_header;
        endif;
        $this->travelClass->sumber_gambar_header = $request->sumber_gambar_header;
        $this->travelClass->alamat = $request->alamat;
        $this->travelClass->kontak = $request->kontak;
        $this->travelClass->save();

        if($this->travelClass)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/travel');
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
        
        $this->data['edit'] = $this->travelClass->find($id);
        $this->data['kabupaten'] = $this->kabupatenClass->orderBy("nama",'desc')->get();
        return view('dashboard.pages.travel.edit',$this->data);
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
            'nama'=> 'required',
            'alamat'=> 'required',
            'kontak'=> 'required',
            'tos' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $nama_bersih = bersih($request->nama,'-');

        if($request->file('gambar'))
        {
            $destination = public_path('uploads/images/gambar-travel');
            $filename_header = rand().'-'.$nama_bersih.".jpg";
            $gambar = Image::make($request->file('gambar'));
            $gambar->encode('jpg', 60);
            $gambar->resize(500, null, function ($constraint) {$constraint->aspectRatio();});
            if($request->sumber_gambar_header != '')
            {
                $gambar->text("SUMBER : ".$request->sumber_gambar_header, 3, $gambar->height() - 3, function($font) {
                    $font->color('#fdf6e3');
                    $font->size(24);
                });
            }
            $gambar->save($destination.'/'.$filename_header);
        }

        $edit = Travel::find($id);
        $edit->kabupaten_id = $request->kabupaten;
        if(isset($filename_header)):
            $edit->gambar = $filename_header;
        endif;
        $edit->sumber_gambar_header = $request->sumber_gambar_header;
        $edit->nama = $request->nama;
        $edit->alamat = $request->alamat;
        $edit->kontak = $request->kontak;
        $edit->status = 3;
        $edit->save();

        if($this->travelClass)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/travel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->travelClass->find($id);
        $data->delete();
        return ['status'=>'1'];
    }

    public function table(Request $request)
    {   
        $data = (Auth::user()->level == 7) ? $this->travelClass->getData(Auth::user()->kabupaten_id) : $this->travelClass->getData();
            return DataTables::of($data)
            ->addColumn('status', function($data)
            {
               return  status($data->status);
            })
            ->addColumn('option', function($data)
            {
                $button = '<a href="'.url('dashboard/travel/edit/'.$data->id).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
                $button .= '<button data-id="'.$data->id.'" data-nama="'.$data->nama.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
                return  $button;
            })

            ->addColumn('gambar', function($data)
            {
               return  "<img width='150px' src='".asset('uploads/images/gambar-travel/'.$data->gambar)."'>";
            })

            ->addIndexColumn()
            ->rawColumns(['status','option','gambar'])
            ->make(true);
    }
}
