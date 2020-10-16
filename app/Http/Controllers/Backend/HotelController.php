<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Carbon\Carbon;
use DataTables;
use Toastr;
use File;
use Auth;

class HotelController extends Controller
{
    private $data;
    private $kabupatenClass;
    private $kecamatanClass;
    private $HotelClass;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['role:super_admin,auth_sdp,auth_kabupaten']);

        $this->kabupatenClass = new Kabupaten;
        $this->kecamatanClass = new Kecamatan;
        $this->HotelClass = new Hotel;

        $this->data = [
            'category_name' => 'Hotel',
            'page_name' => 'Hotel',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'alt_menu' => 1,
        ];
    }
    public function index()
    {
        return view('dashboard.pages.hotel.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function table(Request $request)
    {   
        
        
        $data = (Auth::user()->level == 7) ? $this->HotelClass->getData(Auth::user()->kabupaten_id) : $this->HotelClass->getData();
            return DataTables::of($data)
            ->addColumn('status', function($data)
            {
               return  status($data->status_hotel);
            })
            ->addColumn('option', function($data)
            {
                $button = '<a href="'.url('dashboard/hotel/edit/'.$data->id).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
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
                        <a class="dropdown-item" href="'.url("/dashboard/hotel/gambar").'">Aksesibilitas</a>
                        <a class="dropdown-item" href="'.url("/dashboard/hotel/gambar").'">Amenitas</a>
                        <a class="dropdown-item" href="'.url("/dashboard/hotel/gambar").'">Detail Objek Wisata</a>
                        <a class="dropdown-item" href="'.url("/dashboard/hotel/gambar").'/'.$data->id.'">Gambar Gallery</a>
                    </div>
                </div>';

               
                return  $button;
            })

            ->addColumn('gambar', function($data)
            {
               return  "<img width='150px' src='".asset('uploads/images/gambar-header-hotel/'.$data->gambar_hotel)."'>";
            })

            ->addColumn('jenis', function($data)
            {
               return  jenisWisata($data->jenis);
            })
            

            ->addIndexColumn()
            ->rawColumns(['status','option','gambar','jenis','detail'])
            ->make(true);
    }
}
