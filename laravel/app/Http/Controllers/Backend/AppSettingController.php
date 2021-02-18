<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SettingAplikasi;
use Toastr;
use Image;
class AppSettingController extends Controller
{
    private $data;
    private $SettingClass;

    

    public function __construct()
    {
        $this->middleware(['role:super_admin']);

        $this->SettingClass = new SettingAplikasi;

        $this->data = [
            'category_name' => 'Pengaturan Aplikasi',
            'page_name' => 'Pengaturan Aplikasi',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'alt_menu' => 1,
        ];
    }

    public function index()
    {
        $this->data['edit'] = $this->SettingClass->where('id',1)->first();
        return view('dashboard.pages.setting-aplikasi.index',$this->data);
        
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_aplikasi' => 'required',
            'versi_aplikasi' => 'required',
            'tentang_kami' => 'required',
            'ketentuan'=> 'required',
            'kebijakan' => 'required',
        ]);


        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }

        if($request->file('gambar_slide1'))
        {
            $destination = public_path('uploads/images/setting');
            $gambar_slide1 = rand().".jpg";
            $gambar = Image::make($request->file('gambar_slide1'));
            $gambar->encode('jpg', 60);
            $gambar->resize(500, null, function ($constraint) {$constraint->aspectRatio();});
            $gambar->save($destination.'/'.$gambar_slide1);
        }

        if($request->file('gambar_slide2'))
        {
            $destination = public_path('uploads/images/setting');
            $gambar_slide2 = rand().".jpg";
            $gambar = Image::make($request->file('gambar_slide2'));
            $gambar->encode('jpg', 60);
            $gambar->resize(500, null, function ($constraint) {$constraint->aspectRatio();});
            $gambar->save($destination.'/'.$gambar_slide2);
        }

        if($request->file('gambar_slide3'))
        {
            $destination = public_path('uploads/images/setting');
            $gambar_slide3 = rand().".jpg";
            $gambar = Image::make($request->file('gambar_slide3'));
            $gambar->encode('jpg', 60);
            $gambar->resize(500, null, function ($constraint) {$constraint->aspectRatio();});
            $gambar->save($destination.'/'.$gambar_slide3);
        }

        $edit = SettingAplikasi::find(1);
        $edit->nama_aplikasi = $request->nama_aplikasi;
        $edit->versi_aplikasi = $request->versi_aplikasi;
        $edit->tentang_kami = $request->tentang_kami;
        $edit->ketentuan = $request->ketentuan;
        $edit->kebijakan = $request->kebijakan;
        if(isset($gambar_slide1)):
            $edit->gambar_slide1 = $gambar_slide1;
        endif;
        if(isset($gambar_slide2)):
            $edit->gambar_slide2 = $gambar_slide2;
        endif;
        if(isset($gambar_slide3)):
            $edit->gambar_slide3 = $gambar_slide3;
        endif;
        $edit->judul_slide1 = $request->judul_slide1;
        $edit->judul_slide2 = $request->judul_slide2;
        $edit->judul_slide3 = $request->judul_slide3;
        $edit->keterangan_slide1 = $request->keterangan_slide1;
        $edit->keterangan_slide2 = $request->keterangan_slide2;
        $edit->keterangan_slide3 = $request->keterangan_slide3;
        $edit->save();

        if($edit)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/pengaturan-aplikasi');
    }
}
