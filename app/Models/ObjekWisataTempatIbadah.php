<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjekWisataTempatIbadah extends Model
{
    use HasFactory;

    public function getData($id)
    {
        $data = $this->leftJoin('tempat_ibadahs','tempat_ibadahs.id','objek_wisata_tempat_ibadahs.tempat_ibadah_id')
            ->select(
                'tempat_ibadahs.nama',
                'tempat_ibadahs.gambar',
                'objek_wisata_tempat_ibadahs.id',
                'objek_wisata_tempat_ibadahs.jarak'
                )
            ->where('objek_wisata_tempat_ibadahs.objek_wisata_id',$id)
            ->get();
        return $data;
    }
}
