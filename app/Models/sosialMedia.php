<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use DB;
class SosialMedia extends Model
{
    use HasFactory;
    use SoftDeletes;

    public static function getHotelSosmed($id)
    {
        return DB::table('sosial_media')->where('kode_tempat',3)->where('id_tempat',$id)->get(); 
    }

    public static function getObjekWisataSosmed($id)
    {
        return DB::table('sosial_media')->where('kode_tempat',1)->where('id_tempat',$id)->get(); 
    }

    public static function getRestoranSosmed($id)
    {
        return DB::table('sosial_media')->where('kode_tempat',2)->where('id_tempat',$id)->get(); 
    }

    public static function getCindramataSosmed($id)
    {
        return DB::table('sosial_media')->where('kode_tempat',4)->where('id_tempat',$id)->get(); 
    }
}
