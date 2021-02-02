<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Ekraf extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function getData($kab=false)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','ekrafs.kabupaten_id')
            ->leftJoin('kategori_ekrafs','kategori_ekrafs.id','ekrafs.kategori_ekraf_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kategori_ekrafs.nama as nama_kategori',
                'ekrafs.id',
                'ekrafs.nama',
                'ekrafs.alamat',
                'ekrafs.nomor_kontak',
                'ekrafs.jenis_usaha',
                'ekrafs.status',
            );
            if($kab):
                $get = $get->where('ekrafs.kabupaten_id',$kab);
            endif;
            $get = $get->orderBy('ekrafs.updated_at','desc')
            ->get();
        return $get;
    }

    public function getAll($kab=false)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','ekrafs.kabupaten_id')
            ->leftJoin('kategori_ekrafs','kategori_ekrafs.id','ekrafs.kategori_ekraf_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kategori_ekrafs.nama as nama_kategori',
                'ekrafs.id',
                'ekrafs.nama',
                'ekrafs.alamat',
                'ekrafs.nomor_kontak',
                'ekrafs.jenis_usaha',
                'ekrafs.status',
            );
            if($kab):
                $get = $get->where('ekrafs.kabupaten_id',$kab);
            endif;
            $get = $get->orderBy('kategori_ekrafs.nama','asc')
            ->get();
        return $get;
    }

    public function getByKat($kab=false,$kw=false,$kat)
    {
        $get = $this->leftJoin('kabupatens','kabupatens.id','ekrafs.kabupaten_id')
            ->leftJoin('kategori_ekrafs','kategori_ekrafs.id','ekrafs.kategori_ekraf_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kategori_ekrafs.nama as nama_kategori',
                'ekrafs.id',
                'ekrafs.nama',
                'ekrafs.alamat',
                'ekrafs.nomor_kontak',
                'ekrafs.jenis_usaha',
                'ekrafs.status',
            );
            if($kab && $kab != ''):
                $get = $get->where('ekrafs.kabupaten_id',$kab);
            endif;
            if($kw && $kw != ''):
                $get = $get->where('ekrafs.nama','Like','%'.$kw.'%');
            endif;
            $get = $get->orderBy('ekrafs.kabupaten_id','asc')
            ->where('ekrafs.kategori_ekraf_id',$kat)
            ->paginate(10);
        return $get;
    }
}
