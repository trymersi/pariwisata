<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SettingAplikasi;
use Toastr;
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

        $edit = SettingAplikasi::find(1);
        $edit->nama_aplikasi = $request->nama_aplikasi;
        $edit->versi_aplikasi = $request->versi_aplikasi;
        $edit->tentang_kami = $request->tentang_kami;
        $edit->ketentuan = $request->ketentuan;
        $edit->kebijakan = $request->kebijakan;
        $edit->save();

        if($edit)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/pengaturan-aplikasi');
    }
}
