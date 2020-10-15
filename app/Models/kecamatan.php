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
}
