<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use DB;
class Hotel extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function getData($kab=false)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','hotels.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','hotels.objek_wisata_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'objek_wisatas.nama as nama_wisata',
                'hotels.nama as nama_hotel',
                'hotels.deskripsi as deskripsi_hotel',
                'hotels.gambar as gambar_hotel',
                'hotels.jenis as jenis_hotel',
                'hotels.id',
                'hotels.alamat as alamat_hotel',
                'hotels.status as status_hotel',
            );
            if($kab):
                $get = $get->where('hotels.kabupaten_id',$kab);
            endif;
            $get = $get->orderBy('hotels.updated_at','desc')
            ->get();
        return $get;
    }

    public function getHome()
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','hotels.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','hotels.objek_wisata_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kabupatens.gambar as gambar_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'objek_wisatas.gambar_header',
                'hotels.nama',
                'hotels.deskripsi',
                'hotels.gambar',
                'hotels.jenis',
                'hotels.id',
                'hotels.alamat',
                'hotels.status',
                'hotels.latitude',
                'hotels.longitude',
                'hotels.slug',
            )
            ->where('hotels.status',3)
            ->orderBy('hotels.updated_at','desc')
            ->get();
        return $get;
    }

    public function getAll($kab=false)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','hotels.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','hotels.objek_wisata_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kabupatens.gambar as gambar_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'objek_wisatas.gambar_header',
                'hotels.nama',
                'hotels.deskripsi',
                'hotels.gambar',
                'hotels.jenis',
                'hotels.id',
                'hotels.alamat',
                'hotels.status',
                'hotels.latitude',
                'hotels.longitude',
                'hotels.slug',
            )
            ->where('hotels.status',3)
            ->orderBy('hotels.updated_at','desc');
            if($kab):
                $get = $get->where('hotels.kabupaten_id',$kab);
            endif;
            $get = $get->orderBy('hotels.updated_at','desc')
            ->paginate(10);
        return $get;
    }

    public function getByKabupaten($id)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','hotels.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','hotels.objek_wisata_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'objek_wisatas.gambar_header',
                'hotels.nama',
                'hotels.deskripsi',
                'hotels.gambar',
                'hotels.jenis',
                'hotels.id',
                'hotels.alamat',
                'hotels.slug',
                'hotels.status',
            )
            ->where('hotels.status',3)
            ->where('hotels.status',3)
            ->where('hotels.kabupaten_id',$id)
            ->orderBy('hotels.updated_at','desc')
            ->get();
        return $get;
    }

    public function SearchHotel($kab=false,$kw)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','hotels.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','hotels.objek_wisata_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kabupatens.gambar as gambar_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'objek_wisatas.gambar_header',
                'hotels.nama',
                'hotels.deskripsi',
                'hotels.gambar',
                'hotels.jenis',
                'hotels.id',
                'hotels.alamat',
                'hotels.status',
                'hotels.latitude',
                'hotels.longitude',
            );
            if($kab):
                $data = $data->where('hotels.kabupaten_id',$kab);
            endif;
            if($kw != ''):
                $data = $data->where('hotels.nama','LIKE','%'.$kw.'%');
            endif;
            $data = $data->where('hotels.status',3)
            ->orderBy('hotels.updated_at','desc')
            ->get();
        return $data;
    }

    public function getDetail($id)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','hotels.kabupaten_id')
            ->leftJoin('hotel_gambars','hotel_gambars.hotel_id','hotels.id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kabupatens.gambar as gambar_kabupaten',
                'hotels.id',
                'hotels.gambar',
                'hotels.nama',
                'hotels.jenis',
                'hotels.status',
                'hotels.alamat',
                'hotels.deskripsi',
                'hotels.slug',
                'hotels.longitude',
                'hotels.latitude',
            )
            ->orderBy('hotels.updated_at','desc')
            ->where('hotels.status',3)
            ->where('hotels.id',$id)
            ->first();
        return $get;
    }

    public function getTerdekat($id,$id_hotel)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','hotels.kabupaten_id')
        ->leftJoin('hotel_gambars','hotel_gambars.hotel_id','hotels.id')
        ->select(
            'kabupatens.nama as nama_kabupaten',
            'kabupatens.gambar as gambar_kabupaten',
            'hotels.id',
            'hotels.gambar',
            'hotels.nama',
            'hotels.jenis',
            'hotels.status',
            'hotels.alamat',
            'hotels.deskripsi',
            'hotels.slug',
            'hotels.longitude',
            'hotels.latitude',
        )
        ->orderBy('hotels.updated_at','desc')
        ->where('hotels.status',3)
        ->where('hotels.kabupaten_id',$id)
        ->where('hotels.id','!=',$id_hotel)
        ->groupBy('hotels.nama')
        ->get();
    return $get;
    }

    public function getGaleri($id)
    {
        $get = $this->leftJoin('hotel_gambars','hotel_gambars.hotel_id','hotels.id')
            ->select(
                'hotel_gambars.gambar',
            )
            ->orderBy('hotels.updated_at','desc')
            ->where('hotels.status',3)
            ->where('hotels.id',$id)
            ->get();
        return $get;
    }

 
    


}
