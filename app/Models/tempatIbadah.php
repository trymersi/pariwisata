<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class tempatIbadah extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function getData($kab=false)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','tempat_ibadahs.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','tempat_ibadahs.objek_wisata_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'tempat_ibadahs.nama',
                'tempat_ibadahs.agama',
                'tempat_ibadahs.gambar',
                'tempat_ibadahs.alamat',
                'tempat_ibadahs.status',
                'tempat_ibadahs.id'
            );
            if($kab):
                $get->where('tempat_ibadahs.kabupaten_id',$kab);
            endif;
            $get->orderBy('tempat_ibadahs.updated_at','desc')
            ->get();
        return $get;
    }
}
