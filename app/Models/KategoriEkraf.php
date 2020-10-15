<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class KategoriEkraf extends Model
{
    use HasFactory;

    public function getData()
    {
        $get = $this->leftJoin('ekrafs','ekrafs.kategori_ekraf_id','kategori_ekrafs.id')
            ->select(
                DB::RAW('count(ekrafs.id) as jumlah_pelaku'),
                'kategori_ekrafs.id',
                'kategori_ekrafs.nama_kategori',
                'kategori_ekrafs.deskripsi',
                'kategori_ekrafs.gambar',
                'kategori_ekrafs.slug'
                )
            ->orderBy('kategori_ekrafs.updated_at','desc')
            ->groupBy('kategori_ekrafs.id')
            ->get();
        return $get;
    }
}
