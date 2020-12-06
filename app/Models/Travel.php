<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function getData($kab=false)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','travel.kabupaten_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'travel.nama',
                'travel.alamat',
                'travel.kontak',
                'travel.status',
                'travel.id'
            );
            if($kab):
                $data = $data->where('travel.kabupaten_id',$kab);
            endif;
            $data = $data->orderBy('travel.updated_at','desc')
            ->get();
            return $data;
    }

}
