<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekraf extends Model
{
    use HasFactory;

    public function getData()
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','ekrafs.kabupaten_id')
            ->leftJoin('kategori_ekrafs','kategori_ekrafs.id','ekrafs.kategori_ekraf_id')
            ->select(
                'kabupatens.nama_kabupaten',
                'kategori_ekrafs.nama_kategori',
                'ekrafs.id',
                'ekrafs.nama',
                'ekrafs.alamat',
                'ekrafs.nomor_kontak',
                'ekrafs.jenis_usaha',
                'ekrafs.status',
                )
            ->orderBy('ekrafs.updated_at','desc')
            ->get();
        return $get;
    }
}
