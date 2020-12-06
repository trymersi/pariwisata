<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PemanduWisata extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function getData($kab=false)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','pemandu_wisatas.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','pemandu_wisatas.objek_wisata_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'pemandu_wisatas.nama',
                'pemandu_wisatas.alamat',
                'pemandu_wisatas.bahasa',
                'pemandu_wisatas.nomor_kontak',
                'pemandu_wisatas.status',
                'pemandu_wisatas.id'
            );
            if($kab):
                $data = $data->where('pemandu_wisatas.kabupaten_id',$kab);
            endif;
            $data = $data->orderBy('pemandu_wisatas.updated_at','desc')
            ->get();
            return $data;
    }
}
