<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class restaurant extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function getData($kab=false)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','restaurants.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','restaurants.objek_wisata_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'restaurants.nama',
                'restaurants.deskripsi',
                'restaurants.gambar',
                'restaurants.nomor_kontak',
                'restaurants.halal',
                'restaurants.status',
                'restaurants.id'
            );
            if($kab):
                $get->where('restaurants.kabupaten_id',$kab);
            endif;
            $get->orderBy('restaurants.updated_at','desc')
            ->get();
        return $get;
    }

    public function getHome()
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','restaurants.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','restaurants.objek_wisata_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kabupatens.gambar as gambar_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'objek_wisatas.gambar_header',
                'restaurants.nama',
                'restaurants.deskripsi',
                'restaurants.gambar',
                'restaurants.nomor_kontak',
                'restaurants.halal',
                'restaurants.status',
                'restaurants.longitude',
                'restaurants.latitude',
                'restaurants.alamat',
                'restaurants.id',
                'restaurants.slug',
            )
            ->where('restaurants.status',3)
            ->orderBy('restaurants.updated_at','desc')
            ->get();
        return $get;
    }

    public function getByKabupaten($id)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','restaurants.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','restaurants.objek_wisata_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'objek_wisatas.gambar_header',
                'restaurants.nama',
                'restaurants.deskripsi',
                'restaurants.gambar',
                'restaurants.nomor_kontak',
                'restaurants.halal',
                'restaurants.status',
                'restaurants.longitude',
                'restaurants.latitude',
                'restaurants.alamat',
                'restaurants.id'
            )
            ->where('restaurants.status',3)
            ->where('restaurants.kabupaten_id',$id)
            ->orderBy('restaurants.updated_at','desc')
            ->get();
        return $get;
    }
}
