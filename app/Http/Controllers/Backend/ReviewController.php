<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ObjekWisataReview;
use App\Models\ObjekWisata;
use Carbon\Carbon;
use DataTables;
use Toastr;
use File;
use Auth;
class ReviewController extends Controller
{
    private $data;
    private $objekWisataReview;
    private $objekWisata;

    public function __construct()
    {
        $this->middleware(['role:super_admin']);

        $this->objekWisataReview = new ObjekWisataReview;
        $this->objekWisata = new ObjekWisata;


        $this->data = [
            'category_name' => 'Review',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'alt_menu' => 1,
        ];
    }

    public function objekWisata()
    {
        $this->data['page_name'] = "Objek Wisata";
        return view('dashboard.pages.review.objek-wisata',$this->data);
    }

    public function tableObjekWisata()
    {
        $data = $this->objekWisataReview->getData();
            return DataTables::of($data)
            ->addColumn('status', function($data)
            {
               return  statusUlasan($data->status);
            })
            ->addColumn('option', function($data)
            {
                if($data->status == 0)
                {
                    $button = '<a data-id="'.$data->id.'" class="status-aktivkan btn btn-warning mb-2 mr-2 btn-sm">Publish</a>';
                }
                else
                {
                    $button = '<a data-id="'.$data->id.'" class="status-nonaktivkan btn btn-success mb-2 mr-2 btn-sm">Unpublish</a>';
                }
                
                $button .= '<button data-id="'.$data->id.'" data-nama="'.$data->nama.'" class="btn btn-danger mb-2 mr-2 btn-sm" data-toggle="modal" data-target="#ModalHapus" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
                return  $button;
            })

            ->addColumn('tanggal', function($data)
            {
                return  Carbon::parse($data->created_at)->diffForHumans();
            })

            ->addIndexColumn()
            ->rawColumns(['status','option','gambar','jenis','detail','deskripsi'])
            ->make(true);
    }

    public function setaktivObjekWisata(Request $r)
    {
        $id = $r->id;
        $save = ObjekWisataReview::find($id);
        $save->status = 1;
        $save->save();
        
        return ['status'=>0];
    }

    public function setNonAktivObjekWisata(Request $r)
    {
        $id = $r->id;
        $save = ObjekWisataReview::find($id);
        $save->status = 0;
        $save->save();
        
        return ['status'=>0];
    }

    public function hapusObjekWisata($id)
    {
        $data = $this->objekWisataReview->find($id);
        $data->delete();
        return ['status'=>'1'];
    }
    
}
