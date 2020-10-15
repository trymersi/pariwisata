<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Ekraf extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function getData()
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','ekrafs.kabupaten_id')
            ->leftJoin('kategori_ekrafs','kategori_ekrafs.id','ekrafs.kategori_ekraf_id')
            ->select(
                'kabupatens.nama',
                'kategori_ekrafs.nama',
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
