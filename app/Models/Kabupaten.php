<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use DB;
class Kabupaten extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    public function getCountObjek()
    {
        $get = $this->leftJoin('objek_wisatas','kabupatens.id','objek_wisatas.kabupaten_id')
            ->select(
                DB::RAW('count(objek_wisatas.id) as total_objek_wisata'),
                'kabupatens.id',
                'kabupatens.nama',
                'kabupatens.gambar',
                'kabupatens.keterangan',
                'kabupatens.slug'
                )
            ->orderBy('kabupatens.id','desc')
            ->get();
        return $get;
    }
}
