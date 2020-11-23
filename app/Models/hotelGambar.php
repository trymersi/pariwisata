<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use DB;
class hotelGambar extends Model
{
    use SoftDeletes;
    use HasFactory;

    public static function getGallery($id)
    {
        return DB::table('hotel_gambars')->where('hotel_id',$id)->get();
    }
}
