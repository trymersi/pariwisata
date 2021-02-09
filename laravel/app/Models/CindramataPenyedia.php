<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CindramataPenyedia extends Model
{
    use HasFactory;

    public function getData($id)
    {
        $data = $this->leftJoin('cindramatas','cindramatas.id','cindramata_penyedias.cindramata_id')
            ->leftJoin('ekrafs','ekrafs.id','cindramata_penyedias.ekraf_id')
            ->leftJoin('kabupatens','kabupatens.id','ekrafs.kabupaten_id')
            ->select(
                'cindramatas.nama',
                'kabupatens.nama as nama_kabupaten',
                'ekrafs.nama as nama_ekraf',
                'ekrafs.jenis_usaha',
                'cindramata_penyedias.id'
            )
            ->where('cindramata_penyedias.cindramata_id',$id)
            ->orderBy('cindramata_penyedias.updated_at','desc')
            ->get();
        return $data;
    }
    
}
