<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class DesaWisata extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function getData($kab=false)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','desa_wisatas.kabupaten_id')
            ->leftJoin('kecamatans','kecamatans.id','desa_wisatas.kecamatan_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kecamatans.nama as nama_kecamatan',
                'desa_wisatas.nama',
                'desa_wisatas.alamat',
                'desa_wisatas.potensi_wisata',
                'desa_wisatas.kontak',
                'desa_wisatas.status',
                'desa_wisatas.id'
            );
            if($kab):
                $data = $data->where('desa_wisatas.kabupaten_id',$kab);
            endif;
            $data = $data->orderBy('desa_wisatas.updated_at','desc')
            ->get();
            return $data;
    }

    public function getAll($kab=false)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','desa_wisatas.kabupaten_id')
            ->leftJoin('kecamatans','kecamatans.id','desa_wisatas.kecamatan_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kecamatans.nama as nama_kecamatan',
                'desa_wisatas.nama',
                'desa_wisatas.alamat',
                'desa_wisatas.potensi_wisata',
                'desa_wisatas.kontak',
                'desa_wisatas.status',
                'desa_wisatas.id'
            );
            if($kab):
                $data = $data->where('desa_wisatas.kabupaten_id',$kab);
            endif;
            $data = $data->orderBy('desa_wisatas.updated_at','desc')
            ->paginate(10);
            return $data;
    }

    public function getApi($kab=false,$kw=false)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','desa_wisatas.kabupaten_id')
            ->leftJoin('kecamatans','kecamatans.id','desa_wisatas.kecamatan_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kecamatans.nama as nama_kecamatan',
                'desa_wisatas.nama',
                'desa_wisatas.alamat',
                'desa_wisatas.potensi_wisata',
                'desa_wisatas.kontak',
                'desa_wisatas.status',
                'desa_wisatas.id',
                'desa_wisatas.gambar_header'
            );
            if($kab && $kab != ''):
                $data = $data->where('desa_wisatas.kabupaten_id',$kab);
            endif;
            if($kw && $kw != ''):
                $data = $data->where('desa_wisatas.nama','LIKE','%'.$kw.'%');
            endif;
            $data = $data->orderBy('desa_wisatas.updated_at','desc')
            ->paginate(10);
            return $data;
    }

    public function getDetail($id)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','desa_wisatas.kabupaten_id')
            ->leftJoin('kecamatans','kecamatans.id','desa_wisatas.kecamatan_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kecamatans.nama as nama_kecamatan',
                'desa_wisatas.nama',
                'desa_wisatas.alamat',
                'desa_wisatas.potensi_wisata',
                'desa_wisatas.kontak',
                'desa_wisatas.status',
                'desa_wisatas.id'
            )
            ->where('desa_wisatas.id',$id)
            ->first();
            return $data;
    }

    public function getTerdekat($id,$id_desa_wisata)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','desa_wisatas.kabupaten_id')
            ->leftJoin('kecamatans','kecamatans.id','desa_wisatas.kecamatan_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kecamatans.nama as nama_kecamatan',
                'desa_wisatas.nama',
                'desa_wisatas.alamat',
                'desa_wisatas.potensi_wisata',
                'desa_wisatas.kontak',
                'desa_wisatas.status',
                'desa_wisatas.id'
            )
            ->where('desa_wisatas.kabupaten_id',$id)
            ->where('desa_wisatas.id','!=',$id_desa_wisata)
            ->orderBy('desa_wisatas.updated_at','desc')
            ->limit(10)
            ->get();
            return $data;
    }

}
