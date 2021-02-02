<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ObjekWisata;
use App\Models\Kabupaten;
use App\Models\Event;
use App\Models\Post;
use Carbon\Carbon;
use DataTables;
use Toastr;
use File;
use Auth;

class EventController extends Controller
{
    private $data;
    private $kabupatenClass;
    private $objekWisataClass;
    private $eventClass;

    public function __construct()
    {
        $this->middleware(['role:super_admin,auth_destinasi,auth_ekraf,auth_pemasaran,auth_upt,auth_kabupaten']);


        $this->kabupatenClass = new Kabupaten;
        $this->objekWisataClass = new ObjekWisata;
        $this->eventClass = new Event;

        $this->data = [
            'category_name' => 'Pemasaran',
            'page_name' => 'Event',
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
        return view('dashboard.pages.event.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['kabupaten'] = $this->kabupatenClass->orderBy("nama",'desc')->get();
        return view('dashboard.pages.event.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->level != 7):
            $validator = Validator::make($request->all(), [
                'kabupaten' => 'required',
                'nama_event' => 'required',
                'gambar_header'=> 'required',
                'tanggal_mulai'=> 'required',
                'tanggal_selesai'=> 'required',
                'tos' => 'required',
            ]);
        else:
            $validator = Validator::make($request->all(), [
                'nama_event' => 'required',
                'gambar_header'=> 'required',
                'tanggal_mulai'=> 'required',
                'tanggal_selesai'=> 'required',
                'tos' => 'required',
            ]);
        endif;

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $kab_id = (Auth::user()->level != 7) ? $request->kabupaten : Auth::user()->kabupaten_id;

        $nama_bersih = bersih($request->nama_event,'-');

        if($request->file('gambar_header'))
        {
            $gambar = $request->file('gambar_header');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/gambar-header-event');
            $filename_header = $nama_bersih.".".$ext;
            $gambar->move($destination, $filename_header);
        }

        $this->eventClass->kabupaten_id = $kab_id;
        $this->eventClass->objek_wisata_id = $request->objek_wisata;
        $this->eventClass->nama = $request->nama_event;
        $this->eventClass->slug = $nama_bersih;
        $this->eventClass->tanggal_mulai = date("Y-m-d",strtotime($request->tanggal_mulai));
        $this->eventClass->tanggal_selesai = date("Y-m-d",strtotime($request->tanggal_selesai));
        $this->eventClass->gambar_header = $filename_header;
        $this->eventClass->status = (Auth::user()->level == 7 ) ? 1 : 3;        
        $this->eventClass->save();

        if($this->eventClass)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/event');
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
        $this->data['edit'] = $this->eventClass->find($id);
        $this->data['objek_wisata'] = $this->objekWisataClass->getDataByKab($this->data['edit']->kabupaten_id);
        return view('dashboard.pages.event.edit',$this->data);
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
        if(Auth::user()->level != 7):
            $validator = Validator::make($request->all(), [
                'kabupaten' => 'required',
                'nama_event' => 'required',
                'tanggal_mulai'=> 'required',
                'tanggal_selesai'=> 'required',
                'status'=> 'required',
                'tos' => 'required',
            ]);
        else:
            $validator = Validator::make($request->all(), [
                'nama_event' => 'required',
                'gambar_header'=> 'required',
                'tanggal_mulai'=> 'required',
                'tanggal_selesai'=> 'required',
                'tos' => 'required',
            ]);
        endif;

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $kab_id = (Auth::user()->level != 7) ? $request->kabupaten : Auth::user()->kabupaten_id;

        $nama_bersih = bersih($request->nama_event,'-');

        if($request->file('gambar_header'))
        {
            $gambar = $request->file('gambar_header');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/gambar-header-event');
            $filename_header = $nama_bersih.".".$ext;
            $gambar->move($destination, $filename_header);
        }

        $edit = Event::find($id);
        $edit->kabupaten_id = $kab_id;
        $edit->objek_wisata_id = $request->objek_wisata;
        $edit->nama = $request->nama_event;
        $edit->slug = $nama_bersih;
        $edit->tanggal_mulai = date("Y-m-d",strtotime($request->tanggal_mulai));
        $edit->tanggal_selesai = date("Y-m-d",strtotime($request->tanggal_selesai));
        if(isset($filename_header)):
            $edit->gambar_header = $filename_header;
        endif;
        $edit->status = (Auth::user()->level == 7 ) ? 1 : $request->status;        
        $edit->save();

        if($edit)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/event');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->eventClass->find($id);
        
        /* DELETE DATA GAMBAR */
        $path = public_path('uploads/images/gambar-header-event');
        File::delete($path.'/'.$data->gambar_header);

        $data->delete();
        return ['status'=>'1'];
    }

    public function table(Request $request)
    {   
        
        $data = (Auth::user()->level == 7) ? $this->eventClass->getData(Auth::user()->kabupaten_id) : $this->eventClass->getData();
            return DataTables::of($data)
            ->addColumn('option', function($data)
            {
                $button = '<a href="'.url('dashboard/event/edit/'.$data->id).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
                $button .= '<button data-id="'.$data->id.'" data-nama="'.$data->nama.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
                return  $button;
            })

            ->addColumn('tanggal', function($data)
            {
               return  date("d/m/Y",strtotime($data->tanggal_mulai))." s/d ". date("d/m/Y",strtotime($data->tanggal_selesai));
            })

            ->addColumn('gambar', function($data)
            {
               return  "<img width='150px' src='".asset('uploads/images/gambar-header-event/'.$data->gambar_header)."'>";
            })

            ->addColumn('status', function($data)
            {
               return  status($data->status);
            })
            
            
            ->addIndexColumn()
            ->rawColumns(['tanggal','option','gambar','status'])
            ->make(true);
    }

    public function getListObjekWisata($id_kabupaten)
    {
        $get = $this->objekWisataClass->getDataByKab($id_kabupaten);
        return response()->json($get);
    }
}
