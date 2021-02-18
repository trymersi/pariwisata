<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CindramataGambar extends Model
{
    use HasFactory;

    public function getGallery($id)
    {
        $data = $this->where('cindramata_id',$id)
        ->get();
        return $data;
    }
}
