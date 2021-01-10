<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SadarWisata extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function getData($kab=false)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','sadar_wisatas.kabupaten_id')
            ->leftJoin('kecamatans','kecamatans.id','sadar_wisatas.kecamatan_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kecamatans.nama as nama_kecamatan',
                'sadar_wisatas.nama',
                'sadar_wisatas.alamat',
                'sadar_wisatas.potensi_wisata',
                'sadar_wisatas.kontak',
                'sadar_wisatas.status',
                'sadar_wisatas.id'
            );
            if($kab):
                $data = $data->where('sadar_wisatas.kabupaten_id',$kab);
            endif;
            $data = $data->orderBy('sadar_wisatas.updated_at','desc')
            ->get();
            return $data;
    }

    public function getAll($kab=false)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','sadar_wisatas.kabupaten_id')
            ->leftJoin('kecamatans','kecamatans.id','sadar_wisatas.kecamatan_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kecamatans.nama as nama_kecamatan',
                'sadar_wisatas.nama',
                'sadar_wisatas.alamat',
                'sadar_wisatas.potensi_wisata',
                'sadar_wisatas.kontak',
                'sadar_wisatas.status',
                'sadar_wisatas.id'
            );
            if($kab):
                $data = $data->where('sadar_wisatas.kabupaten_id',$kab);
            endif;
            $data = $data->orderBy('sadar_wisatas.updated_at','desc')
            ->paginate(10);
            return $data;
    }

    public function getDetail($id)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','sadar_wisatas.kabupaten_id')
            ->leftJoin('kecamatans','kecamatans.id','sadar_wisatas.kecamatan_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kecamatans.nama as nama_kecamatan',
                'sadar_wisatas.nama',
                'sadar_wisatas.alamat',
                'sadar_wisatas.potensi_wisata',
                'sadar_wisatas.kontak',
                'sadar_wisatas.status',
                'sadar_wisatas.id'
            )
            ->where('sadar_wisatas.id',$id)
            ->first();
            return $data;
    }

    public function getTerdekat($id_kabupaten,$id_sadar_wisata)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','sadar_wisatas.kabupaten_id')
            ->leftJoin('kecamatans','kecamatans.id','sadar_wisatas.kecamatan_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kecamatans.nama as nama_kecamatan',
                'sadar_wisatas.nama',
                'sadar_wisatas.alamat',
                'sadar_wisatas.potensi_wisata',
                'sadar_wisatas.kontak',
                'sadar_wisatas.status',
                'sadar_wisatas.id'
            )
            ->where('sadar_wisatas.kabupaten_id',$id_kabupaten)
            ->where('sadar_wisatas.id','!=',$id_sadar_wisata)
            ->orderBy('sadar_wisatas.updated_at','desc')
            ->limit(10)
            ->get();
            return $data;
    }

}
