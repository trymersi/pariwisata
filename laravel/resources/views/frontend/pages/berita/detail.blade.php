@extends('frontend.main')

@section('content')
<div class="content">
    <section class="gray-bg no-top-padding-sec" id="sec1">
        <div class="container">
            <div class="breadcrumbs inline-breadcrumbs fl-wrap block-breadcrumbs">
                <a href="#">Home</a><a href="#">Berita</a> <span>{{ $post->title }}</span> 
                <div  class="showshare brd-show-share color2-bg"> <i class="fas fa-share"></i> Share </div>
            </div>
            <div class="share-holder hid-share sing-page-share top_sing-page-share">
                <div class="share-container  isShare"></div>
            </div>
            <div class="post-container fl-wrap">
                <div class="row">
                    <!-- blog content-->
                    <div class="col-md-8">
                        <!-- article> --> 
                        <article class="post-article single-post-article">
                            <div class="list-single-main-media fl-wrap">
                                <img src="{{ asset('uploads/images/gambar-berita/'.$post->thumbnail) }}" class="respimg" alt="">
                              </div>
                            <div class="list-single-main-item fl-wrap block_box">
                                <h2 class="post-opt-title"><a href="blog-single.html">{{ $post->title }}.</a></h2>
                                <div class="post-author"><a href="#"><img src="{{ asset('uploads/images/setting/'.$setting->logo_website) }}" alt=""><span>Oleh Admin</span></a></div>
                                <div class="post-opt">
                                    <ul class="no-list-style">
                                        <li><i class="fal fa-calendar"></i> <span>{{ tgl_indo($post->updated_at) }}</span></li>
                                        <li><i class="fal fa-eye"></i> <span>{{ $post->dilihat }}</span></li>
                                        <li><i class="fal fa-tags"></i> <a href="{{ url('/kategori-berita/'.$post->slug_kategori) }}">{{ $post->nama_kategori }}</a> @if(isset($post->nama_kabupaten) && $post->nama_kabupaten != ''), <a href="{{ url('/kabupaten/'.$post->slug_kabupaten) }}">{{ $post->nama_kabupaten }}</a> @endif </li>
                                    </ul>
                                </div>
                                <span class="fw-separator"></span> 
                                <div class="clearfix"></div>
                                <p>{!! $post->isi !!}</p>
                                
                                <span class="fw-separator"></span> 
                                <div class="list-single-tags tags-stylwrap">
                                    <span class="tags-title"><i class="fas fa-tag"></i> Label Berita : </span>
                                    @foreach($post_label as $item)
                                    <a href="#">{{ $item }}</a>
                                    @endforeach
                                                                                                              
                                </div>
                            </div>
                        </article>
                        <!-- article end --> 
                        <!-- post nav --> 
                        <div class="post-nav-wrap fl-wrap">
                            @if(isset($sebelum))
                            <a class="post-nav post-nav-prev" href="{{ url('/berita/'.$sebelum->slug) }}"><span class="post-nav-img"><img src="{{ asset('uploads/images/gambar-berita/'.$sebelum->thumbnail) }}" alt=""></span><span class="post-nav-text"><strong>Berita Sebelumnya</strong> <br>{{ $sebelum->title }}</span></a> 
                            @endif

                            @if(isset($sesudah))
                            <a class="post-nav post-nav-next" href="{{ url('/berita/'.$sesudah->slug) }}"><span class="post-nav-img"><img src="{{ asset('uploads/images/gambar-berita/'.$sesudah->thumbnail) }}" alt=""></span><span class="post-nav-text"><strong>Next Post</strong><br>{{ $sesudah->title }}</span></a> 
                            @endif
                        </div>
                                                                       
                    </div>
                    <!-- blog conten end-->
                    <!-- blog sidebar -->
                    @include('frontend.include.sidebar-berita')
                    <!-- blog sidebar end -->
                </div>
            </div>
        </div>
    </section>
    <div class="limit-box fl-wrap"></div>
</div>
@push('css')

@endpush
@push('js')


@endpush
@endsection