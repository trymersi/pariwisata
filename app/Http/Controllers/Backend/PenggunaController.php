<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Kabupaten;
use App\Models\User;
use DataTables;
use Toastr;
use File;  

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    private $data;
    private $kabupatenClass;
    private $userClass;

    public function __construct()
    {
        $this->middleware(['role:super_admin']);

        $this->kabupatenClass = new Kabupaten;
        $this->userClass = new User;

        $this->data = [
            'category_name' => 'Master',
            'page_name' => 'Pengguna',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'alt_menu' => 1,
        ];
    }


    public function index()
    {
        return view('dashboard.pages.pengguna.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $this->data['kabupaten'] = $this->kabupatenClass->orderBy('nama_kabupaten','asc')->get();
        return view('dashboard.pages.pengguna.create',$this->data);
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
            'nama' => 'required',
            'password' => 'required|confirmed|min:6',
            'email' => 'required|unique:users,email',
            'username' => 'required|unique:users,username',
            'level'=> 'required',
            'tos' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }
        
        if($request->file('foto'))
        {
            $foto = $request->file('foto');
            $ext = $foto->getClientOriginalExtension();
            $destination = public_path('uploads/images/pengguna');
            $filename = $request->username.".".$ext;
            $foto->move($destination, $filename);
        }

        $kab = ($request->level == 7) ? $request->kabupaten : NULL; 

        $this->userClass->nama = $request->nama;
        $this->userClass->email = $request->email;
        $this->userClass->username = $request->username;
        $this->userClass->password = Hash::make($request->password);
        $this->userClass->level = $request->level;
        $this->userClass->kabupaten_id = $kab;
        $this->userClass->foto = isset($filename) ? $filename :'default.jpg';
        $this->userClass->status = isset($request->status) ? 1 : 0;
        $this->userClass->save();
        
        if($this->userClass)
        {
            Toastr::success('Data Berhasil Disimpan', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/pengguna');
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
        $this->data['kabupaten'] = $this->kabupatenClass->orderBy('nama_kabupaten','asc')->get();
        $this->data['edit'] = $this->userClass->find($id);
        return view('dashboard.pages.pengguna.edit',$this->data);
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
            'nama' => 'required',
            'email' => 'required',
            'username' => 'required',
            'level'=> 'required',
            'tos' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error('Terjadi Kesalahan Saat Menyimpan Data', 'Gagal', ["positionClass" => "toast-bottom-right"]);
            return Redirect::back()->withErrors($validator)->withInput();
        }
        
        if($request->file('foto'))
        {
            $foto = $request->file('foto');
            $ext = $foto->getClientOriginalExtension();
            $destination = public_path('uploads/images/pengguna');
            $filename = $request->username.".".$ext;
            $foto->move($destination, $filename);
        }

        $kab = ($request->level == 7) ? $request->kabupaten : NULL; 

        $edit = $this->userClass->find($id);
        $edit->nama = $request->nama;
        $edit->email = $request->email;
        $edit->username = $request->username;
        if($request->password):
            $edit->password = Hash::make($request->password);
        endif;
        $edit->level = $request->level;
        $edit->kabupaten_id = $kab;
        if(isset($filename)):
            $edit->foto = $filename;
        endif;
        $edit->status = isset($request->status) ? 1 : 0;
        $edit->save();
        
        if($edit)
        {
            Toastr::success('Data Berhasil Diubah', 'Sukses', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect::to('dashboard/pengguna');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->userClass->find($id);
        if($data->foto != 'default.jpg')
        {
            $path = public_path('uploads/images/pengguna');
            File::delete($path.'/'.$data->foto);
        }
        $data->delete();
        return ['status'=>'1'];
    }

    public function table(Request $request)
    {   
        
        $data = $this->userClass->orderBy('created_at','desc')->get();
            return DataTables::of($data)
            ->addColumn('foto', function($data)
            {
               return  "<img width='150px' src='".asset('uploads/images/pengguna/'.$data->foto)."'>";
            })

            ->addColumn('option', function($data)
            {
                $button = '<a href="'.url('dashboard/pengguna/edit/'.$data->id).'" class="btn btn-warning mb-2 mr-2 btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
                $button .= '<button data-id="'.$data->id.'" data-nama="'.$data->nama.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
                return  $button;
            })

            ->addColumn('level', function($data)
            {
                $level = levelCode($data->level);
                if($data->level == 7)
                {
                    $kab = $this->kabupatenClass->find($data->kabupaten_id);
                    $level = $level.' <span class="badge badge-success">'.$kab->nama_kabupaten.'</span>';
                }
                return $level;
            })

            ->addColumn('status', function($data)
            {
                return ($data->status == 1) ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Tidak Aktif</span>';
            })

            ->addIndexColumn()
            ->rawColumns(['option','foto','status','level'])
            ->make(true);
    }
}
