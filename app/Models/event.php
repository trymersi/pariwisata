<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
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

    public function getHome()
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','events.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','events.objek_wisata_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'objek_wisatas.gambar_header',
                'events.nama',
                'events.tanggal_mulai',
                'events.gambar_header',
                'events.tanggal_selesai',
                'events.status',
                'events.id'
            )
            ->where('events.status',3)
            ->orderBy('events.updated_at','desc')
            ->limit(10)
            ->get();
        return $get;
    }

    public function getByKabupaten($id)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','events.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','events.objek_wisata_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'objek_wisatas.gambar_header',
                'events.nama',
                'events.tanggal_mulai',
                'events.gambar_header',
                'events.tanggal_selesai',
                'events.status',
                'events.id'
            )
            ->where('events.status',3)
            ->where('events.kabupaten_id',$id)
            ->orderBy('events.updated_at','desc')
            ->get();
        return $get;
    }

    public function getAll($kab = false)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','events.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','events.objek_wisata_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'objek_wisatas.gambar_header',
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
            $get = $get->where('events.status',3)
            ->orderBy('events.updated_at','desc')
            ->paginate(10);
        return $get;
    }

    public function getTerdekat($id,$id_event)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','events.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','events.objek_wisata_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'objek_wisatas.gambar_header',
                'events.nama',
                'events.tanggal_mulai',
                'events.gambar_header',
                'events.tanggal_selesai',
                'events.status',
                'events.id'
            )
            ->orderBy('events.updated_at','desc')
            ->where('events.status',3)
            ->where('events.kabupaten_id',$id)
            ->where('events.id','!=',$id_event)
            ->groupBy('events.nama')
            ->limit(6)
            ->get();
        return $get;
    }

    public function getDetail($id)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','events.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','events.objek_wisata_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'objek_wisatas.gambar_header',
                'events.nama',
                'events.tanggal_mulai',
                'events.gambar_header',
                'events.tanggal_selesai',
                'events.status',
                'events.id'
            )
            ->where('events.id',$id)
            ->first();
        return $get;
    }
    
}
