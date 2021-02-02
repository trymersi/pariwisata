<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class TempatIbadah extends Model
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
                $get = $get->where('tempat_ibadahs.kabupaten_id',$kab);
            endif;
            $get = $get->orderBy('tempat_ibadahs.updated_at','desc')
            ->get();
        return $get;
    }

    public function getHome()
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','tempat_ibadahs.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','tempat_ibadahs.objek_wisata_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kabupatens.gambar as gambar_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'objek_wisatas.gambar_header',
                'tempat_ibadahs.nama',
                'tempat_ibadahs.agama',
                'tempat_ibadahs.gambar',
                'tempat_ibadahs.alamat',
                'tempat_ibadahs.status',
                'tempat_ibadahs.slug',
                'tempat_ibadahs.id',
                'tempat_ibadahs.longitude',
                'tempat_ibadahs.latitude',
            )
            ->where('tempat_ibadahs.status',3)
            ->orderBy('tempat_ibadahs.updated_at','desc')
            ->limit(10)
            ->get();
        return $get;
    }

    public function getAll($kab=false)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','tempat_ibadahs.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','tempat_ibadahs.objek_wisata_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kabupatens.gambar as gambar_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'objek_wisatas.gambar_header',
                'tempat_ibadahs.nama',
                'tempat_ibadahs.agama',
                'tempat_ibadahs.gambar',
                'tempat_ibadahs.alamat',
                'tempat_ibadahs.status',
                'tempat_ibadahs.slug',
                'tempat_ibadahs.id',
                'tempat_ibadahs.longitude',
                'tempat_ibadahs.latitude',
            );
            if($kab):
                $get = $get->where('tempat_ibadahs.kabupaten_id',$kab);
            endif;
            $get = $get->orderBy('tempat_ibadahs.nama','asc')
            ->where('tempat_ibadahs.status',3)
            ->paginate(10);
        return $get;
    }

    public function getApi($kab=false,$kw=false)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','tempat_ibadahs.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','tempat_ibadahs.objek_wisata_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kabupatens.gambar as gambar_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'objek_wisatas.gambar_header',
                'tempat_ibadahs.nama',
                'tempat_ibadahs.agama',
                'tempat_ibadahs.gambar',
                'tempat_ibadahs.alamat',
                'tempat_ibadahs.status',
                'tempat_ibadahs.slug',
                'tempat_ibadahs.id',
                'tempat_ibadahs.longitude',
                'tempat_ibadahs.latitude',
            );
            if($kab && $kab != ''):
                $get = $get->where('tempat_ibadahs.kabupaten_id',$kab);
            endif;
            if($kw && $kw != ''):
                $get = $get->where('tempat_ibadahs.nama','LIKE','%'.$kw.'%');
            endif;
            $get = $get->orderBy('tempat_ibadahs.nama','asc')
            ->where('tempat_ibadahs.status',3)
            ->paginate(10);
        return $get;
    }

    public function getByKabupaten($id)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','tempat_ibadahs.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','tempat_ibadahs.objek_wisata_id')
            
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'objek_wisatas.gambar_header',
                'tempat_ibadahs.nama',
                'tempat_ibadahs.agama',
                'tempat_ibadahs.gambar',
                'tempat_ibadahs.alamat',
                'tempat_ibadahs.status',
                'tempat_ibadahs.id'
            )
            ->where('tempat_ibadahs.status',3)
            ->where('tempat_ibadahs.kabupaten_id',$id)
            ->orderBy('tempat_ibadahs.updated_at','desc')
            ->get();
        return $get;
    }

    public function SearchTempatIbadah($kab=false,$kw)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','tempat_ibadahs.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','tempat_ibadahs.objek_wisata_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kabupatens.gambar as gambar_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'objek_wisatas.gambar_header',
                'tempat_ibadahs.nama',
                'tempat_ibadahs.agama',
                'tempat_ibadahs.gambar',
                'tempat_ibadahs.alamat',
                'tempat_ibadahs.status',
                'tempat_ibadahs.slug',
                'tempat_ibadahs.id',
                'tempat_ibadahs.longitude',
                'tempat_ibadahs.latitude',
                
            );
            if($kab):
                $data = $data->where('tempat_ibadahs.kabupaten_id',$kab);
            endif;
            if($kw != ''):
                $data = $data->where('tempat_ibadahs.nama','LIKE','%'.$kw.'%');
            endif;
            $data = $data->where('tempat_ibadahs.status',3)
            ->orderBy('tempat_ibadahs.updated_at','desc')
            ->get();
        return $data;
    }
    public function getDetail($id)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','tempat_ibadahs.kabupaten_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kabupatens.gambar as gambar_kabupaten',
                'tempat_ibadahs.id',
                'tempat_ibadahs.gambar',
                'tempat_ibadahs.nama',
                'tempat_ibadahs.agama',
                'tempat_ibadahs.status',
                'tempat_ibadahs.alamat',
                'tempat_ibadahs.slug',
                'tempat_ibadahs.longitude',
                'tempat_ibadahs.latitude',

            )
            ->orderBy('tempat_ibadahs.updated_at','desc')
            ->where('tempat_ibadahs.status',3)
            ->where('tempat_ibadahs.id',$id)
            ->first();
        return $get;
    }

    public function getTerdekat($id,$id_hotel)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','tempat_ibadahs.kabupaten_id')
        ->leftJoin('restaurant_gambars','restaurant_gambars.restaurant_id','tempat_ibadahs.id')
        ->select(
            'kabupatens.nama as nama_kabupaten',
            'kabupatens.gambar as gambar_kabupaten',
            'tempat_ibadahs.id',
            'tempat_ibadahs.gambar',
            'tempat_ibadahs.nama',
            'tempat_ibadahs.agama',
            'tempat_ibadahs.status',
            'tempat_ibadahs.alamat',
            'tempat_ibadahs.slug',
            'tempat_ibadahs.longitude',
            'tempat_ibadahs.latitude',

        )
        ->orderBy('tempat_ibadahs.updated_at','desc')
        ->where('tempat_ibadahs.status',3)
        ->where('tempat_ibadahs.kabupaten_id',$id)
        ->where('tempat_ibadahs.id','!=',$id_hotel)
        ->groupBy('tempat_ibadahs.nama')
        ->get();
    return $get;
    }

    public function getGaleri($id)
    {
        $get = $this->leftJoin('restaurant_gambars','restaurant_gambars.restaurant_id','tempat_ibadahs.id')
            ->select(
                'restaurant_gambars.gambar',
            )
            ->orderBy('tempat_ibadahs.updated_at','desc')
            ->where('tempat_ibadahs.status',3)
            ->where('tempat_ibadahs.id',$id)
            ->get();
        return $get;
    }
    public function getMenu($id)
    {
        $get = $this->leftJoin('restaurant_menus','restaurant_menus.restaurant_id','tempat_ibadahs.id')
            ->select(
                'restaurant_menus.nama',
                'restaurant_menus.deskripsi',
                'restaurant_menus.gambar',
            )
            ->orderBy('restaurant_menus.updated_at','desc')
            ->where('restaurant_menus.restaurant_id',$id)
            ->get();
        return $get;
    }
}
