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

    public function SearchRestaurant($kab=false,$kw)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','restaurants.kabupaten_id')
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
            );
            if($kab):
                $data = $data->where('restaurants.kabupaten_id',$kab);
            endif;
            if($kw != ''):
                $data = $data->where('restaurants.nama','LIKE','%'.$kw.'%');
            endif;
            $data = $data->where('restaurants.status',3)
            ->orderBy('restaurants.updated_at','desc')
            ->get();
        return $data;
    }

    public function getDetail($id)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','restaurants.kabupaten_id')
            ->leftJoin('restaurant_gambars','restaurant_gambars.restaurant_id','restaurants.id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kabupatens.gambar as gambar_kabupaten',
                'restaurants.id',
                'restaurants.gambar',
                'restaurants.nama',
                'restaurants.halal',
                'restaurants.status',
                'restaurants.alamat',
                'restaurants.deskripsi',
                'restaurants.slug',
                'restaurants.longitude',
                'restaurants.latitude',
                'restaurants.nomor_kontak',

            )
            ->orderBy('restaurants.updated_at','desc')
            ->where('restaurants.status',3)
            ->where('restaurants.id',$id)
            ->first();
        return $get;
    }

    public function getTerdekat($id,$id_hotel)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','restaurants.kabupaten_id')
        ->leftJoin('restaurant_gambars','restaurant_gambars.restaurant_id','restaurants.id')
        ->select(
            'kabupatens.nama as nama_kabupaten',
            'kabupatens.gambar as gambar_kabupaten',
            'restaurants.id',
            'restaurants.gambar',
            'restaurants.nama',
            'restaurants.halal',
            'restaurants.status',
            'restaurants.alamat',
            'restaurants.deskripsi',
            'restaurants.slug',
            'restaurants.longitude',
            'restaurants.latitude',
        )
        ->orderBy('restaurants.updated_at','desc')
        ->where('restaurants.status',3)
        ->where('restaurants.kabupaten_id',$id)
        ->where('restaurants.id','!=',$id_hotel)
        ->groupBy('restaurants.nama')
        ->get();
    return $get;
    }

    public function getGaleri($id)
    {
        $get = $this->leftJoin('restaurant_gambars','restaurant_gambars.restaurant_id','restaurants.id')
            ->select(
                'restaurant_gambars.gambar',
            )
            ->orderBy('restaurants.updated_at','desc')
            ->where('restaurants.status',3)
            ->where('restaurants.id',$id)
            ->get();
        return $get;
    }
    public function getMenu($id)
    {
        $get = $this->leftJoin('restaurant_menus','restaurant_menus.restaurant_id','restaurants.id')
            ->select(
                'restaurant_menus.nama',
                'restaurant_menus.deskripsi',
                'restaurant_menus.gambar',
            )
            ->orderBy('restaurant_menus.updated_at','desc')
            ->where('restaurant_menus.restaurant_id',$id)
            ->get();
        return $get;
    }
}
