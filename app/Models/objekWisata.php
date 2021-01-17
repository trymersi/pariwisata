<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
Use DB;

class ObjekWisata extends Model
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

    public function getAll($kab=false)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','objek_wisatas.kabupaten_id')
            ->leftJoin('kecamatans','kecamatans.id','objek_wisatas.kecamatan_id')
            ->leftJoin('objek_wisata_details','objek_wisata_details.objek_wisata_id','objek_wisatas.id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kecamatans.nama as nama_kecamatan',
                'kabupatens.gambar as gambar_kabupaten',
                'kabupatens.slug as slug_kabupaten',
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
            ->where('objek_wisatas.status',3);
            if($kab):
            $get = $get->where('objek_wisatas.kabupaten_id',$kab);
            endif;
            $get = $get->paginate(10);
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
                'kabupatens.slug as slug_kabupaten',
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
    public function getPengunjung($id)
    {
        $get = $this->leftJoin('kunjungans','kunjungans.objek_wisata_id','objek_wisatas.id')
            ->select(DB::raw('sum(kunjungans.lokal + kunjungans.internasional) as total'))
            ->orderBy('objek_wisatas.updated_at','desc')
            ->where('objek_wisatas.status',3)
            ->where('objek_wisatas.id',$id)
            ->first();
        return $get->total ? $get->total :0;
    }

    public function getTerdekat($id,$id_wisata)
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
            )
            ->orderBy('objek_wisatas.updated_at','desc')
            ->where('objek_wisatas.status',3)
            ->where('objek_wisatas.kabupaten_id',$id)
            ->where('objek_wisatas.id','!=',$id_wisata)
            ->groupBy('objek_wisatas.nama')
            ->get();
        return $get;
    }

    public function getRestoTerdekat($id,$id_wisata)
    {
        $get = $this->leftJoin('restaurants','restaurants.objek_wisata_id','objek_wisatas.id')
            ->select(
                'restaurants.nama as nama_resto',
                'restaurants.slug as slug_resto',
                'restaurants.alamat as alamat_resto',
                'restaurants.gambar as gambar_resto',
            )
            ->orderBy('objek_wisatas.updated_at','desc')
            ->where('objek_wisatas.status',3)
            ->where('objek_wisatas.id',$id_wisata)
            ->groupBy('objek_wisatas.nama')
            ->get();
            return $get;

    }
    public function getIbadahTerdekat($id,$id_wisata)
    {
        $get = $this->leftJoin('tempat_ibadahs','tempat_ibadahs.objek_wisata_id','objek_wisatas.id')
            ->select(
                'tempat_ibadahs.nama as nama_ibadah',
                'tempat_ibadahs.slug as slug_ibadah',
                'tempat_ibadahs.alamat as alamat_ibadah',
                'tempat_ibadahs.gambar as gambar_ibadah',
            )
            ->orderBy('objek_wisatas.updated_at','desc')
            ->where('objek_wisatas.status',3)
            ->where('objek_wisatas.id',$id_wisata)
            ->groupBy('objek_wisatas.nama')
            ->get();
            return $get;

    }

    public function getHotelTerdekat($id,$id_wisata)
    {
        $get = $this->leftJoin('hotels','hotels.objek_wisata_id','objek_wisatas.id')
            ->select(
                'hotels.nama as nama_hotel',
                'hotels.slug as slug_hotel',
                'hotels.alamat as alamat_hotel',
                'hotels.gambar as gambar_hotel',
            )
            ->orderBy('objek_wisatas.updated_at','desc')
            ->where('objek_wisatas.status',3)
            ->where('objek_wisatas.id',$id_wisata)
            ->groupBy('objek_wisatas.nama')
            ->get();
            return $get;

    }

    public function getCindraTerdekat($id,$id_wisata)
    {
        $get = $this->leftJoin('cindramatas','cindramatas.objek_wisata_id','objek_wisatas.id')
            ->select(
                'cindramatas.nama as nama_cindra',
                'cindramatas.slug as slug_cindra',
                'cindramatas.alamat as alamat_cindra',
                'cindramatas.gambar as gambar_cindra',
            )
            ->orderBy('objek_wisatas.updated_at','desc')
            ->where('objek_wisatas.status',3)
            ->where('objek_wisatas.id',$id_wisata)
            ->groupBy('objek_wisatas.nama')
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
                'objek_wisata_amenitas.sinyal_provider',
            )
            ->orderBy('objek_wisatas.updated_at','desc')
            ->where('objek_wisatas.status',3)
            ->where('objek_wisatas.id',$id)
            ->get();
        return $get;
    }
    public function getAksebilitas($id)
    {
        $get = $this->leftJoin('objek_wisata_aksebilitas','objek_wisata_aksebilitas.objek_wisata_id','objek_wisatas.id')
            ->select(
                'objek_wisata_aksebilitas.kondisi_jalan_menuju',
                'objek_wisata_aksebilitas.kondisi_jalan_dalam',
                'objek_wisata_aksebilitas.jenis_transportasi',
                'objek_wisata_aksebilitas.biaya',
            )
            ->orderBy('objek_wisatas.updated_at','desc')
            ->where('objek_wisatas.status',3)
            ->where('objek_wisatas.id',$id)
            ->get();
        return $get;
    }

    public function getPlus($id)
    {
        $get = $this->leftJoin('objek_wisata_details','objek_wisata_details.objek_wisata_id','objek_wisatas.id')
            ->select(
                'objek_wisata_details.lembaga_pengelola',
                'objek_wisata_details.jenis_pemasaran',
                'objek_wisata_details.peraturan_uu',
                'objek_wisata_details.stakeholders',
                'objek_wisata_details.kontak_nama',
                'objek_wisata_details.kontak_telepon',
                'objek_wisata_details.harga_tiket',
                'objek_wisata_details.halal',
            )
            ->orderBy('objek_wisatas.updated_at','desc')
            ->where('objek_wisatas.status',3)
            ->where('objek_wisatas.id',$id)
            ->get();
        return $get;
    }
    
    
}
