<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class kecamatan extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function getListByKab($id_kabupaten)
    {
        return $this->where('kabupaten_id',$id_kabupaten)
            ->select(
                'id',
                'nama as text'
                )
            ->orderBy('nama','asc')
            ->get();
    }

    public function getData()
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','kecamatans.kabupaten_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kecamatans.id as id',
                'kecamatans.nama as nama_kecamatan',
                'kecamatans.gambar as gambar',
            );
            $get->orderBy('kecamatans.nama','asc')
            ->get();
        return $get;
    }
}
