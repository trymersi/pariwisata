<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use App\Models\SosialMedia;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\ObjekWisata;
use App\Models\HotelGambar;
use Carbon\Carbon;
use DataTables;
use Toastr;
use File;
use Auth;

class HotelController extends Controller
{
    private $data;
    private $kabupatenClass;
    private $objekWisataClass;
    private $kecamatanClass;
    private $hotelClass;
    private $hotelGambarClass;
    private $sosialMediaClass;
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
        $this->hotelClass = new Hotel;
        $this->objekWisataClass = new ObjekWisata;
        $this->hotelGambarClass = new HotelGambar;
        $this->sosialMediaClass = new SosialMedia;

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
        $this->data['kabupaten'] = $this->kabupatenClass->orderBy("nama",'desc')->get();
        $this->data['objek_wisata'] = $this->objekWisataClass->orderBy("nama",'desc')->get();
        return view('dashboard.pages.hotel.create',$this->data);
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
                'nama'=> 'required',
                'jenis'=> 'required',
                'layanan'=> 'required',
                'gambar_header'=> 'required',
                'deskripsi'=> 'required',
                'alamat'=> 'required',
                'tos' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
            ]);
        else:
            $validator = Validator::make($request->all(), [
                'nama'=> 'required',
                'jenis'=> 'required',
                'layanan'=> 'required',
                'gambar_header'=> 'required',
                'deskripsi'=> 'required',
                'alamat'=> 'required',
                'tos' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
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
                $filepath = public_path('uploads/images/deskripsi-hotel').'/'.$filename.'.'.$mimetype;
                $nama = $filename.'.'.$mimetype;
                $image = Image::make($src)
                        ->encode($mimetype, 75)
                        ->save($filepath);
                $truepath = asset('uploads/images/deskripsi-hotel').'/'.$filename.'.'.$mimetype;
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
            $destination = public_path('uploads/images/gambar-header-hotel');
            $filename_header = $nama_bersih.".".$ext;
            $gambar->move($destination, $filename_header);
        }

        $this->hotelClass->kabupaten_id = $kab_id;
        // $this->hotelClass->objek_wisata_id = $request->objek_wisata;
        $this->hotelClass->nama = $request->nama;
        $this->hotelClass->slug = str_replace(' ','-',strtolower($request->nama));
        $this->hotelClass->deskripsi = $dom->saveHTML();
        $this->hotelClass->jenis = implode(',',$request->jenis);
        $this->hotelClass->layanan = implode(',',$request->layanan);
        $this->hotelClass->gambar = $filename_header;
        $this->hotelClass->latitude = $request->latitude;
        $this->hotelClass->longitude = $request->longitude;
        $this->hotelClass->alamat = $request->alamat;
        $this->hotelClass->status = (Auth::user()->level == 1 || Auth::user()->level == 4 ) ? 3 : 1;
        $this->hotelClass->save();

        if($this->hotelClass)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/hotel');
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
        $this->data['edit'] = $this->hotelClass->find($id);
        $this->data['kabupaten'] = $this->kabupatenClass->orderBy("nama",'desc')->get();
        $this->data['objek_wisata'] = $this->objekWisataClass->orderBy("nama",'desc')->get();
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
        $checklayanan = strpos($this->data['edit']->layanan,",");
        if($checklayanan !== FALSE)
        {
            $layanan = explode(',',$this->data['edit']->layanan);
        }
        else
        {
            $layanan = [$this->data['edit']->layanan];
        }
        $this->data['layanan'] = $layanan;
        return view('dashboard.pages.hotel.edit',$this->data);
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
                'nama'=> 'required',
                'jenis'=> 'required',
                'layanan'=> 'required',
                'deskripsi'=> 'required',
                'alamat'=> 'required',
                'tos' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
            ]);
        else:
            $validator = Validator::make($request->all(), [
                'nama'=> 'required',
                'jenis'=> 'required',
                'layanan'=> 'required',
                'deskripsi'=> 'required',
                'alamat'=> 'required',
                'tos' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
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
                $filepath = public_path('uploads/images/deskripsi-hotel').'/'.$filename.'.'.$mimetype;
                $nama = $filename.'.'.$mimetype;
                $image = Image::make($src)
                        ->encode($mimetype, 75)
                        ->save($filepath);
                $truepath = asset('uploads/images/deskripsi-hotel').'/'.$filename.'.'.$mimetype;
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
            $destination = public_path('uploads/images/gambar-header-hotel');
            $filename_header = $nama_bersih.".".$ext;
            $gambar->move($destination, $filename_header);
        }
        

        $edit = $this->hotelClass->find($id);
        $edit->kabupaten_id = $kab_id;
        // $edit->objek_wisata_id = $request->objek_wisata;
        $edit->nama = $request->nama;
        $edit->slug = $request->nama;
        $edit->latitude = $request->latitude;
        $edit->longitude = $request->longitude;
        $edit->alamat = $request->alamat;
        $edit->deskripsi = $dom->saveHTML();
        $edit->jenis = implode(',',$request->jenis);
        $edit->layanan = implode(',',$request->layanan);
        if(isset($filename_header)):
            $edit->gambar = $filename_header;
        endif;
        $edit->status = (Auth::user()->level == 1 || Auth::user()->level == 4 ) ? $request->status : 1;
        $edit->save();

        if($edit)
        {
            Toastr::success('Data Berhasil Diubah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/hotel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->hotelClass->find($id);

        // $aksebilitas = $this->objekAksebilitasClass->where('hotel_id',$id)->first();
        // if(isset($aksebilitas->id)):
        //     $aksebilitas = $aksebilitas->find($aksebilitas->id);
        //     $aksebilitas->delete();
        // endif;

        // $amenitas = $this->objekAmenitasClass->where('hotel_id',$id)->first();
        // if(isset($amenitas->id)):
        //     $amenitas = $amenitas->find($amenitas->id);
        //     $amenitas->delete();
        // endif;

        // $detail = $this->objekDetailClass->where('hotel_id',$id)->first();
        // if(isset($detail->id)):
        //     $detail = $detail->find($detail->id);
        //     $detail->delete();
        // endif; 

        $gambar = $this->hotelGambarClass->where('hotel_id',$id)->get();
        $path_gambar = public_path('uploads/images/gallery-hotel');
        foreach($gambar as $key)
        {   
            
            if(isset($key->id)):
            $deleteGambar = $this->hotelGambarClass->find($key->id);
            File::delete($path_gambar.'/'.$key->gambar);
            $deleteGambar->delete();
            endif;

        }

        /* DELETE DATA GAMBAR HEADER */
        $path = public_path('uploads/images/gambar-header-hotel');
        File::delete($path.'/'.$data->gambar);

        /* DELETE DATA GAMBAR KETERANGAN*/
        $path_keterangan = public_path('uploads/images/deskripsi-hotel');
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
        
        
        $data = (Auth::user()->level == 7) ? $this->hotelClass->getData(Auth::user()->kabupaten_id) : $this->hotelClass->getData();
            return DataTables::of($data)
            ->addColumn('status', function($data)
            {
               return  status($data->status_hotel);
            })
            ->addColumn('option', function($data)
            {
                $button = '<a href="'.url('dashboard/hotel/edit/'.$data->id).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
                $button .= '<button data-id="'.$data->id.'" data-nama="'.$data->nama_hotel.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
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
                        <a class="dropdown-item" href="'.url("/dashboard/hotel/gambar").'/'.$data->id.'">Gallery Hotel</a>
                        <a class="dropdown-item" href="'.url("/dashboard/hotel/sosial-media").'/'.$data->id.'">Sosial Media</a>
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
    public function gambarIndex($id)
    {  
        $data = $this->hotelClass->find($id);
        $this->data['sub_page'] = $data->nama;
        $this->data['hotel_id'] = $id;
        return view('dashboard.pages.hotel.gambar.index',$this->data); 
    }

    public function gambarTable($id)
    {
        
        $data = $this->hotelGambarClass->where('hotel_id',$id)->orderBy('updated_at','desc')->get();
        
        return DataTables::of($data)
        ->addColumn('option', function($data)
        {
            $hotel = $this->hotelClass->find($data->hotel_id);
            $nama_hotel = $hotel->nama;
            $button = '<a href="'.url('dashboard/hotel/gambar/edit/'.$data->id.'/'.$data->hotel_id).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
            $button .= '<button data-id="'.$data->id.'" data-nama="'.$nama_hotel.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
            return  $button;
        })
        
        ->addColumn('tanggal', function($data)
        {
           return  Carbon::parse($data->updated_at)->diffForHumans();
        })

        ->addColumn('gambar', function($data)
        {
           return  "<img width='250px' src='".asset('uploads/images/gallery-hotel/'.$data->gambar)."'>";
        })
        ->addIndexColumn()
        ->rawColumns(['status','option','gambar','jenis','detail'])
        ->make(true);
    }

    public function gambarCreate($hotel_id)
    {
        
        $data = $this->hotelClass->find($hotel_id);
        $this->data['sub_page'] = $data->nama;
        $this->data['hotel_id'] = $hotel_id;
        $this->data['nama_hotel'] = $data->nama;
        return view('dashboard.pages.hotel.gambar.create',$this->data); 
    }

    public function gambarStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'required',
            'tos' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        if($request->file('gambar'))
        {
            $data = $this->hotelClass->find($request->hotel_id);
            $nama_hotel = bersih($data->nama,'-');
            $i = 1;
            foreach($request->file('gambar') as $key)
            {
                $ext = $key->getClientOriginalExtension();
                $destination = public_path('uploads/images/gallery-hotel');
                $filename = $nama_hotel."-".$i.".".$ext;
                $key->move($destination, $filename);

                $save = new HotelGambar;
                $save->hotel_id = $request->hotel_id;
                $save->gambar = $filename;
                $save->save();
                $i++;
            }

            Toastr::success('Data Berhasil Ditambah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
            return redirect::to('dashboard/hotel/gambar/'.$request->hotel_id);
        }
    }

    public function gambarEdit($id,$hotel_id)
    {
        $data = $this->hotelClass->find($hotel_id);
        $this->data['sub_page'] = $data->nama;
        $this->data['hotel_id'] = $hotel_id;
        $this->data['nama_hotel'] = $data->nama;
        $this->data['edit'] = $this->hotelGambarClass->find($id);
        return view('dashboard.pages.hotel.gambar.edit',$this->data); 
    }

    public function gambarUpdate($id,Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'required',
            'tos' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

            $data_edit = $this->hotelGambarClass->find($id);
            $nama_gambar_old = $data_edit->gambar;

            $nama_gambar_old = explode('.',$nama_gambar_old);
            $nama_gambar_old = $nama_gambar_old[0];

            $gambar = $request->file('gambar');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/gallery-hotel');
            $filename = $nama_gambar_old.".".$ext;
            $gambar->move($destination, $filename);

            $edit = HotelGambar::find($id);
            $edit->gambar = $filename;
            $edit->save();

            if($edit)
            {
                Toastr::success('Data Berhasil Diubah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
                return redirect::to('dashboard/hotel/gambar/'.$request->hotel_id);
            }
    }

    public function gambarDestroy($id)
    {
        $delete = $this->hotelGambarClass->find($id);
        $path = public_path('uploads/images/gallery-hotel');
        File::delete($path.'/'.$delete->gambar);
        $delete->delete();
        return ['status'=>'1'];
    }

    public function sosmedIndex($id)
    {  
        $data = $this->hotelClass->find($id);
        $this->data['sub_page'] = $data->nama;
        $this->data['id'] = $id;
        return view('dashboard.pages.hotel.sosial-media.index',$this->data); 
    }

    public function sosmedTable($id)
    {
        
        $data = $this->sosialMediaClass->where('id_tempat',$id)->where('kode_tempat',3)->orderBy('updated_at','desc')->get();
        
        return DataTables::of($data)
        ->addColumn('option', function($data)
        {
            
            $button = '<a href="'.url('dashboard/hotel/sosial-media/edit/'.$data->id.'/'.$data->id_tempat).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
            $button .= '<button data-id="'.$data->id.'" data-nama="'.$data->nama.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
            return  $button;
        })
        
        ->addColumn('tanggal', function($data)
        {
           return  Carbon::parse($data->updated_at)->diffForHumans();
        })

        ->addColumn('sosmed', function($data)
        {
           return  getSosmed($data->kode_sosmed);
        })
        ->addIndexColumn()
        ->rawColumns(['status','option','sosmed','tanggal'])
        ->make(true);
    }

    public function sosmedCreate($restaurant_id)
    {
        $data = $this->hotelClass->find($restaurant_id);
        $this->data['sub_page'] = $data->nama;
        $this->data['id'] = $restaurant_id;
        return view('dashboard.pages.hotel.sosial-media.create',$this->data); 
    }

    public function sosmedStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sosial_media' => 'required',
            'alamat_sosial_media' => 'required',
            'tos' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }
        
        $this->sosialMediaClass->id_tempat = $request->id;
        $this->sosialMediaClass->kode_tempat = 3;
        $this->sosialMediaClass->kode_sosmed = $request->sosial_media;
        $this->sosialMediaClass->alamat_sosmed = $request->alamat_sosial_media;
        $this->sosialMediaClass->save();

        Toastr::success('Data Berhasil Ditambah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        return redirect::to('dashboard/hotel/sosial-media/'.$request->id);
    }

    public function sosmedEdit($id,$id_tempat)
    {   
        $data = $this->hotelClass->find($id_tempat);
        $this->data['sub_page'] = $data->nama;
        $this->data['id'] = $id_tempat;
        $this->data['edit'] = $this->sosialMediaClass->find($id);
        return view('dashboard.pages.hotel.sosial-media.edit',$this->data); 
    }

    public function sosmedUpdate($id,Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sosial_media' => 'required',
            'alamat_sosial_media' => 'required',
            'tos' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }
        
        $edit =  SosialMedia::find($id);
        $edit->id_tempat = $request->id;
        $edit->kode_tempat = 3;
        $edit->kode_sosmed = $request->sosial_media;
        $edit->alamat_sosmed = $request->alamat_sosial_media;
        $edit->save();

        Toastr::success('Data Berhasil Diubah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        return redirect::to('dashboard/hotel/sosial-media/'.$request->id);
    }

    public function sosmedDestroy($id)
    {
        $delete = $this->sosialMediaClass->find($id);
        $delete->delete();
        return ['status'=>'1'];
    }

}
