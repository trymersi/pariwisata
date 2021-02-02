<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function getData()
    {
        $get = $this->leftJoin('objek_wisatas','objek_wisatas.id','kunjungans.objek_wisata_id')
            ->select(
                'objek_wisatas.nama',
                'kunjungans.id',
                'kunjungans.lokal',
                'kunjungans.internasional',
                'kunjungans.bulan',
                'kunjungans.tahun',
                'kunjungans.updated_at'
            )
            ->orderBy('kunjungans.updated_at','desc')
            ->get();
        return $get;
    }
}
