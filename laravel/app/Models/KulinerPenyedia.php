<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KulinerPenyedia extends Model
{
    use HasFactory;

    public function getData($id)
    {
        $data = $this->leftJoin('kuliners','kuliners.id','kuliner_penyedias.kuliner_id')
            ->leftJoin('ekrafs','ekrafs.id','kuliner_penyedias.ekraf_id')
            ->leftJoin('kabupatens','kabupatens.id','ekrafs.kabupaten_id')
            ->select(
                'kuliners.title',
                'kabupatens.nama as nama_kabupaten',
                'ekrafs.nama as nama_ekraf',
                'ekrafs.jenis_usaha',
                'kuliner_penyedias.id'
            )
            ->where('kuliner_penyedias.kuliner_id',$id)
            ->orderBy('kuliner_penyedias.updated_at','desc')
            ->get();
        return $data;
    }
}
