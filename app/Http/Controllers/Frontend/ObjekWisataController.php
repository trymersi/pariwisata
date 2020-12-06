<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TempatIbadah;
use App\Models\ObjekWisata;
use App\Models\LinkTerkait;
use App\Models\Restaurant;
use App\Models\Kabupaten;
use App\Models\Cindramata;
use App\Models\Setting;
use App\Models\Hotel;
use App\Models\Event;
use App\Models\ObjekWisataReview;
class ObjekWisataController extends Controller
{
    private $data;
    private $setting;
    private $objekWisata;
    private $kabupaten;
    private $restaurantClass;
    private $hotelClass;
    private $eventClass;
    private $tempatIbadahClass;
    private $linkTerkait;
    private $cindramata;
    private $review;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {

        $this->setting = Setting::find(1);
        $this->objekWisata = new ObjekWisata;
        $this->kabupaten = new Kabupaten;
        $this->restaurantClass = new Restaurant;
        $this->hotelClass = new Hotel;
        $this->eventClass = new Event;
        $this->tempatIbadahClass = new TempatIbadah;
        $this->linkTerkait = new LinkTerkait;
        $this->cindramata = new Cindramata;
        $this->review = new ObjekWisataReview;
        
        $this->data = [
            'page_name' => 'Destinasi Riau',
            'meta_description' => 'Data objek wisata yang berada di provinsi riau',
            'meta_keywords' => 'Objek Wisata',
            'setting' => $this->setting,
        ];
    }

    public function index()
    {
        $this->data['list_kabupaten'] = false;
        $this->data['list_kabupaten'] = $this->kabupaten->select('nama','id')->get();
        $this->data['objek_wisata'] = $this->objekWisata->getAll();
        return view('frontend.pages.objek-wisata.index',$this->data);
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
        $this->data['list_kabupaten'] = $this->kabupaten->select('nama','id')->get();
        if($request->keyword == null)
        {
            $kw = '';
        }
        else
        {
            $kw = $request->keyword;
        }
        
        $this->data['objek_wisata'] = $this->objekWisata->SearchObjekWisata($request->kabupaten,$request->keyword);
        $this->data['pencarian'] = $kw;
        if($request->kabupaten != null):
        $kabupaten = $this->kabupaten->find($request->kabupaten);
        $this->data['pencarian_kabupaten'] = $kabupaten->nama;
        else:
            $this->data['pencarian_kabupaten'] = '-';
        endif;
        return view('frontend.pages.objek-wisata.index',$this->data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $objekWisata = $this->objekWisata->where("slug",$id)->first();
        // $api = apiMap();
        // $url = "https://maps.googleapis.com/maps/api/geocode/json?key=".$api;
        // $data = file_get_contents($url);
        $lat = 0.5070677;
        $long = 101.4477793;
        $latLong = $lat.",".$long;
        $WisataLatLong = $objekWisata->latitude.",".$objekWisata->longitude;

        $this->data['objek_wisata'] = $this->objekWisata->getDetail($objekWisata->id);
        $this->data['terdekat'] = $this->objekWisata->getTerdekat($objekWisata->kabupaten_id, $objekWisata->id );
        $this->data['galeri'] = $this->objekWisata->getGaleri($objekWisata->id);
        $this->data['jenis'] = jenisWisata($objekWisata->jenis);
        $this->data['fasilitas'] = $this->objekWisata->getFasilitas($objekWisata->id);
        $this->data['ulasan'] = $this->review->where('objek_wisata_id',$objekWisata->id)->orderBy('id','desc')->get();
        $this->data['pengunjung'] = $this->objekWisata->getPengunjung($objekWisata->id);
        $this->data['jarak'] = getDistance($latLong,$WisataLatLong);
        // dd($this->data);
        return view('frontend.pages.objek-wisata.detail',$this->data);
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

    public function rating(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $this->review->objek_wisata_id = $request->id;
        $this->review->rating = $request->rg_total;
        $this->review->nama = $request->nama;
        $this->review->email = $request->email;
        $this->review->ulasan = $request->ulasan;
        $this->review->save();
        return redirect::to('/objek-wisata/'.$request->slug);
    }
}
