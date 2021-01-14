<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjekWisataRestaurant extends Model
{
    use HasFactory;

    public function getData($id)
    {
        $data = $this->leftJoin('restaurants','restaurants.id','objek_wisata_restaurants.restaurant_id')
            ->select(
                'restaurants.nama',
                'restaurants.gambar',
                'objek_wisata_restaurants.id',
                'objek_wisata_restaurants.jarak'
                )
            ->where('objek_wisata_restaurants.objek_wisata_id',$id)
            ->get();
        return $data;
    }
}
