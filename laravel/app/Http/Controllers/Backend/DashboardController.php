<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ObjekWisata;
use App\Models\Hotel;
use App\Models\TempatIbadah;
use App\Models\Restaurant;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->data = [
            'category_name' => 'dashboard',
            'page_name' => 'dashboard',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'alt_menu' => 0,
        ];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       
        $this->data['objek_wisata'] = ObjekWisata::count();
        $this->data['hotel'] = Hotel::count();
        $this->data['tempat_ibadah'] = TempatIbadah::count();
        $this->data['restaurant'] = Restaurant::count();
        return view('dashboard.dashboard2',$this->data);
        
    }
}
