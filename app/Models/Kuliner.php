<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Kuliner extends Model
{
    use HasFactory,SoftDeletes;

    public function getData($kab=false)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','kuliners.kabupaten_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kuliners.title',
                'kuliners.meta_description',
                'kuliners.alamat',
                'kuliners.thumbnail',
                'kuliners.updated_at',
                'kuliners.status',
                'kuliners.id'
            );
            if($kab):
                $data = $data->where('kuliners.kabupaten_id',$kab);
            endif;
            $data = $data->groupBy('kuliners.id')
            ->orderBy('kuliners.updated_at','desc')
            ->get();
        return $data;
    }
}
