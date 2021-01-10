<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CindramataDetail extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function getProduk($id)
    {
        $get = $this->where('cindramata_id',$id)->get();
        return $get;
    }
}
