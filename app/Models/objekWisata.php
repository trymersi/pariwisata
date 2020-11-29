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
                $get = $get->where('objek_wisatas.kabupaten_id',$kab);
            endif;
            $get = $get->orderBy('objek_wisatas.updated_at','desc')
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

    public function getAll()
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','objek_wisatas.kabupaten_id')
            ->leftJoin('kecamatans','kecamatans.id','objek_wisatas.kecamatan_id')
            ->leftJoin('objek_wisata_details','objek_wisata_details.objek_wisata_id','objek_wisatas.id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kecamatans.nama as nama_kecamatan',
                'kabupatens.gambar as gambar_kabupaten',
                'objek_wisatas.id',
                'objek_wisatas.gambar_header',
                'objek_wisatas.nama',
                'objek_wisatas.jenis',
                'objek_wisatas.status',
                'objek_wisatas.alamat',
                'objek_wisatas.deskripsi',
                'objek_wisatas.slug',
                'objek_wisatas.longitude',
                'objek_wisatas.latitude',
                'objek_wisata_details.kontak_telepon',
            )
            ->orderBy('objek_wisatas.updated_at','desc')
            ->where('objek_wisatas.status',3)
            ->paginate(10);
        return $get;
    }

    public function SearchObjekWisata($kab=false,$kw)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','objek_wisatas.kabupaten_id')
            ->leftJoin('kecamatans','kecamatans.id','objek_wisatas.kecamatan_id')
            ->leftJoin('objek_wisata_details','objek_wisata_details.objek_wisata_id','objek_wisatas.id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kecamatans.nama as nama_kecamatan',
                'kabupatens.gambar as gambar_kabupaten',
                'objek_wisatas.id',
                'objek_wisatas.gambar_header',
                'objek_wisatas.nama',
                'objek_wisatas.jenis',
                'objek_wisatas.status',
                'objek_wisatas.alamat',
                'objek_wisatas.deskripsi',
                'objek_wisatas.slug',
                'objek_wisatas.longitude',
                'objek_wisatas.latitude',
                'objek_wisata_details.kontak_telepon',
                'objek_wisatas.kabupaten_id'
            );
            if($kab):
                $data = $data->where('objek_wisatas.kabupaten_id',$kab);
            endif;
            if($kw != ''):
                $data = $data->where('objek_wisatas.nama','LIKE','%'.$kw.'%');
            endif;
            $data = $data->orderBy('objek_wisatas.updated_at','desc')
            ->where('objek_wisatas.status',3)
            ->get();
        return $data;
    }

    public function getDetail($id)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','objek_wisatas.kabupaten_id')
            ->leftJoin('kecamatans','kecamatans.id','objek_wisatas.kecamatan_id')
            ->leftJoin('objek_wisata_details','objek_wisata_details.objek_wisata_id','objek_wisatas.id')
            ->leftJoin('objek_wisata_gambars','objek_wisata_gambars.objek_wisata_id','objek_wisatas.id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kecamatans.nama as nama_kecamatan',
                'kabupatens.gambar as gambar_kabupaten',
                'objek_wisatas.id',
                'objek_wisatas.gambar_header',
                'objek_wisatas.nama',
                'objek_wisatas.jenis',
                'objek_wisatas.status',
                'objek_wisatas.alamat',
                'objek_wisatas.deskripsi',
                'objek_wisatas.slug',
                'objek_wisatas.longitude',
                'objek_wisatas.latitude',
                'objek_wisata_details.kontak_telepon',
                'objek_wisata_details.kontak_nama',
                'objek_wisatas.jarak_provinsi',
                'objek_wisatas.jarak_kabuten',
                'objek_wisatas.jarak_kabuten',
            )
            ->orderBy('objek_wisatas.updated_at','desc')
            ->where('objek_wisatas.status',3)
            ->where('objek_wisatas.id',$id)
            ->first();
        return $get;
    }
    public function getGaleri($id)
    {
        $get = $this->leftJoin('objek_wisata_gambars','objek_wisata_gambars.objek_wisata_id','objek_wisatas.id')
            ->select(
                'objek_wisata_gambars.gambar',
            )
            ->orderBy('objek_wisatas.updated_at','desc')
            ->where('objek_wisatas.status',3)
            ->where('objek_wisatas.id',$id)
            ->get();
        return $get;
    }
    public function getFasilitas($id)
    {
        $get = $this->leftJoin('objek_wisata_amenitas','objek_wisata_amenitas.objek_wisata_id','objek_wisatas.id')
            ->select(
                'objek_wisata_amenitas.tempat_parkir',
                'objek_wisata_amenitas.fasilitas_kesehatan',
                'objek_wisata_amenitas.fasilitas_kesehatan',
                'objek_wisata_amenitas.listrik',
                'objek_wisata_amenitas.street_furniture',
                'objek_wisata_amenitas.money_changer',
                'objek_wisata_amenitas.money_changer',
            )
            ->orderBy('objek_wisatas.updated_at','desc')
            ->where('objek_wisatas.status',3)
            ->where('objek_wisatas.id',$id)
            ->get();
        return $get;
    }
    
}
