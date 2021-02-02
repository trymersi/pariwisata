<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class LabelMeta extends Model
{
    use HasFactory,SoftDeletes;
    
    public function getDataByPost($id)
    {
        $data = $this->leftJoin('labels','labels.id','label_metas.label_id')
            ->where('label_metas.post_id',$id)
            ->select('labels.nama')
            ->get();
        $ar = array();
        foreach($data as $k)
        {
            $ar[] = $k->nama;
        }
        return $ar;
    }

    public function getIDByPost($id)
    {
        $data = $this->leftJoin('labels','labels.id','label_metas.label_id')
            ->where('label_metas.post_id',$id)
            ->select('labels.id')
            ->get();
        $ar = array();
        foreach($data as $k)
        {
            $ar[] = $k->id;
        }
        return $ar;
    }
}
