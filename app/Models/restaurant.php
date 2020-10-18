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
}
