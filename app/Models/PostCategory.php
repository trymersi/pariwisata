<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use DB;
class PostCategory extends Model
{
    use HasFactory,SoftDeletes;

    public function getData()
    {
        $data = $this->leftJoin('posts','posts.post_category_id','post_categories.id')
            ->select(
                DB::RAW('count(posts.id) as total_berita'),
                'post_categories.id',
                'post_categories.nama',
                'post_categories.updated_at',
            )
            ->groupBy('post_categories.id')
            ->orderBy('post_categories.updated_at','desc')
            ->get();
        return $data;
    }
}
