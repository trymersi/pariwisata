<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    public function getData($kab=false)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','events.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','events.objek_wisata_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'events.nama',
                'events.tanggal_mulai',
                'events.gambar_header',
                'events.tanggal_selesai',
                'events.status',
                'events.id'
            );
        if($kab):
            $get = $get->where('events.kabupaten_id',$kab);
        endif;
            $get = $get->orderBy('events.updated_at','desc')
            ->get();
        return $get;
    }
    
}
