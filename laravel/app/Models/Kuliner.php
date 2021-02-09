<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Kuliner extends Model
{
    use HasFactory,SoftDeletes;

    public function getData($kab=false)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','kuliners.kabupaten_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kuliners.title',
                'kuliners.meta_description',
                'kuliners.video',
                'kuliners.thumbnail',
                'kuliners.updated_at',
                'kuliners.status',
                'kuliners.id'
            );
            if($kab):
                $data = $data->where('kuliners.kabupaten_id',$kab);
            endif;
            $data = $data->groupBy('kuliners.id')
            ->orderBy('kuliners.updated_at','desc')
            ->get();
        return $data;
    }

    public function getAll($kab=false)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','kuliners.kabupaten_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kuliners.title',
                'kuliners.meta_description',
                'kuliners.video',
                'kuliners.thumbnail',
                'kuliners.updated_at',
                'kuliners.status',
                'kuliners.id'
            );
            if($kab):
                $data = $data->where('kuliners.kabupaten_id',$kab);
            endif;
            $data = $data->groupBy('kuliners.id')
            ->orderBy('kuliners.updated_at','desc')
            ->paginate(10);
        return $data;
    }

    public function getApi($kab=false,$kw=false)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','kuliners.kabupaten_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kuliners.title',
                'kuliners.meta_description',
                'kuliners.video',
                'kuliners.thumbnail',
                'kuliners.updated_at',
                'kuliners.status',
                'kuliners.id'
            );
            if($kab && $kab != ''):
                $data = $data->where('kuliners.kabupaten_id',$kab);
            endif;

            if($kw && $kw != ''):
                $data = $data->where('kuliners.title','LIKE','%'.$kw.'%');
            endif;
            
            $data = $data->groupBy('kuliners.id')
            ->orderBy('kuliners.updated_at','desc')
            ->paginate(10);
        return $data;
    }

    public function getDetail($id)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','kuliners.kabupaten_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kuliners.title',
                'kuliners.meta_description',
                'kuliners.video',
                'kuliners.thumbnail',
                'kuliners.updated_at',
                'kuliners.status',
                'kuliners.id',
                'kuliners.isi'
            )
            ->where('kuliners.id',$id)
            ->first();
        return $data;
    }

    public function getTerdekat($id,$id_kuliner)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','kuliners.kabupaten_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kuliners.title',
                'kuliners.meta_description',
                'kuliners.video',
                'kuliners.thumbnail',
                'kuliners.updated_at',
                'kuliners.status',
                'kuliners.id'
            )
            ->where('kuliners.kabupaten_id',$id)
            ->where('kuliners.id','!=',$id_kuliner)
            ->groupBy('kuliners.id')
            ->orderBy('kuliners.updated_at','desc')
            ->limit(10)
            ->get();
        return $data;
    }
}
