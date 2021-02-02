<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;
use DB;
class RestaurantGambar extends Model
{
    use SoftDeletes;
    use HasFactory;

    public static function getGallery($id)
    {
        return DB::table('restaurant_gambars')->where('restaurant_id',$id)->get();
    }
}
