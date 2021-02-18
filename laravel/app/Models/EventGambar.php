<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventGambar extends Model
{
    use HasFactory;
    
    public function getGallery($id)
    {
        $data = $this->where('event_id',$id)
        ->get();
        return $data;
    }
}
