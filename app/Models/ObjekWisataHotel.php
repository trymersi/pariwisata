<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjekWisataHotel extends Model
{
    use HasFactory;

    public function getData($id)
    {
        $data = $this->leftJoin('hotels','hotels.id','objek_wisata_hotels.hotel_id')
            ->select(
                'hotels.nama',
                'hotels.gambar',
                'objek_wisata_hotels.id',
                'objek_wisata_hotels.jarak'
                )
            ->where('objek_wisata_hotels.objek_wisata_id',$id)
            ->get();
        return $data;
    }
}
