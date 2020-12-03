<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Setting;
use App\Models\PostCategory;
use App\Models\Label;
use App\Models\LabelMeta;

class BeritaController extends Controller
{
    private $data;
    private $postClass;
    private $setting;
    private $postCategories;
    private $labelClass;
    private $labelMeta;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

        $this->setting = Setting::find(1);
        $this->postClass = new Post;
        $this->postCategory = new PostCategory;
        $this->labelClass = new Label;
        $this->labelMetas = new LabelMeta;
        
        $this->data = [
            'page_name' => 'Seluruh Berita',
            'meta_description' => 'Seluruh berita',
            'meta_keywords' => 'Seluruh berita',
            'setting' => $this->setting,
        ];
    }

    public function index()
    {
        $this->data['post'] = $this->postClass->getAll();
        $this->data['populer'] = $this->postClass->where('status',3)->orderBy('dilihat','desc')->limit(5)->get();
        $this->data['kategori'] = $this->postCategory->getDataHome();
        $this->data['label'] = $this->labelClass->orderBy('nama','asc')->limit(20)->get();
        return view('frontend.pages.berita.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!isset($_COOKIE['count']))
        {
            $this->postClass->increment('dilihat',1);
            $cookie = 1;
            setcookie("count", $cookie,time()+86400);
        }
        $berita = $this->postClass->where('slug',$id)->select('id')->first();
        $id = $berita->id;
        $detail = $this->postClass->getSingle($id);
        $this->data['post'] = $detail;
        $this->data['populer'] = $this->postClass->where('status',3)->orderBy('dilihat','desc')->limit(5)->get();
        $this->data['kategori'] = $this->postCategory->getDataHome();
        $this->data['label'] = $this->labelClass->orderBy('nama','asc')->limit(20)->get();
        $this->data['page_name'] = $detail->title;
        $this->data['meta_description'] = $detail->meta_description;
        $this->data['meta_keywords'] = $detail->meta_keyword;
        $this->data['post_label'] = $this->labelMetas->getDataByPost($id);
        $this->data['sebelum'] = $this->postClass->getSebelum($id);
        $this->data['sesudah'] = $this->postClass->getSesudah($id);
        
        return view('frontend.pages.berita.detail',$this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function kategoriBerita($id)
    {
        $kategori = $this->postCategory->where('slug',$id)->select('id','nama')->first();
        $id = $kategori->id;
        $this->data['detail'] = $kategori;
        $this->data['post'] = $this->postClass->getByKategori($id);
        $this->data['populer'] = $this->postClass->where('status',3)->orderBy('dilihat','desc')->limit(5)->get();
        $this->data['kategori'] = $this->postCategory->getDataHome();
        $this->data['label'] = $this->labelClass->orderBy('nama','asc')->limit(20)->get();
        $this->data['page_name'] = "Seluruh Pada Kategori";
        $this->data['meta_description'] = "Seluruh Berita Pada Kategori ".$kategori->nama;
        $this->data['meta_keywords'] = "Seluruh Berita Pada Kategori ".$kategori->nama;
        return view('frontend.pages.berita.kategori',$this->data);
    }

    public function pencarian(Request $request)
    {
        
        $this->data['post'] = $this->postClass->getPencarian($request->pencarian);
        $this->data['populer'] = $this->postClass->where('status',3)->orderBy('dilihat','desc')->limit(5)->get();
        $this->data['kategori'] = $this->postCategory->getDataHome();
        $this->data['label'] = $this->labelClass->orderBy('nama','asc')->limit(20)->get();
        $this->data['page_name'] = "Pencarian Berita ".$request->pencarian;
        $this->data['meta_description'] = "Pencarian Berita ".$request->pencarian;
        $this->data['meta_keywords'] = "Pencarian Berita ".$request->pencarian;
        $this->data['keyword_pencarian'] = $request->pencarian;
        return view('frontend.pages.berita.pencarian',$this->data);
    }
}
