<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Cindramata extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function getData($kab=false)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','cindramatas.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','cindramatas.objek_wisata_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'cindramatas.nama',
                'cindramatas.alamat',
                'cindramatas.gambar',
                'cindramatas.nomor_kontak',
                'cindramatas.status',
                'cindramatas.id'
            );
            if($kab):
                $get = $get->where('cindramatas.kabupaten_id',$kab);
            endif;
            $get = $get->orderBy('cindramatas.updated_at','desc')
            ->get();
        return $get;
    }

    public function getAll($kab=false)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','cindramatas.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','cindramatas.objek_wisata_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'cindramatas.nama',
                'cindramatas.alamat',
                'cindramatas.gambar',
                'cindramatas.nomor_kontak',
                'cindramatas.status',
                'cindramatas.id'
            );
            if($kab):
                $get = $get->where('cindramatas.kabupaten_id',$kab);
            endif;
            $get = $get->orderBy('cindramatas.updated_at','desc')
            ->get();
        return $get;
    }

    public function getDetail($id)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','cindramatas.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','cindramatas.objek_wisata_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'cindramatas.nama',
                'cindramatas.alamat',
                'cindramatas.gambar',
                'cindramatas.nomor_kontak',
                'cindramatas.status',
                'cindramatas.id'
            )
            ->where('cindramatas.id',$id)
            ->orderBy('cindramatas.updated_at','desc')
            ->first();
        return $get;
    }

    public function getTerdekat($id,$id_cendramata)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','cindramatas.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','cindramatas.objek_wisata_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'cindramatas.nama',
                'cindramatas.alamat',
                'cindramatas.gambar',
                'cindramatas.nomor_kontak',
                'cindramatas.status',
                'cindramatas.id'
            )
            ->where('cindramatas.kabupaten_id',$id)
            ->where('cindramatas.id','!=',$id_cendramata)
            ->orderBy('cindramatas.updated_at','desc')
            ->limit(10)
            ->get();
        return $get;
    }

    
}
