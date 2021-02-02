@extends('frontend.main')

@section('content')
<div class="content">
  <!--  section  -->
  <section class="parallax-section single-par" data-scrollax-parent="true">
      <div class="bg par-elem "  data-bg="{{ asset('uploads/images/setting/'.$setting->slider_gambar_objek_wisata) }}" data-scrollax="properties: { translateY: '30%' }"></div>
      <div class="overlay op7"></div>
      <div class="container">
          <div class="section-title center-align big-title">
              <h2><span>SELURUH BERITA PADA KATEGORI BERITA {{ strtoupper($detail->nama) }}</span></h2>
              <span class="section-separator"></span>
          </div>
      </div>
      <div class="header-sec-link">
          <a href="#sec1" class="custom-scroll-link"><i class="fal fa-angle-double-down"></i></a> 
      </div>
  </section>
  <!--  section  end-->
  <section class="gray-bg no-top-padding-sec" id="sec1">
      <div class="container">
          <div class="breadcrumbs inline-breadcrumbs fl-wrap block-breadcrumbs">
              <a href="{{ url('/') }}">Home</a><a href="#">Kategori Berita</a> <span>{{ $detail->nama }}</span> 
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
                      @foreach($post as $item)
                      <article class="post-article">
                        <div class="list-single-main-media fl-wrap">
                          <img src="{{ asset('uploads/images/gambar-berita/'.$item->thumbnail) }}" class="respimg" alt="">
                        </div>
                          <div class="list-single-main-item fl-wrap block_box">
                              <h2 class="post-opt-title"><a href="{{ url('/berita/'.$item->slug) }}">{{ $item->title }}.</a></h2>
                              <p>{{ $item->meta_description }}.</p>
                              
                              <span class="fw-separator"></span>
                              <div class="post-author"><a href="#"><img src="{{ asset('uploads/images/setting/'.$setting->logo_website) }}" alt=""><span>Oleh , Admin</span></a></div>
                              <div class="post-opt">
                                  <ul class="no-list-style">
                                      <li><i class="fal fa-calendar"></i> <span>{{ tgl_indo($item->updated_at) }}</span></li>
                                      <li><i class="fal fa-eye"></i> <span>{{ $item->dilihat }}</span></li>
                                      <li><i class="fal fa-tags"></i> <a href="{{ url('/kategori-berita/'.$item->slug_kategori) }}">{{ $item->nama_kategori }}</a> @if(isset($item->nama_kabupaten) && $item->nama_kabupaten != ''), <a href="{{ url('/kabupaten/'.$item->slug_kabupaten) }}">{{ $item->nama_kabupaten }}</a> @endif </li>
                                  </ul>
                              </div>
                              <a href="{{ url('/berita/'.$item->slug) }}" class="btn color2-bg  float-btn">Read more<i class="fal fa-angle-right"></i></a>
                          </div>
                      </article>
                      <!-- article end -->   
                      <!-- article> --> 
                      @endforeach
                      <!-- article end -->                                         
                      <div class="pagination">
                        {{ $post->links() }}
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