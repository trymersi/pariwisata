<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory,SoftDeletes;
    
    public function getData($kab=false)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','posts.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','posts.objek_wisata_id')
            ->leftJoin('post_categories','post_categories.id','posts.post_category_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'post_categories.nama as nama_kategori',
                'posts.title',
                'posts.thumbnail',
                'posts.updated_at',
                'posts.id'
            );
            if($kab):
                $data = $data->where('posts.kabupaten_id',$kab);
            endif;
            $data = $data->groupBy('posts.id')
            ->orderBy('posts.updated_at','desc')
            ->get();
        return $data;
    }

    public function getAll()
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','posts.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','posts.objek_wisata_id')
            ->leftJoin('post_categories','post_categories.id','posts.post_category_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kabupatens.slug as slug_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'post_categories.nama as nama_kategori',
                'post_categories.slug as slug_kategori',
                'posts.title',
                'posts.thumbnail',
                'posts.updated_at',
                'posts.id',
                'posts.meta_description',
                'posts.slug',
                'posts.dilihat',
            )
            ->groupBy('posts.id')
            ->where('posts.status',3)
            ->orderBy('posts.updated_at','desc')
            ->paginate(10);
        return $data;
    }

    public function getApi($kab = false,$kw=false)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','posts.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','posts.objek_wisata_id')
            ->leftJoin('post_categories','post_categories.id','posts.post_category_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kabupatens.slug as slug_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'post_categories.nama as nama_kategori',
                'post_categories.slug as slug_kategori',
                'posts.title',
                'posts.thumbnail',
                'posts.updated_at',
                'posts.id',
                'posts.meta_description',
                'posts.slug',
                'posts.dilihat',
            );
            if($kab && $kab != ''):
                $data = $data->where('posts.kabupaten_id',$kab);
            endif;
            if($kw && $kw != ''):
                $data = $data->where('posts.title','LIKE','%'.$kw.'%');
            endif;
            $data = $data->groupBy('posts.id')
            ->where('posts.status',3)
            ->orderBy('posts.updated_at','desc')
            ->paginate(10);
        return $data;
    }

    public function getByKategori($id)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','posts.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','posts.objek_wisata_id')
            ->leftJoin('post_categories','post_categories.id','posts.post_category_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kabupatens.slug as slug_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'post_categories.nama as nama_kategori',
                'post_categories.slug as slug_kategori',
                'posts.title',
                'posts.thumbnail',
                'posts.updated_at',
                'posts.id',
                'posts.meta_description',
                'posts.slug',
                'posts.dilihat',
            )
            ->groupBy('posts.id')
            ->where('posts.status',3)
            ->where('posts.post_category_id',$id)
            ->orderBy('posts.updated_at','desc')
            ->paginate(10);;
        return $data;
    }

    public function getPencarian($id)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','posts.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','posts.objek_wisata_id')
            ->leftJoin('post_categories','post_categories.id','posts.post_category_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kabupatens.slug as slug_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'post_categories.nama as nama_kategori',
                'post_categories.slug as slug_kategori',
                'posts.title',
                'posts.thumbnail',
                'posts.updated_at',
                'posts.id',
                'posts.meta_description',
                'posts.slug',
                'posts.dilihat',
            )
            ->groupBy('posts.id')
            ->where('posts.status',3)
            ->where('posts.title','LIKE','%'.$id.'%')
            ->orderBy('posts.updated_at','desc')
            ->paginate(10);;
        return $data;
    }

    public function getSingle($id)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','posts.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','posts.objek_wisata_id')
            ->leftJoin('post_categories','post_categories.id','posts.post_category_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'kabupatens.slug as slug_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'post_categories.nama as nama_kategori',
                'post_categories.slug as slug_kategori',
                'posts.title',
                'posts.thumbnail',
                'posts.updated_at',
                'posts.id',
                'posts.meta_description',
                'posts.meta_keyword',
                'posts.slug',
                'posts.dilihat',
                'posts.isi'
            )
            ->groupBy('posts.id')
            ->where('posts.status',3)
            ->where('posts.id',$id)
            ->orderBy('posts.updated_at','desc')
            ->first();;
        return $data;
    }

    public function getSebelum($id)
    {
        $data = $this->where('id','<',$id)->select('id','title','thumbnail','slug')->where('status',3)->first();
    }

    public function getSesudah($id)
    {
        $data = $this->where('id','<',$id)->select('id','title','thumbnail','slug')->where('status',3)->first();
    }

    public function getRelated($id_kabupaten,$id_berita)
    {
        $data = $this->leftJoin('kabupatens','kabupatens.id','posts.kabupaten_id')
            ->leftJoin('objek_wisatas','objek_wisatas.id','posts.objek_wisata_id')
            ->leftJoin('post_categories','post_categories.id','posts.post_category_id')
            ->select(
                'kabupatens.nama as nama_kabupaten',
                'objek_wisatas.nama as nama_objek_wisata',
                'post_categories.nama as nama_kategori',
                'posts.title',
                'posts.thumbnail',
                'posts.updated_at',
                'posts.id'
            )
            ->where('posts.kabupaten_id',$id_kabupaten)
            ->where('posts.id','!=',$id_berita)
            ->groupBy('posts.id')
            ->orderBy('posts.updated_at','desc')
            ->limit(5)
            ->get();
        return $data;
    }
   


}
