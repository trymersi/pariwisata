<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function getData($kab=false)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','travel.kabupaten_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'travel.nama',
                'travel.alamat',
                'travel.kontak',
                'travel.status',
                'travel.id',
                'travel.gambar'
            );
            if($kab):
                $data = $data->where('travel.kabupaten_id',$kab);
            endif;
            $data = $data->orderBy('travel.updated_at','desc')
            ->get();
            return $data;
    }

    public function getAll($kab=false)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','travel.kabupaten_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'travel.nama',
                'travel.alamat',
                'travel.kontak',
                'travel.status',
                'travel.id',
                'travel.gambar'
            );
            if($kab):
                $data = $data->where('travel.kabupaten_id',$kab);
            endif;
            $data = $data->orderBy('travel.updated_at','desc')
            ->paginate(10);
            return $data;
    }

    public function getApi($kab=false,$kw=false)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','travel.kabupaten_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'travel.nama',
                'travel.alamat',
                'travel.kontak',
                'travel.status',
                'travel.id',
                'travel.gambar'
            );
            if($kab && $kab != ''):
                $data = $data->where('travel.kabupaten_id',$kab);
            endif;
            if($kw && $kw != ''):
                $data = $data->where('travel.nama','LIKE','%'.$kw.'%');
            endif;
            $data = $data->orderBy('travel.updated_at','desc')
            ->paginate(10);
            return $data;
    }

    public function getDetail($id)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','travel.kabupaten_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'travel.nama',
                'travel.alamat',
                'travel.kontak',
                'travel.status',
                'travel.id',
                'travel.gambar'
            )
            ->where('travel.id',$id)
            ->first();
            return $data;
    }

    public function getTerdekat($id_kabupaten,$id_travel)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','travel.kabupaten_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'travel.nama',
                'travel.alamat',
                'travel.kontak',
                'travel.status',
                'travel.id',
                'travel.gambar'
            )
            ->where('travel.kabupaten_id',$id_kabupaten)
            ->where('travel.id','!=',$id_travel)
            ->orderBy('travel.updated_at','desc')
            ->limit(10)
            ->get();
            return $data;
    }

}
