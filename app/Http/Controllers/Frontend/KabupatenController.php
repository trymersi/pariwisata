<?php

namespace App\Http\Controllers\Frontend;

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
class KabupatenController extends Controller
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
        
        $this->data = [
            'page_name' => 'Destinasi Riau',
            'meta_description' => $this->setting->meta_description,
            'meta_keywords' => $this->setting->meta_keywords,
            'setting' => $this->setting,
        ];
    }

    public function index($id)
    {
        $kabupaten = $this->kabupaten->where('slug',$id)->first();
        $id = $kabupaten->id;
        $this->data['objek_wisata'] = $this->objekWisata->orderBy('id','desc')->where('kabupaten_id',$id)->limit(4)->get();
        $this->data['kabupaten'] = $this->kabupaten->where('id',$id)->first();
        $this->data['restoran'] = $this->restaurantClass->getByKabupaten($id);
        $this->data['event'] = $this->eventClass->getByKabupaten($id);
        $this->data['hotel'] = $this->hotelClass->getByKabupaten($id);
        $this->data['tempat_ibadah'] = $this->tempatIbadahClass->getByKabupaten($id);
        $this->data['cindramata'] = $this->cindramata->getData($id);
        $this->data['kabupaten_lain'] = $this->kabupaten->whereNotIn('id',[$id])->limit(5)->get();
        return view('frontend.pages.kabupaten',$this->data);
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
}
