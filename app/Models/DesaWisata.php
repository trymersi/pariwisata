<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class DesaWisata extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function getData($kab=false)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','desa_wisatas.kabupaten_id')
            ->leftJoin('kecamatans','kecamatans.id','desa_wisatas.kecamatan_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kecamatans.nama as nama_kecamatan',
                'desa_wisatas.nama',
                'desa_wisatas.alamat',
                'desa_wisatas.potensi_wisata',
                'desa_wisatas.kontak',
                'desa_wisatas.status',
                'desa_wisatas.id'
            );
            if($kab):
                $data = $data->where('desa_wisatas.kabupaten_id',$kab);
            endif;
            $data = $data->orderBy('desa_wisatas.updated_at','desc')
            ->get();
            return $data;
    }

}
