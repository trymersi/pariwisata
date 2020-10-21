<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use App\Models\RestaurantGambar;
use App\Models\RestaurantMenu;
use Illuminate\Http\Request;
use App\Models\ObjekWisata;
use App\Models\SosialMedia;
use App\Models\Restaurant;
use App\Models\Kabupaten;
use Carbon\Carbon;
use DataTables;
use Toastr;
use File;
use Auth;

class RestaurantController extends Controller
{
    private $data;
    private $kabupatenClass;
    private $restaurantClass;
    private $objekWisataClass;
    private $restaurantGambarClass;
    private $restaurantMenuClass;
    private $sosialMediaClass;

    public function __construct()
    {
        $this->middleware(['role:super_admin,auth_sdp,auth_kabupaten']);

        $this->kabupatenClass = new Kabupaten;
        $this->objekWisataClass = new ObjekWisata;
        $this->restaurantClass = new Restaurant;
        $this->restaurantGambarClass = new RestaurantGambar;
        $this->restaurantMenuClass = new RestaurantMenu;
        $this->sosialMediaClass = new SosialMedia;

        $this->data = [
            'category_name' => 'Objek',
            'page_name' => 'Restaurant',
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
        return view('dashboard.pages.restaurant.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['kabupaten'] = $this->kabupatenClass->orderBy("nama",'desc')->get();
        return view('dashboard.pages.restaurant.create',$this->data);
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
                'nama_restaurant' => 'required',
                'alamat'=> 'required',
                'gambar'=> 'required',
                'nomor_kontak'=> 'required',
                'latitude'=> 'required',
                'longitude'=> 'required',
                'deskripsi'=> 'required',
                'tos' => 'required',
            ]);
        else:
            $validator = Validator::make($request->all(), [
                'nama_restaurant' => 'required',
                'alamat'=> 'required',
                'gambar'=> 'required',
                'nomor_kontak'=> 'required',
                'latitude'=> 'required',
                'longitude'=> 'required',
                'deskripsi'=> 'required',
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

        $nama_bersih = bersih($request->nama_restaurant,'-');

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
                $filepath = public_path('uploads/images/deskripsi-restaurant').'/'.$filename.'.'.$mimetype;
                $nama = $filename.'.'.$mimetype;
                $image = Image::make($src)
                        ->encode($mimetype, 75)
                        ->save($filepath);
                $truepath = asset('uploads/images/deskripsi-restaurant').'/'.$filename.'.'.$mimetype;
                $new_src =$truepath;
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }
            $hitungGambar++;
        }

        if($request->file('gambar'))
        {
            $gambar = $request->file('gambar');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/gambar-header-restaurant');
            $filename_header = $nama_bersih.".".$ext;
            $gambar->move($destination, $filename_header);
        }

        $this->restaurantClass->kabupaten_id = $kab_id;
        $this->restaurantClass->objek_wisata_id = $request->objek_wisata;
        $this->restaurantClass->nama = $request->nama_restaurant;
        $this->restaurantClass->slug = $nama_bersih;
        $this->restaurantClass->alamat = $request->alamat;
        $this->restaurantClass->gambar = $filename_header;
        $this->restaurantClass->latitude = $request->latitude;
        $this->restaurantClass->longitude = $request->longitude;
        $this->restaurantClass->halal = isset($request->halal) ? 1:0;
        $this->restaurantClass->nomor_kontak = $request->nomor_kontak;
        $this->restaurantClass->deskripsi = $dom->saveHTML();
        $this->restaurantClass->status = (Auth::user()->level == 1 || Auth::user()->level == 4 ) ? 3 : 1;
        $this->restaurantClass->save();

        if($this->restaurantClass)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/restaurant');
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
        $this->data['edit'] = $this->restaurantClass->find($id);
        $this->data['kabupaten'] = $this->kabupatenClass->orderBy("nama",'desc')->get();
        $this->data['objek_wisata'] = $this->objekWisataClass->getDataByKab($this->data['edit']->kabupaten_id);
        return view('dashboard.pages.restaurant.edit',$this->data);
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
                'nama_restaurant' => 'required',
                'alamat'=> 'required',
                'gambar'=> 'required',
                'nomor_kontak'=> 'required',
                'latitude'=> 'required',
                'longitude'=> 'required',
                'deskripsi'=> 'required',
                'status' => 'required',
                'tos' => 'required',
            ]);
        else:
            $validator = Validator::make($request->all(), [
                'nama_restaurant' => 'required',
                'alamat'=> 'required',
                'gambar'=> 'required',
                'nomor_kontak'=> 'required',
                'latitude'=> 'required',
                'longitude'=> 'required',
                'deskripsi'=> 'required',
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

        $nama_bersih = bersih($request->nama_restaurant,'-');

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
                $filepath = public_path('uploads/images/deskripsi-restaurant').'/'.$filename.'.'.$mimetype;
                $nama = $filename.'.'.$mimetype;
                $image = Image::make($src)
                        ->encode($mimetype, 75)
                        ->save($filepath);
                $truepath = asset('uploads/images/deskripsi-restaurant').'/'.$filename.'.'.$mimetype;
                $new_src =$truepath;
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }
            $hitungGambar++;
        }

        if($request->file('gambar'))
        {
            $gambar = $request->file('gambar');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/gambar-header-restaurant');
            $filename_header = $nama_bersih.".".$ext;
            $gambar->move($destination, $filename_header);
        }
        

        $edit = Restaurant::find($id);
        $edit->kabupaten_id = $kab_id;
        $edit->objek_wisata_id = $request->objek_wisata;
        $edit->nama = $request->nama_restaurant;
        $edit->slug = $nama_bersih;
        $edit->alamat = $request->alamat;
        if(isset($filename_header)):
            $edit->gambar = $filename_header;
        endif;
        $edit->latitude = $request->latitude;
        $edit->longitude = $request->longitude;
        $edit->halal = isset($request->halal) ? 1:0;
        $edit->nomor_kontak = $request->nomor_kontak;
        $edit->deskripsi = $dom->saveHTML();
        $edit->status = (Auth::user()->level == 1 || Auth::user()->level == 4 ) ? $request->status : 1;
        $edit->save();

        if($edit)
        {
            Toastr::success('Data Berhasil Diubah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/restaurant');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->restaurantClass->find($id);

        $gambar = $this->restaurantMenuClass->where('restaurant_id',$id)->get();
        $path_gambar = public_path('uploads/images/restaurant-menu');
        foreach($gambar as $key)
        {   
            if(isset($key->id)):
            $deleteGambar = $this->restaurantMenuClass->find($key->id);
            File::delete($path_gambar.'/'.$key->gambar);
            $deleteGambar->delete();
            endif;
        }

        $gambar = $this->restaurantGambarClass->where('restaurant_id',$id)->get();
        $path_gambar = public_path('uploads/images/gallery-restaurant');
        foreach($gambar as $key)
        {   
            if(isset($key->id)):
            $deleteGambar = $this->restaurantGambarClass->find($key->id);
            File::delete($path_gambar.'/'.$key->gambar);
            $deleteGambar->delete();
            endif;
        }

        /* DELETE DATA GAMBAR HEADER */
        $path = public_path('uploads/images/gambar-header-restaurant');
        File::delete($path.'/'.$data->gambar);

        /* DELETE DATA GAMBAR KETERANGAN*/
        $path_keterangan = public_path('uploads/images/deskripsi-restaurant');
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
        
        $data = (Auth::user()->level == 7) ? $this->restaurantClass->getData(Auth::user()->kabupaten_id) : $this->restaurantClass->getData();
            return DataTables::of($data)
            ->addColumn('status', function($data)
            {
               return  status($data->status);
            })
            ->addColumn('option', function($data)
            {
                $button = '<a href="'.url('dashboard/restaurant/edit/'.$data->id).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
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
                        <a class="dropdown-item" href="'.url("/dashboard/restaurant/menu").'/'.$data->id.'">Menu Restaurant</a>
                        <a class="dropdown-item" href="'.url("/dashboard/restaurant/gambar").'/'.$data->id.'">Gambar Gallery</a>
                        <a class="dropdown-item" href="'.url("/dashboard/restaurant/sosial-media").'/'.$data->id.'">Sosial Media</a>
                    </div>
                </div>';

               
                return  $button;
            })

            ->addColumn('gambar', function($data)
            {
               return  "<img width='150px' src='".asset('uploads/images/gambar-header-restaurant/'.$data->gambar)."'>";
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

    public function gambarIndex($id)
    {  
        $data = $this->restaurantClass->find($id);
        $this->data['sub_page'] = $data->nama;
        $this->data['id'] = $id;
        return view('dashboard.pages.restaurant.gambar.index',$this->data); 
    }

    public function gambarTable($id)
    {
        
        $data = $this->restaurantGambarClass->where('restaurant_id',$id)->orderBy('updated_at','desc')->get();
        
        return DataTables::of($data)
        ->addColumn('option', function($data)
        {
            $restaurant = $this->restaurantClass->find($data->restaurant_id);
            $nama_objek = $restaurant->nama;
            $button = '<a href="'.url('dashboard/restaurant/gambar/edit/'.$data->id.'/'.$data->restaurant_id).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
            $button .= '<button data-id="'.$data->id.'" data-nama="'.$nama_objek.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
            return  $button;
        })
        
        ->addColumn('tanggal', function($data)
        {
           return  Carbon::parse($data->updated_at)->diffForHumans();
        })

        ->addColumn('gambar', function($data)
        {
           return  "<img width='250px' src='".asset('uploads/images/gallery-restaurant/'.$data->gambar)."'>";
        })
        ->addIndexColumn()
        ->rawColumns(['status','option','gambar','jenis','detail'])
        ->make(true);
    }

    public function gambarCreate($restaurant_id)
    {
        
        $data = $this->restaurantClass->find($restaurant_id);
        $this->data['sub_page'] = $data->nama;
        $this->data['id'] = $restaurant_id;
        return view('dashboard.pages.restaurant.gambar.create',$this->data); 
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
            $data = $this->restaurantClass->find($request->restaurant_id);
            $nama_objek = bersih($data->nama,'-');
            $i = 1;
            foreach($request->file('gambar') as $key)
            {
                $ext = $key->getClientOriginalExtension();
                $destination = public_path('uploads/images/gallery-restaurant');
                $filename = $nama_objek."-".$i.".".$ext;
                $key->move($destination, $filename);

                $save = new RestaurantGambar;
                $save->restaurant_id = $request->restaurant_id;
                $save->gambar = $filename;
                $save->save();
                $i++;
            }

            Toastr::success('Data Berhasil Ditambah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
            return redirect::to('dashboard/restaurant/gambar/'.$request->restaurant_id);
        }
    }

    public function gambarEdit($id,$restaurant_id)
    {   
        $data = $this->restaurantClass->find($restaurant_id);
        $this->data['sub_page'] = $data->nama;
        $this->data['id'] = $restaurant_id;
        $this->data['edit'] = $this->restaurantGambarClass->find($id);
        return view('dashboard.pages.restaurant.gambar.edit',$this->data); 
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

            $data_edit = $this->restaurantGambarClass->find($id);
            $nama_gambar_old = $data_edit->gambar;

            $nama_gambar_old = explode('.',$nama_gambar_old);
            $nama_gambar_old = $nama_gambar_old[0];

            $gambar = $request->file('gambar');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/gallery-restaurant');
            $filename = $nama_gambar_old.".".$ext;
            $gambar->move($destination, $filename);

            $edit = RestaurantGambar::find($id);
            $edit->gambar = $filename;
            $edit->save();

            if($edit)
            {
                Toastr::success('Data Berhasil Diubah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
                return redirect::to('dashboard/restaurant/gambar/'.$request->restaurant_id);
            }
    }

    public function gambarDestroy($id)
    {
        $delete = $this->restaurantGambarClass->find($id);
        $path = public_path('uploads/images/gallery-restaurant');
        File::delete($path.'/'.$delete->gambar);
        $delete->delete();
        return ['status'=>'1'];
    }

    public function menuIndex($id)
    {  
        $data = $this->restaurantClass->find($id);
        $this->data['sub_page'] = $data->nama;
        $this->data['id'] = $id;
        return view('dashboard.pages.restaurant.menu.index',$this->data); 
    }

    public function menuTable($id)
    {
        
        $data = $this->restaurantMenuClass->where('restaurant_id',$id)->orderBy('updated_at','desc')->get();
        
        return DataTables::of($data)
        ->addColumn('option', function($data)
        {
            
            $button = '<a href="'.url('dashboard/restaurant/menu/edit/'.$data->id.'/'.$data->restaurant_id).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
            $button .= '<button data-id="'.$data->id.'" data-nama="'.$data->nama.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
            return  $button;
        })
        
        ->addColumn('tanggal', function($data)
        {
           return  Carbon::parse($data->updated_at)->diffForHumans();
        })

        ->addColumn('gambar', function($data)
        {
           return  "<img width='250px' src='".asset('uploads/images/restaurant-menu/'.$data->gambar)."'>";
        })
        ->addIndexColumn()
        ->rawColumns(['status','option','gambar','jenis','detail'])
        ->make(true);
    }

    public function menuCreate($restaurant_id)
    {
        $data = $this->restaurantClass->find($restaurant_id);
        $this->data['sub_page'] = $data->nama;
        $this->data['id'] = $restaurant_id;
        return view('dashboard.pages.restaurant.menu.create',$this->data); 
    }

    public function menuStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'required',
            'nama_menu' => 'required',
            'deskripsi' => 'required',
            'tos' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $data = $this->restaurantClass->find($request->restaurant_id);
        $nama_objek = bersih($data->nama,'-');
        $nama_menu = bersih($request->nama_menu,'-');
        $nama_gambar = $nama_objek.'-'.$nama_menu;
        if($request->file('gambar'))
        {
            $gambar = $request->file('gambar');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/restaurant-menu');
            $filename_header = $nama_gambar.".".$ext;
            $gambar->move($destination, $filename_header);
        }

        $save = new RestaurantMenu;
        $save->restaurant_id = $request->restaurant_id;
        $save->nama = $request->nama_menu;
        $save->deskripsi = $request->deskripsi;
        $save->gambar = $filename_header;
        $save->save();

        Toastr::success('Data Berhasil Ditambah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        return redirect::to('dashboard/restaurant/menu/'.$request->restaurant_id);
    }

    public function menuEdit($id,$restaurant_id)
    {   
        $data = $this->restaurantClass->find($restaurant_id);
        $this->data['sub_page'] = $data->nama;
        $this->data['id'] = $restaurant_id;
        $this->data['edit'] = $this->restaurantMenuClass->find($id);
        return view('dashboard.pages.restaurant.menu.edit',$this->data); 
    }

    public function menuUpdate($id,Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_menu' => 'required',
            'deskripsi' => 'required',
            'tos' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $data = $this->restaurantClass->find($request->restaurant_id);
        $nama_objek = bersih($data->nama,'-');
        $nama_menu = bersih($request->nama_menu,'-');
        $nama_gambar = $nama_objek.'-'.$nama_menu;

        if($request->file('gambar'))
        {
            $gambar = $request->file('gambar');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/restaurant-menu');
            $filename_header = $nama_gambar.".".$ext;
            $gambar->move($destination, $filename_header);
        }

        $save = RestaurantMenu::find($id);
        $save->restaurant_id = $request->restaurant_id;
        $save->nama = $request->nama_menu;
        $save->deskripsi = $request->deskripsi;
        if(isset($filename_header)):
            $save->gambar = $filename_header;
        endif;
        $save->save();

        Toastr::success('Data Berhasil Ditambah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        return redirect::to('dashboard/restaurant/menu/'.$request->restaurant_id);
    }

    public function menuDestroy($id)
    {
        $delete = $this->restaurantMenuClass->find($id);
        $path = public_path('uploads/images/restaurant-menu');
        File::delete($path.'/'.$delete->gambar);
        $delete->delete();
        return ['status'=>'1'];
    }

    public function sosmedIndex($id)
    {  
        $data = $this->restaurantClass->find($id);
        $this->data['sub_page'] = $data->nama;
        $this->data['id'] = $id;
        return view('dashboard.pages.restaurant.sosial-media.index',$this->data); 
    }

    public function sosmedTable($id)
    {
        
        $data = $this->sosialMediaClass->where('id_tempat',$id)->where('kode_tempat',2)->orderBy('updated_at','desc')->get();
        
        return DataTables::of($data)
        ->addColumn('option', function($data)
        {
            
            $button = '<a href="'.url('dashboard/restaurant/sosial-media/edit/'.$data->id.'/'.$data->id_tempat).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
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
        $data = $this->restaurantClass->find($restaurant_id);
        $this->data['sub_page'] = $data->nama;
        $this->data['id'] = $restaurant_id;
        return view('dashboard.pages.restaurant.sosial-media.create',$this->data); 
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
        $this->sosialMediaClass->kode_tempat = 2;
        $this->sosialMediaClass->kode_sosmed = $request->sosial_media;
        $this->sosialMediaClass->alamat_sosmed = $request->alamat_sosial_media;
        $this->sosialMediaClass->save();

        Toastr::success('Data Berhasil Ditambah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        return redirect::to('dashboard/restaurant/sosial-media/'.$request->id);
    }

    public function sosmedEdit($id,$id_tempat)
    {   
        $data = $this->restaurantClass->find($id_tempat);
        $this->data['sub_page'] = $data->nama;
        $this->data['id'] = $id_tempat;
        $this->data['edit'] = $this->sosialMediaClass->find($id);
        return view('dashboard.pages.restaurant.sosial-media.edit',$this->data); 
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
        $edit->kode_tempat = 2;
        $edit->kode_sosmed = $request->sosial_media;
        $edit->alamat_sosmed = $request->alamat_sosial_media;
        $edit->save();

        Toastr::success('Data Berhasil Diubah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        return redirect::to('dashboard/restaurant/sosial-media/'.$request->id);
    }

    public function sosmedDestroy($id)
    {
        $delete = $this->sosialMediaClass->find($id);
        $delete->delete();
        return ['status'=>'1'];
    }
    
}
