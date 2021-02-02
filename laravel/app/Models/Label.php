<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use DB;
class Label extends Model
{
    use HasFactory,SoftDeletes;

    public function getData()
    {
        $data = $this->leftJoin('label_metas','label_metas.label_id','labels.id')
            ->leftJoin('posts','posts.id','label_metas.post_id')
            ->select(
                DB::RAW('count(label_metas.id) as total_berita'),
                'labels.id',
                'labels.nama',
                'labels.updated_at',
            )
            ->groupBy('labels.id')
            ->orderBy('labels.updated_at','desc')
            ->get();
        return $data;
    }

}
