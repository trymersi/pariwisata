<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SosialMedia;
use App\Models\Setting;
use Carbon\Carbon;
use DataTables;
use Toastr;
use File;
use Auth;

class SettingController extends Controller
{

    private $data;
    private $SettingClass;

    

    public function __construct()
    {
        $this->middleware(['role:super_admin']);

        $this->SettingClass = new Setting;

        $this->data = [
            'category_name' => 'Pengaturan',
            'page_name' => 'Pengaturan',
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
        $this->data['edit'] = $this->SettingClass->where('id',1)->first();
        if(isset($this->data['edit']->id)):
            return view('dashboard.pages.setting.update',$this->data);
        else:
            return view('dashboard.pages.setting.index',$this->data);
        endif;
        
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
        $validator = Validator::make($request->all(), [
            'nama_website' => 'required',
            'keterangan_website' => 'required',
            'alamat_kantor' => 'required',
            'icon'=> 'required',
            'email_website' => 'required',
            'notel' => 'required',
            'logo_website' => 'required',
            'gambar_login'=> 'required',
            'latitude'=> 'required',
            'longitude'=> 'required',
        ]);


        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        if($request->file('icon'))
        {
            $gambar = $request->file('icon');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/setting');
            $filename_icon = "icon.".$ext;
            $gambar->move($destination, $filename_icon);
        }

        if($request->file('logo_website'))
        {
            $gambar = $request->file('logo_website');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/setting');
            $filename_logo_website = "logo_website.".$ext;
            $gambar->move($destination, $filename_logo_website);
        }

        if($request->file('gambar_login'))
        {
            $gambar = $request->file('gambar_login');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/setting');
            $filename_gambar_login = "gambar_login.".$ext;
            $gambar->move($destination, $filename_gambar_login);
        }

        $this->SettingClass->nama_website =  $request->nama_website;
        $this->SettingClass->keterangan_website =  $request->keterangan_website;
        $this->SettingClass->alamat_kantor =  $request->alamat_kantor;
        $this->SettingClass->icon =  $filename_icon;
        $this->SettingClass->email =  $request->email_website;
        $this->SettingClass->notel =  $request->notel;
        $this->SettingClass->logo_website =  $filename_logo_website;
        $this->SettingClass->gambar_login =  $filename_gambar_login;
        $this->SettingClass->meta_description =  meta_description($request->keterangan_website);
        $this->SettingClass->meta_keywords =  meta_keywords($request->nama_website);
        $this->SettingClass->latitude = $request->latitude;
        $this->SettingClass->longitude = $request->longitude;
        $this->SettingClass->save();

        if($this->SettingClass)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/pengaturan');
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
        $validator = Validator::make($request->all(), [
            'nama_website' => 'required',
            'keterangan_website' => 'required',
            'alamat_kantor' => 'required',
            'email_website' => 'required',
            'notel' => 'required',
            'latitude'=> 'required',
            'longitude'=> 'required',
        ]);


        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        if($request->file('icon'))
        {
            $gambar = $request->file('icon');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/setting');
            $filename_icon = "icon.".$ext;
            $gambar->move($destination, $filename_icon);
        }

        if($request->file('slider_gambar_utama'))
        {
            $gambar = $request->file('slider_gambar_utama');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/setting');
            $slider_gambar_utama = "slider_gambar_utama.".$ext;
            $gambar->move($destination, $slider_gambar_utama);
        }

        if($request->file('slider_gambar_objek_wisata'))
        {
            $gambar = $request->file('slider_gambar_objek_wisata');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/setting');
            $slider_gambar_objek_wisata = "slider_gambar_objek_wisata.".$ext;
            $gambar->move($destination, $slider_gambar_objek_wisata);
        }

        if($request->file('slider_gambar_event'))
        {
            $gambar = $request->file('slider_gambar_event');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/setting');
            $slider_gambar_event = "slider_gambar_event.".$ext;
            $gambar->move($destination, $slider_gambar_event);
        }

        if($request->file('slider_gambar_restoran'))
        {
            $gambar = $request->file('slider_gambar_restoran');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/setting');
            $slider_gambar_restoran = "slider_gambar_restoran.".$ext;
            $gambar->move($destination, $slider_gambar_restoran);
        }

        if($request->file('slider_gambar_hotel'))
        {
            $gambar = $request->file('slider_gambar_hotel');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/setting');
            $slider_gambar_hotel = "slider_gambar_hotel.".$ext;
            $gambar->move($destination, $slider_gambar_hotel);
        }

        if($request->file('gambar_login'))
        {
            $gambar = $request->file('gambar_login');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/setting');
            $filename_gambar_login = "gambar_login.".$ext;
            $gambar->move($destination, $filename_gambar_login);
        }

        if($request->file('gambar_promosi_satu'))
        {
            $gambar = $request->file('gambar_promosi_satu');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/setting');
            $gambar_promosi_satu = "gambar_promosi_satu.".$ext;
            $gambar->move($destination, $gambar_promosi_satu);
        }

        if($request->file('gambar_promosi_dua'))
        {
            $gambar = $request->file('gambar_promosi_dua');
            $ext = $gambar->getClientOriginalExtension();
            $destination = public_path('uploads/images/setting');
            $gambar_promosi_dua = "gambar_promosi_dua.".$ext;
            $gambar->move($destination, $gambar_promosi_dua);
        }



        $edit = Setting::find(1);
        $edit->nama_website =  $request->nama_website;
        $edit->keterangan_website =  $request->keterangan_website;
        $edit->alamat_kantor =  $request->alamat_kantor;
        if(isset($filename_icon)):
        $edit->icon =  $filename_icon;
        endif;
        $edit->email =  $request->email_website;
        $edit->notel =  $request->notel;
        if(isset($filename_logo_website)):
        $edit->logo_website =  $filename_logo_website;
        endif;
        if(isset($filename_gambar_login)):
        $edit->gambar_login =  $filename_gambar_login;
        endif;
        if(isset($slider_gambar_utama)):
        $edit->slider_gambar_utama =  $slider_gambar_utama;
        endif;
        if(isset($slider_gambar_objek_wisata)):
        $edit->slider_gambar_objek_wisata =  $slider_gambar_objek_wisata;
        endif;
        if(isset($slider_gambar_event)):
        $edit->slider_gambar_event =  $slider_gambar_event;
        endif;
        if(isset($slider_gambar_restoran)):
        $edit->slider_gambar_restoran =  $slider_gambar_restoran;
        endif;
        if(isset($slider_gambar_hotel)):
        $edit->slider_gambar_hotel =  $slider_gambar_hotel;
        endif;
        if(isset($gambar_promosi_satu)):
        $edit->gambar_promosi_satu =  $gambar_promosi_satu;
        endif;
        if(isset($gambar_promosi_dua)):
        $edit->gambar_promosi_dua =  $gambar_promosi_dua;
        endif;
        $edit->meta_description =  meta_description($request->keterangan_website);
        $edit->meta_keywords =  meta_keywords($request->nama_website);
        $edit->latitude = $request->latitude;
        $edit->longitude = $request->longitude;
        $edit->save();

        if($edit)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/pengaturan');
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
