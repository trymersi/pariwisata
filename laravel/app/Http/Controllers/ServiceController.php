<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TempatIbadah;
use App\Models\ObjekWisata;
use App\Models\LinkTerkait;
use App\Models\Restaurant;
use App\Models\Kabupaten;
use App\Models\Setting;
use App\Models\Hotel;
use App\Models\Event;
use App\Models\Contact;
use App\Models\KategoriEkraf;
use App\Models\ObjekWisataReview;
use App\Models\HotelReview;
use App\Models\TempatibadahReview;
use App\Models\RestaurantReview;
use App\Models\Ekraf;
use App\Models\Cindramata;
use App\Models\CindramataDetail;
use App\Models\DesaWisata;
use App\Models\Kuliner;
use App\Models\PemanduWisata;
use App\Models\Post;
use App\Models\SadarWisata;
use App\Models\Travel;
use App\Models\Iklan;

class ServiceController extends Controller
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
    private $contact;
    private $kategoriEkraf;
    private $objekWisataReview;
    private $hotelReview;
    private $tempatibadahReview;
    private $restaurantReview;
    private $ekrafClass;
    private $cendramata;
    private $cindramataDetail;
    private $desaWisata;
    private $kulinerClass;
    private $pemanduWisata;
    private $postClass;
    private $sadarWisata;
    private $travelClass;
    private $iklan;
    
    private $errMessage;

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
        $this->contact = new Contact;
        $this->kategoriEkraf = new KategoriEkraf;
        $this->objekWisataReview = new ObjekWisataReview;
        $this->hotelReview = new HotelReview;
        $this->tempatibadahReview = new TempatibadahReview;
        $this->restaurantReview = new RestaurantReview;
        $this->ekrafClass = new Ekraf;
        $this->cendramata = new Cindramata;
        $this->cindramataDetail = new CindramataDetail;
        $this->desaWisata = new DesaWisata;
        $this->kulinerClass = new Kuliner;
        $this->pemanduWisata = new PemanduWisata;
        $this->postClass = new Post;
        $this->sadarWisata = new SadarWisata;
        $this->travelClass = new Travel;
        $this->iklan = new iklan;

        $this->data = array();

        $this->errMessage = ['response'=>['status'=>'error','message'=>'ooops']];
        
    }

    private function cekToken($token)
    {
        return ($token == "pariwisata_riau") ? true : false;
    }

    private function kabupaten()
    {
        $this->data['response']['items_kabupaten'] = $this->kabupaten->select('nama','id')->orderBy('nama','asc')->get();
    }

    public function getHome(Request $request)
    {
        if($this->cekToken($request->key))
        {
            $this->data['response']['status'] = "success";
            $this->data['response']['objek_wisata_pilihan'] = $this->objekWisata->orderBy('id','desc')->limit(5)->where('pilihan',1)->get();
            $this->data['response']['list_objek_wisata'] = $this->objekWisata->orderBy('id','desc')->limit(10)->where('pilihan','!=',1)->get();
            $this->data['response']['berita'] = $this->postClass->getAll();
            $this->data['response']['event'] = $this->eventClass->getAll();
            $this->data['response']['iklan'] = $this->iklan->orderBy('id','desc')->limit(10)->get();
            return response()->json($this->data);
        }
        return response()->json($this->errMessage);
    }

    public function getObjekWisata(Request $request)
    {
        if($this->cekToken($request->key))
        {
            $this->data['response']['status'] = "success";
            $this->kabupaten();
            $sort = $request->sort;
            switch($sort)
            {
                case '1':
                    $this->data['response']['items'] = (isset($request->kabupaten_id)  && $request->kabupaten_id != '') ? $this->objekWisata->getAll($request->kabupaten_id,$request->keyword) : $this->objekWisata->getAll();
                    break;
                case '2':
                    $this->data['response']['items'] = $this->objekWisata->getByKunjungan($request->kabupaten_id,$request->keyword);
                    break;
                case '3':
                    $this->data['response']['items'] = $this->objekWisata->getByUlasan($request->kabupaten_id,$request->keyword);
                    break;
                case '4':
                    $this->data['response']['items'] = $this->objekWisata->getByJarak($request->kabupaten_id,$request->keyword,$request->latitude,$request->longitude);
                    break;
                default:
                    $this->data['response']['items'] = $this->objekWisata->getAll($request->kabupaten_id,$request->keyword);
                break;
            }

            
            return response()->json($this->data);
        }
        return response()->json($this->errMessage);
    }

    public function getObjekWisataDetail(Request $request)
    {
        if($this->cekToken($request->key) && $request->objek_wisata_id && $request->objek_wisata_id != '')
        {
            $objekWisata = $this->objekWisata->where("id",$request->objek_wisata_id)->first();
            if($objekWisata)
            {
                $this->data['response']['status'] = "success";
                $this->data['response']['detail'] = $this->objekWisata->getDetail($objekWisata->id);
                $this->data['response']['aksebilitas'] = $this->objekWisata->getAksebilitas($objekWisata->id);
                $this->data['response']['plus'] = $this->objekWisata->getPlus($objekWisata->id);
                $this->data['response']['terdekat'] = $this->objekWisata->getTerdekat($objekWisata->kabupaten_id, $objekWisata->id);
                $this->data['response']['restoterdekat'] = $this->objekWisata->getRestoTerdekat($objekWisata->kabupaten_id, $objekWisata->id );
                $this->data['response']['ibadahterdekat'] = $this->objekWisata->getIbadahTerdekat($objekWisata->kabupaten_id, $objekWisata->id );
                $this->data['response']['hotelterdekat'] = $this->objekWisata->getHotelTerdekat($objekWisata->kabupaten_id, $objekWisata->id );
                $this->data['response']['cindraterdekat'] = $this->objekWisata->getCindraTerdekat($objekWisata->kabupaten_id, $objekWisata->id );
                $this->data['response']['galeri'] = $this->objekWisata->getGaleri($objekWisata->id);
                $this->data['response']['jenis'] = jenisWisataIon($objekWisata->jenis);
                $this->data['response']['fasilitas'] = $this->objekWisata->getFasilitas($objekWisata->id);
                $this->data['response']['ulasan'] = $this->objekWisataReview->where('objek_wisata_id',$objekWisata->id)->orderBy('id','desc')->get();
                $this->data['response']['pengunjung'] = $this->objekWisata->getPengunjung($objekWisata->id);
                $this->data['response']['pemandu'] = $this->pemanduWisata->getByObjek($objekWisata->id);

                if(isset($request->user_latitude) && $request->user_latitude != '' && isset($request->user_longitude) && $request->user_longitude != '')
                {
                    $latLong = $request->user_latitude.",".$request->user_longitude;
                    $WisataLatLong = $objekWisata->latitude.",".$objekWisata->longitude;
                    $this->data['response']['jarak'] = getDistance($latLong,$WisataLatLong);
                }
                return response()->json($this->data);
            }
        }
        return response()->json($this->errMessage);
    }

    public function getHotel(Request $request)
    {
        if($this->cekToken($request->key))
        {
            $this->data['response']['status'] = "success";
            $this->kabupaten();
            $sort = $request->sort;
            $this->data['response']['items'] = $this->hotelClass->getApi($request->kabupaten_id,$request->keyword,$request->sort);
            return response()->json($this->data);
        }
        return response()->json($this->errMessage);
    }

    public function getHotelDetail(Request $request)
    {
        if($this->cekToken($request->key) && $request->hotel_id && $request->hotel_id != '')
        {
            $hotel = $this->hotelClass->where("id",$request->hotel_id)->first();
            if($hotel)
            {
                $this->data['response']['status'] = "success";
                $this->data['response']['detail'] = $this->hotelClass->getDetail($hotel->id);
                $this->data['response']['terdekat'] = $this->hotelClass->getTerdekat($hotel->kabupaten_id, $hotel->id);
                $this->data['response']['galeri'] = $this->hotelClass->getGaleri($hotel->id);
                $this->data['response']['jenis'] = jenisHotelIon($hotel->jenis);
                $this->data['response']['layanan'] = jenisLayananIon($hotel->layanan);
                $this->data['response']['ulasan'] = $this->hotelReview->where('hotel_id',$hotel->id)->orderBy('id','desc')->get();
                if(isset($request->user_latitude) && $request->user_latitude != '' && isset($request->user_longitude) && $request->user_longitude != '')
                {
                    $latLong = $request->user_latitude.",".$request->user_longitude;
                    $hotelLatLong = $hotel->latitude.",".$hotel->longitude;
                    $this->data['response']['jarak'] = getDistance($latLong,$hotelLatLong);
                }
                return response()->json($this->data);
            }
        }
        return response()->json($this->errMessage);
    }

    public function getTempatIbadah(Request $request)
    {
        if($this->cekToken($request->key))
        {
            $this->data['response']['status'] = "success";
            $this->kabupaten();
            $this->data['response']['items'] = $this->tempatIbadahClass->getApi($request->kabupaten_id,$request->keyword);
            return response()->json($this->data);
        }
        return response()->json($this->errMessage);
    }

    public function getTempatIbadahDetail(Request $request)
    {
        if($this->cekToken($request->key) && $request->tempat_ibadah_id && $request->tempat_ibadah_id != '')
        {
            $tempat_ibadah = $this->tempatIbadahClass->where("id",$request->tempat_ibadah_id)->first();
            if($tempat_ibadah)
            {
                $this->data['response']['status'] = "success";
                $this->data['response']['detail'] = $this->tempatIbadahClass->getDetail($tempat_ibadah->id);
                $this->data['response']['terdekat'] = $this->tempatIbadahClass->getTerdekat($tempat_ibadah->kabupaten_id, $tempat_ibadah->id );
                $this->data['response']['galeri'] = $this->tempatIbadahClass->getGaleri($tempat_ibadah->id);
                $this->data['response']['jenis'] = jenisWisata($tempat_ibadah->jenis);
                $this->data['response']['menu'] = $this->tempatIbadahClass->getMenu($tempat_ibadah->id);
                $this->data['response']['ulasan'] = $this->tempatibadahReview->where('tempat_ibadah_id',$tempat_ibadah->id)->orderBy('id','desc')->get();
                if(isset($request->user_latitude) && $request->user_latitude != '' && isset($request->user_longitude) && $request->user_longitude != '')
                {
                    $latLong = $request->user_latitude.",".$request->user_longitude;
                    $placeLatLong = $tempat_ibadah->latitude.",".$tempat_ibadah->longitude;
                    $this->data['response']['jarak'] = getDistance($latLong,$placeLatLong);
                }
                return response()->json($this->data);
            }
        }
        return response()->json($this->errMessage);
    }

    public function getRestoran(Request $request)
    {
        if($this->cekToken($request->key))
        {
            $this->data['response']['status'] = "success";
            $this->kabupaten();
            $this->data['response']['items'] = $this->restaurantClass->getApi($request->kabupaten_id,$request->keyword);
            return response()->json($this->data);
        }
        return response()->json($this->errMessage);
    }

    public function getRestoranDetail(Request $request)
    {
        if($this->cekToken($request->key) && $request->restoran_id && $request->restoran_id != '')
        {
            $restaurant = $this->restaurantClass->where("id",$request->restoran_id)->first();
            if($restaurant)
            {
                $this->data['response']['status'] = "success";
                $this->data['response']['detail'] = $this->restaurantClass->getDetail($restaurant->id);
                $this->data['response']['terdekat'] = $this->restaurantClass->getTerdekat($restaurant->kabupaten_id, $restaurant->id );
                $this->data['response']['galeri'] = $this->restaurantClass->getGaleri($restaurant->id);
                $this->data['response']['jenis'] = jenisWisata($restaurant->jenis);
                $this->data['response']['menu'] = $this->restaurantClass->getMenu($restaurant->id);
                $this->data['response']['ulasan'] = $this->restaurantReview->where('restaurant_id',$restaurant->id)->orderBy('id','desc')->get();
                if(isset($request->user_latitude) && $request->user_latitude != '' && isset($request->user_longitude) && $request->user_longitude != '')
                {
                    $latLong = $request->user_latitude.",".$request->user_longitude;
                    $placeLatLong = $restaurant->latitude.",".$restaurant->longitude;
                    $this->data['response']['jarak'] = getDistance($latLong,$placeLatLong);
                }
                return response()->json($this->data);
            }
        }
        return response()->json($this->errMessage);
    }

    public function getEkraf(Request $request)
    {
        if($this->cekToken($request->key))
        {
            $this->data['response']['status'] = "success";
            $this->kabupaten();
            $this->data['response']['items'] = $this->kategoriEkraf->getApi($request->kabupaten_id,$request->keyword);
            return response()->json($this->data);
        }
    }

    public function getEkrafDetail(Request $request)
    {
        if($this->cekToken($request->key) && $request->kategori_ekraf_id && $request->kategori_ekraf_id != '')
        {
            $this->data['response']['status'] = "success";
            $this->data['response']['detail'] = $this->ekrafClass->getByKat($request->kabupaten_id,$request->keyword,$request->kategori_ekraf_id);
            $this->data['response']['kategori'] = $this->kategoriEkraf->find($request->kategori_ekraf_id);
            return response()->json($this->data);
        }
        return response()->json($this->errMessage);
    }

    public function getEvent(Request $request)
    {
        if($this->cekToken($request->key))
        {
            $this->data['response']['status'] = "success";
            $this->kabupaten();
            $this->data['response']['items'] = $this->eventClass->getApi($request->kabupaten_id,$request->keyword);
            return response()->json($this->data);
        }
        return response()->json($this->errMessage);
    }

    public function getEventDetail(Request $request)
    {
        if($this->cekToken($request->key) && $request->event_id && $request->event_id != '')
        {
            $event = $this->eventClass->where("id",$request->event_id)->first();
            if($event)
            {
                $this->data['response']['status'] = "success";
                $this->data['response']['detail'] = $this->eventClass->getDetail($event->id);
                $this->data['response']['detail']['tanggal_mulai'] = tgl_indo($this->data['response']['detail']->tanggal_mulai);
                $this->data['response']['detail']['tanggal_selesai'] = tgl_indo($this->data['response']['detail']->tanggal_selesai);
                $this->data['response']['terdekat'] = $this->eventClass->getTerdekat($event->kabupaten_id, $event->id );
                return response()->json($this->data);
            }
        }
        return response()->json($this->errMessage);
    }

    public function getCendramata(Request $request)
    {
        if($this->cekToken($request->key))
        {
            $this->data['response']['status'] = "success";
            $this->kabupaten();
            $this->data['response']['items'] = $this->cendramata->getApi($request->kabupaten_id,$request->keyword);
            return response()->json($this->data);
        }
        return response()->json($this->errMessage);
    }

    public function getCendramataDetail(Request $request)
    {
        if($this->cekToken($request->key) && $request->cendramata_id && $request->cendramata_id != '')
        {
            $cendramata = $this->cendramata->where("id",$request->cendramata_id)->first();
            if($cendramata)
            {
                $this->data['response']['status'] = "success";
                $this->data['response']['detail'] = $this->cendramata->getDetail($cendramata->id);
                $this->data['response']['produk'] = $this->cindramataDetail->getProduk($cendramata->id);
                $this->data['response']['terdekat'] = $this->cendramata->getTerdekat($cendramata->kabupaten_id, $cendramata->id );
                if(isset($request->user_latitude) && $request->user_latitude != '' && isset($request->user_longitude) && $request->user_longitude != '')
                {
                    $latLong = $request->user_latitude.",".$request->user_longitude;
                    $placeLatLong = $cendramata->latitude.",".$cendramata->longitude;
                    $this->data['response']['jarak'] = getDistance($latLong,$placeLatLong);
                }
                return response()->json($this->data);
            }
        }
        return response()->json($this->errMessage);
    }

    public function getDesaWisata(Request $request)
    {
        if($this->cekToken($request->key))
        {
            $this->data['response']['status'] = "success";
            $this->kabupaten();
            $this->data['response']['items'] = $this->desaWisata->getApi($request->kabupaten_id,$request->keyword);
            return response()->json($this->data);
        }
        return response()->json($this->errMessage);
    }

    public function getDesaWisataDetail(Request $request)
    {
        if($this->cekToken($request->key) && $request->desa_wisata_id && $request->desa_wisata_id != '')
        {
            $desa = $this->desaWisata->where("id",$request->desa_wisata_id)->first();
            if($desa)
            {
                $this->data['response']['status'] = "success";
                $this->data['response']['detail'] = $this->desaWisata->getDetail($desa->id);
                $this->data['response']['potensi'] = explode(',',$this->data['response']['detail']->potensi_wisata);
                $this->data['response']['sadar_wisata'] = $this->desaWisata->getSadarWisata($desa->id);
                $this->data['response']['terdekat'] = $this->desaWisata->getTerdekat($desa->kabupaten_id, $desa->id);
                return response()->json($this->data);
            }
        }
        return response()->json($this->errMessage);
    }
    
    public function getKuliner(Request $request)
    {
        if($this->cekToken($request->key))
        {
            $this->data['response']['status'] = "success";
            $this->kabupaten();
            $this->data['response']['items'] = $this->kulinerClass->getApi($request->kabupaten_id,$request->keyword);
            return response()->json($this->data);
        }
        return response()->json($this->errMessage);
    }

    public function getKulinerDetail(Request $request)
    {
        if($this->cekToken($request->key) && $request->kuliner_id && $request->kuliner_id != '')
        {
            $kuliner = $this->kulinerClass->where("id",$request->kuliner_id)->first();
            if($kuliner)
            {
                $this->data['response']['status'] = "success";
                $this->data['response']['detail'] = $this->kulinerClass->getDetail($kuliner->id);
                $this->data['response']['terdekat'] = $this->kulinerClass->getTerdekat($kuliner->kabupaten_id, $kuliner->id );
                return response()->json($this->data);
            }
        }
        return response()->json($this->errMessage);
    }

    public function getPemandu(Request $request)
    {
        if($this->cekToken($request->key))
        {
            $this->data['response']['status'] = "success";
            $this->kabupaten();
            $this->data['response']['items'] = (isset($request->kabupaten_id)  && $request->kabupaten_id != '') ? $this->pemanduWisata->getAll($request->kabupaten_id) : $this->pemanduWisata->getAll();
            return response()->json($this->data);
        }
        return response()->json($this->errMessage);
    }

    public function getPemanduDetail(Request $request)
    {
        if($this->cekToken($request->key) && $request->pemandu_id && $request->pemandu_id != '')
        {
            $pemandu = $this->pemanduWisata->where("id",$request->pemandu_id)->first();
            if($pemandu)
            {
                $this->data['response']['status'] = "success";
                $this->data['response']['detail'] = $this->pemanduWisata->getDetail($pemandu->id);
                $this->data['response']['lain'] = $this->pemanduWisata->getTerdekat($pemandu->kabupaten_id, $pemandu->objek_wisata_id , $pemandu->id );
                return response()->json($this->data);
            }
        }
        return response()->json($this->errMessage);
    }

    public function getBerita(Request $request)
    {
        if($this->cekToken($request->key))
        {
            $this->data['response']['status'] = "success";
            $this->kabupaten();
            $this->data['response']['items'] = $this->postClass->getApi($request->kabupaten_id,$request->keyword);
            return response()->json($this->data);
        }
        return response()->json($this->errMessage);
    }

    public function getBeritaDetail(Request $request)
    {
        if($this->cekToken($request->key) && $request->berita_id && $request->berita_id != '')
        {
            $post = $this->postClass->where("id",$request->berita_id)->first();
            if($post)
            {
                $this->data['response']['status'] = "success";
                $this->data['response']['detail'] = $this->postClass->getSingle($post->id);
                $this->data['response']['lain'] = $this->postClass->getRelated($post->kabupaten_id, $post->id );
                return response()->json($this->data);
            }
        }
        return response()->json($this->errMessage);
    }

    public function getSadarWisata(Request $request)
    {
        if($this->cekToken($request->key))
        {
            $this->data['response']['status'] = "success";
            $this->kabupaten();
            $this->data['response']['items'] = (isset($request->kabupaten_id)  && $request->kabupaten_id != '') ? $this->sadarWisata->getAll($request->kabupaten_id) : $this->sadarWisata->getAll();
            return response()->json($this->data);
        }
        return response()->json($this->errMessage);
    }

    public function getSadarWisataDetail(Request $request)
    {
        if($this->cekToken($request->key) && $request->sadar_wisata_id && $request->sadar_wisata_id != '')
        {
            $sadar_wisata = $this->sadarWisata->where("id",$request->sadar_wisata_id)->first();
            if($sadar_wisata)
            {
                $this->data['response']['status'] = "success";
                $this->data['response']['detail'] = $this->sadarWisata->getDetail($sadar_wisata->id);
                $this->data['response']['terdekat'] = $this->sadarWisata->getTerdekat($sadar_wisata->kabupaten_id, $sadar_wisata->id );
                return response()->json($this->data);
            }
        }
        return response()->json($this->errMessage);
    }

    public function getTravel(Request $request)
    {
        if($this->cekToken($request->key))
        {
            $this->data['response']['status'] = "success";
            $this->kabupaten();
            $this->data['response']['items'] = $this->travelClass->getApi($request->kabupaten_id,$request->keyword);
            return response()->json($this->data);
        }
        return response()->json($this->errMessage);
    }

    public function getTravelDetail(Request $request)
    {
        if($this->cekToken($request->key) && $request->travel_id && $request->travel_id != '')
        {
            $travel = $this->travelClass->where("id",$request->travel_id)->first();
            if($travel)
            {
                $this->data['response']['status'] = "success";
                $this->data['response']['detail'] = $this->travelClass->getDetail($travel->id);
                $this->data['response']['terdekat'] = $this->travelClass->getTerdekat($travel->kabupaten_id, $travel->id );
                return response()->json($this->data);
            }
        }
        return response()->json($this->errMessage);
    }

    public function getKabupaten(Request $request)
    {
        if($this->cekToken($request->key))
        {
            $this->data['response']['status'] = "success";
            $this->kabupaten();
            $this->data['response']['items'] = $this->kabupaten->getCountObjek();
            return response()->json($this->data);
        }
        return response()->json($this->errMessage);
    }

    public function getKabupatenDetail(Request $request)
    {
        if($this->cekToken($request->key) && $request->kabupaten_id && $request->kabupaten_id != '')
        {
            $kabupaten = $this->kabupaten->where('id',$request->kabupaten_id)->first();
            if($kabupaten)
            {
                $id = $kabupaten->id;
                $this->data['response']['status'] = "success";
                $this->data['response']['detail'] = $this->kabupaten->where('id',$id)->first();
                $this->data['response']['objek_wisata'] = $this->objekWisata->orderBy('id','desc')->where('kabupaten_id',$id)->limit(4)->get();
                $this->data['response']['restoran'] = $this->restaurantClass->getByKabupaten($id);
                $this->data['response']['event'] = $this->eventClass->getByKabupaten($id);
                $this->data['response']['hotel'] = $this->hotelClass->getByKabupaten($id);
                $this->data['response']['tempat_ibadah'] = $this->tempatIbadahClass->getByKabupaten($id);
                $this->data['response']['cindramata'] = $this->cendramata->getData($id);
                $this->data['response']['kabupaten_lain'] = $this->kabupaten->whereNotIn('id',[$id])->limit(5)->get();
                return response()->json($this->data);
            }
        }
        return response()->json($this->errMessage);
    }
}
