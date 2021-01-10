<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use DB;
class ObjekWisataGambar extends Model
{
    use SoftDeletes;
    use HasFactory;

    public static function getGallery($id)
    {
        return DB::table('objek_wisata_gambars')->where('objek_wisata_id',$id)->get();
    }
}
