<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Cindramata extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function getData($kab=false)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','cindramatas.kabupaten_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'cindramatas.nama',
                'cindramatas.jenis',
                'cindramatas.gambar',
                'cindramatas.deskripsi',
                'cindramatas.status',
                'cindramatas.id'
            );
            if($kab):
                $get = $get->where('cindramatas.kabupaten_id',$kab);
            endif;
            $get = $get->orderBy('cindramatas.updated_at','desc')
            ->get();
        return $get;
    }

    public function getAll($kab=false)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','cindramatas.kabupaten_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'cindramatas.nama',
                'cindramatas.jenis',
                'cindramatas.gambar',
                'cindramatas.deskripsi',
                'cindramatas.status',
                'cindramatas.id'
            );
            if($kab):
                $get = $get->where('cindramatas.kabupaten_id',$kab);
            endif;
            $get = $get->orderBy('cindramatas.updated_at','desc')
            ->get();
        return $get;
    }

    public function getApi($kab=false,$kw=false)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','cindramatas.kabupaten_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'cindramatas.nama',
                'cindramatas.jenis',
                'cindramatas.gambar',
                'cindramatas.deskripsi',
                'cindramatas.status',
                'cindramatas.id'
            );
            if($kab && $kab != ''):
                $get = $get->where('cindramatas.kabupaten_id',$kab);
            endif;
            if($kw && $kw != ''):
                $get = $get->where('cindramatas.nama','LIKE','%'.$kw.'%');
            endif;
            $get = $get->orderBy('cindramatas.updated_at','desc')
            ->paginate(10);
        return $get;
    }

    public function getDetail($id)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','cindramatas.kabupaten_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'cindramatas.nama',
                'cindramatas.jenis',
                'cindramatas.gambar',
                'cindramatas.deskripsi',
                'cindramatas.status',
                'cindramatas.id'
            )
            ->where('cindramatas.id',$id)
            ->orderBy('cindramatas.updated_at','desc')
            ->first();
        return $get;
    }

    public function getTerdekat($id,$id_cendramata)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','cindramatas.kabupaten_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'cindramatas.nama',
                'cindramatas.jenis',
                'cindramatas.gambar',
                'cindramatas.deskripsi',
                'cindramatas.status',
                'cindramatas.id'
            )
            ->where('cindramatas.kabupaten_id',$id)
            ->where('cindramatas.id','!=',$id_cendramata)
            ->orderBy('cindramatas.updated_at','desc')
            ->limit(10)
            ->get();
        return $get;
    }

    
}
