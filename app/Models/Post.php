<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory,SoftDeletes;
    
    public function getData($kab=false)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','posts.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','posts.objek_wisata_id')
            ->leftJoin('post_categories','post_categories.id','posts.post_category_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'post_categories.nama as nama_kategori',
                'posts.title',
                'posts.thumbnail',
                'posts.updated_at',
                'posts.id'
            );
            if($kab):
                $data = $data->where('posts.kabupaten_id',$kab);
            endif;
            $data = $data->groupBy('posts.id')
            ->orderBy('posts.updated_at','desc')
            ->get();
        return $data;
    }
}
