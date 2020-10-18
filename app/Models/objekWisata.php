<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class objekWisata extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function getData($kab=false)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','objek_wisatas.kabupaten_id')
            ->leftJoin('kecamatans','kecamatans.id','objek_wisatas.kecamatan_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kecamatans.nama as nama_kecamatan',
                'objek_wisatas.id',
                'objek_wisatas.gambar_header',
                'objek_wisatas.nama',
                'objek_wisatas.jenis',
                'objek_wisatas.status',
            );
            if($kab):
                $get->where('objek_wisatas.kabupaten_id',$kab);
            endif;
            $get->orderBy('objek_wisatas.updated_at','desc')
            ->get();
        return $get;
    }

    public function getDataByKab($id)
    {
        return $this->where('kabupaten_id',$id)
            ->select('id','nama as text')
            ->orderBy('nama','asc')
            ->get();
    }
}
