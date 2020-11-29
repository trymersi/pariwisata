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
class TempatIbadahController extends Controller
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
            'meta_description' => 'Data objek wisata yang berada di provinsi riau',
            'meta_keywords' => 'Objek Wisata',
            'setting' => $this->setting,
        ];
    }

    public function index()
    {
        $this->data['list_kabupaten'] = false;
        $this->data['list_kabupaten'] = $this->kabupaten->select('nama','id')->get();
        $this->data['tempat_ibadah'] = $this->tempatIbadahClass->getHome();
        return view('frontend.pages.tempat-ibadah.index',$this->data);
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
        
        $this->data['tempat_ibadah'] = $this->tempatIbadahClass->SearchTempatIbadah($request->kabupaten,$request->keyword);
        $this->data['pencarian'] = $kw;
        if($request->kabupaten != null):
        $kabupaten = $this->kabupaten->find($request->kabupaten);
        $this->data['pencarian_kabupaten'] = $kabupaten->nama;
        else:
            $this->data['pencarian_kabupaten'] = '-';
        endif;
        return view('frontend.pages.tempat-ibadah.index',$this->data);
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
