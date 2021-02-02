<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjekWisataReview extends Model
{
    use HasFactory;

    public function getData()
    {
        $data = $this->leftJoin('objek_wisatas','objek_wisatas.id','objek_wisata_reviews.objek_wisata_id')
            ->select(
                'objek_wisata_reviews.nama',
                'objek_wisata_reviews.email',
                'objek_wisata_reviews.rating',
                'objek_wisata_reviews.ulasan',
                'objek_wisata_reviews.status',
                'objek_wisata_reviews.created_at',
                'objek_wisatas.nama as nama_objek',
                'objek_wisata_reviews.id'
                )
            ->orderBy('objek_wisata_reviews.id','desc')
            ->get();
        return $data;
    }
}
