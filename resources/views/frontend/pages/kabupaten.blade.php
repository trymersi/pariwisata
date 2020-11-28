@extends('frontend.main')

@section('content')
<div class="content">
    <section class="listing-hero-section hidden-section" data-scrollax-parent="true" id="sec1">
        <div class="bg-parallax-wrap">
            <div class="bg par-elem "  data-bg="{{ asset('/uploads/images/foto-kabupaten/'.$kabupaten->gambar) }}" data-scrollax="properties: { translateY: '30%' }"></div>
            <div class="overlay"></div>
        </div>
        <div class="container">
            <div class="list-single-header-item  fl-wrap">
                <div class="row">
                    <div class="col-md-9">
                        <h1>{{ $kabupaten->nama }} <span class="verified-badge"><i class="fal fa-check"></i></span></h1>
                        
                    </div>
                   
                </div>
            </div>
          
        </div>
    </section>
    <!-- scroll-nav-wrapper--> 
    <div class="scroll-nav-wrapper fl-wrap">
        <div class="container">
            <nav class="scroll-nav scroll-init">
                <ul class="no-list-style">
                    <li><a class="act-scrlink" href="#sec1"><i class="fal fa-images"></i> Top</a></li>
                    <li><a href="#sec2"><i class="fal fa-info"></i>Keterangan</a></li>
                    <li><a href="#sec3"><i class="fal fa-image"></i>Keterangan</a></li>
                    <li><a href="#sec4"><i class="fal fa-utensils"></i>Menu</a></li>
                    <li><a href="#sec5"><i class="fal fa-comments-alt"></i>Reviews</a></li>
                </ul>
            </nav>
            <div class="scroll-nav-wrapper-opt">
                <a href="#" class="scroll-nav-wrapper-opt-btn"> <i class="fas fa-heart"></i> Save </a>
                <a href="#" class="scroll-nav-wrapper-opt-btn showshare"> <i class="fas fa-share"></i> Share </a>
                <div class="share-holder hid-share">
                    <div class="share-container  isShare"></div>
                </div>
                <div class="show-more-snopt"><i class="fal fa-ellipsis-h"></i></div>
                <div class="show-more-snopt-tooltip">
                    <a href="#"> <i class="fas fa-comment-alt"></i> Write a review</a>
                    <a href="#"> <i class="fas fa-flag-alt"></i> Report </a>
                </div>
            </div>
        </div>
    </div>
    <!-- scroll-nav-wrapper end--> 
    <section class="gray-bg no-top-padding">
        <div class="container">
            <div class="breadcrumbs inline-breadcrumbs fl-wrap">
                <a href="#">Beranda</a><a href="#">Kabupaten</a><span>{{ $kabupaten->nama }}</span> 
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <!-- list-single-main-wrapper-col -->
                <div class="col-md-8">
                    <!-- list-single-main-wrapper -->
                    <div class="list-single-main-wrapper fl-wrap" id="sec2">
                        <div class="list-single-main-media fl-wrap">
                            <img src="{{ asset('/uploads/images/foto-kabupaten/'.$kabupaten->gambar) }}" class="respimg" alt="">
                            
                        </div>
                        <!-- list-single-main-item --> 
                        <div class="list-single-main-item fl-wrap block_box">
                            <div class="list-single-main-item-title">
                                <h3>PENJELASAN</h3>
                            </div>
                            <div class="list-single-main-item_content fl-wrap">
                                <p style="text-align: justify;font-size:16px;">{!! $kabupaten->keterangan !!}
                            </div>
                        </div>
                        <!-- list-single-main-item end -->     
                        
                        
                        <div class="list-single-main-item fl-wrap block_box" id="sec4">
                            <div class="list-single-main-item-title">
                                <h3>Objek Wisata</h3>
                            </div>
                            <div class="list-single-main-item_content fl-wrap">
                                <div class="listing-item-grid_container fl-wrap">
                                    
                                    <div class="listing-item-container init-grid-items fl-wrap nocolumn-lic">
                                        @foreach($restoran as $item)
                                        <!-- listing-item  -->
                                        <div class="listing-item" style="height: 484.516px;">
                                            <article class="geodir-category-listing fl-wrap">
                                                <div class="geodir-category-img">
                                                    
                                                    <a href="listing-single.html" class="geodir-category-img-wrap fl-wrap">
                                                    <img src="{{ asset('uploads/images/gambar-header-objek-wisata/'.$item->gambar_header) }}" alt=""> 
                                                    </a>
                                                
                                                    <div class="geodir-category-opt">
                                                        <div class="listing-rating-count-wrap">
                                                            <div class="review-score">4.8</div>
                                                            <div class="listing-rating card-popup-rainingvis" data-starrating2="5"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><div class="card-popup-rainingvis_bg"><span class="card-popup-rainingvis_bg_item"></span><span class="card-popup-rainingvis_bg_item"></span><span class="card-popup-rainingvis_bg_item"></span><span class="card-popup-rainingvis_bg_item"></span><span class="card-popup-rainingvis_bg_item"></span><div></div></div></div>
                                                            <br>
                                                            <div class="reviews-count">12 reviews</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="geodir-category-content fl-wrap title-sin_item">
                                                    <div class="geodir-category-content-title fl-wrap">
                                                        <div class="geodir-category-content-title-item">
                                                            <h3 class="title-sin_map"><a href="listing-single.html">{{ $item->nama }}</a><span class="verified-badge"><i class="fal fa-check"></i></span></h3>
                                                            <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i> {{ $item->alamat }}</a></div>
                                                        </div>
                                                    </div>
                                                    <div class="geodir-category-text fl-wrap">
                                                        <p class="small-text">{{ meta_description($item->keterangan) }}.</p>
                                                        
                                                    </div>
                                                    <div class="geodir-category-footer fl-wrap">
                                                        <a class="listing-item-category-wrap">
                                                            <div class="listing-item-category green-bg"><i class="fas fa-map-marked-alt"></i></div>
                                                            <span>Objek Wisata</span>
                                                        </a>
                                                        <div class="geodir-opt-list">
                                                            <ul class="no-list-style">
                                                            
                                                                <li><a href="#1" class="single-map-item" data-newlatitude="{{ $item->latitude }}" data-newlongitude="{{$item->longitude}}"><i class="fal fa-map-marker-alt"></i><span class="geodir-opt-tooltip">On the map <strong>1</strong></span> </a></li>
                                                                @if(count(getGambarRestoran($item->id)) != 0)
                                                                <li>
                                                                    <div class="dynamic-gal gdop-list-link" data-dynamicPath="[@foreach(getGambarRestoran($item->id) as $key) {{ $key }}@endforeach]"><i class="fal fa-search-plus"></i><span class="geodir-opt-tooltip">Gallery</span></div>
                                                                </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                
                                                    
                                                    
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <!-- listing-item end -->                                       
                                        @endforeach                            
                                    </div>
                                </div>
                                <a href="listing.html" class="btn  dec_btn  color2-bg">Lihat Semua Restoran<i class="fal fa-arrow-alt-right"></i></a>
                            </div>
                        </div>

                        
                        <div class="list-single-main-item fl-wrap block_box" id="sec4">
                            <div class="list-single-main-item-title">
                                <h3>Hotel</h3>
                            </div>
                            <div class="list-single-main-item_content fl-wrap">
                                <div class="listing-item-grid_container fl-wrap">
                                    <div class="listing-item-container init-grid-items fl-wrap nocolumn-lic">
                                        @foreach($hotel as $item)
                                        <!-- listing-item  -->
                                        <div class="listing-item" style="height: 484.516px;">
                                            <article class="geodir-category-listing fl-wrap">
                                                <div class="geodir-category-img">
                                                    
                                                    <a href="listing-single.html" class="geodir-category-img-wrap fl-wrap">
                                                    <img src="{{ asset('uploads/images/gambar-header-hotel/'.$item->gambar) }}" alt=""> 
                                                    </a>
                                                
                                                    <div class="geodir-category-opt">
                                                        <div class="listing-rating-count-wrap">
                                                            <div class="review-score">4.8</div>
                                                            <div class="listing-rating card-popup-rainingvis" data-starrating2="5"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><div class="card-popup-rainingvis_bg"><span class="card-popup-rainingvis_bg_item"></span><span class="card-popup-rainingvis_bg_item"></span><span class="card-popup-rainingvis_bg_item"></span><span class="card-popup-rainingvis_bg_item"></span><span class="card-popup-rainingvis_bg_item"></span><div></div></div></div>
                                                            <br>
                                                            <div class="reviews-count">12 reviews</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="geodir-category-content fl-wrap title-sin_item">
                                                    <div class="geodir-category-content-title fl-wrap">
                                                        <div class="geodir-category-content-title-item">
                                                            <h3 class="title-sin_map"><a href="listing-single.html">{{ $item->nama }}</a><span class="verified-badge"><i class="fal fa-check"></i></span></h3>
                                                            <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i> {{ $item->alamat }}</a></div>
                                                        </div>
                                                    </div>
                                                    <div class="geodir-category-text fl-wrap">
                                                        <p class="small-text">{{ meta_description($item->keterangan) }}.</p>
                                                        
                                                    </div>
                                                    <div class="geodir-category-footer fl-wrap">
                                                        <a class="listing-item-category-wrap">
                                                            <div class="listing-item-category yellow-bg"><i class="fal fa-bed"></i></div>
                                                            <span>Hotel</span>
                                                        </a>
                                                        <div class="geodir-opt-list">
                                                            <ul class="no-list-style">
                                                            
                                                                <li><a href="#1" class="single-map-item" data-newlatitude="{{ $item->latitude }}" data-newlongitude="{{$item->longitude}}"><i class="fal fa-map-marker-alt"></i><span class="geodir-opt-tooltip">On the map <strong>1</strong></span> </a></li>
                                                                @if(count(getGambarHotel($item->id)) != 0)
                                                                <li>
                                                                    <div class="dynamic-gal gdop-list-link" data-dynamicPath="[@foreach(getGambarHotel($item->id) as $key) {{ $key }}@endforeach]"><i class="fal fa-search-plus"></i><span class="geodir-opt-tooltip">Gallery</span></div>
                                                                </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                
                                                    
                                                    
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <!-- listing-item end -->                                       
                                        @endforeach                        
                                    </div>
                                </div>
                                <a href="listing.html" class="btn  dec_btn  color2-bg">Lihat Semua Hotel<i class="fal fa-arrow-alt-right"></i></a>
                            </div>
                        </div>

                        <div class="list-single-main-item fl-wrap block_box" id="sec4">
                            <div class="list-single-main-item-title">
                                <h3>Restoran</h3>
                            </div>
                            <div class="list-single-main-item_content fl-wrap">
                                <div class="listing-item-grid_container fl-wrap">
                                    <div class="listing-item-container init-grid-items fl-wrap nocolumn-lic">
                                        @foreach($restoran as $item)
                                        <!-- listing-item  -->
                                        <div class="listing-item" style="height: 484.516px;">
                                            <article class="geodir-category-listing fl-wrap">
                                                <div class="geodir-category-img">
                                                    
                                                    <a href="listing-single.html" class="geodir-category-img-wrap fl-wrap">
                                                    <img src="{{ asset('uploads/images/gambar-header-restaurant/'.$item->gambar) }}" alt=""> 
                                                    </a>
                                                
                                                    <div class="geodir-category-opt">
                                                        <div class="listing-rating-count-wrap">
                                                            <div class="review-score">4.8</div>
                                                            <div class="listing-rating card-popup-rainingvis" data-starrating2="5"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><div class="card-popup-rainingvis_bg"><span class="card-popup-rainingvis_bg_item"></span><span class="card-popup-rainingvis_bg_item"></span><span class="card-popup-rainingvis_bg_item"></span><span class="card-popup-rainingvis_bg_item"></span><span class="card-popup-rainingvis_bg_item"></span><div></div></div></div>
                                                            <br>
                                                            <div class="reviews-count">12 reviews</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="geodir-category-content fl-wrap title-sin_item">
                                                    <div class="geodir-category-content-title fl-wrap">
                                                        <div class="geodir-category-content-title-item">
                                                            <h3 class="title-sin_map"><a href="listing-single.html">{{ $item->nama }}</a><span class="verified-badge"><i class="fal fa-check"></i></span></h3>
                                                            <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i> {{ $item->alamat }}</a></div>
                                                        </div>
                                                    </div>
                                                    <div class="geodir-category-text fl-wrap">
                                                        <p class="small-text">{{ meta_description($item->keterangan) }}.</p>
                                                        
                                                    </div>
                                                    <div class="geodir-category-footer fl-wrap">
                                                        <a class="listing-item-category-wrap">
                                                            <div class="listing-item-category red-bg"><i class="fas fa-utensils"></i></div>
                                                            <span>Restoran</span>
                                                        </a>
                                                        <div class="geodir-opt-list">
                                                            <ul class="no-list-style">
                                                            
                                                                <li><a href="#1" class="single-map-item" data-newlatitude="{{ $item->latitude }}" data-newlongitude="{{$item->longitude}}"><i class="fal fa-map-marker-alt"></i><span class="geodir-opt-tooltip">On the map <strong>1</strong></span> </a></li>
                                                                @if(count(getGambarHotel($item->id)) != 0)
                                                                <li>
                                                                    <div class="dynamic-gal gdop-list-link" data-dynamicPath="[@foreach(getGambarHotel($item->id) as $key) {{ $key }}@endforeach]"><i class="fal fa-search-plus"></i><span class="geodir-opt-tooltip">Gallery</span></div>
                                                                </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                
                                                    
                                                    
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <!-- listing-item end -->                                       
                                        @endforeach                        
                                    </div>
                                </div>
                                <a href="listing.html" class="btn  dec_btn  color2-bg">Lihat Semua Hotel<i class="fal fa-arrow-alt-right"></i></a>
                            </div>
                        </div>
                        
                        @if(isset($cindramata))
                        <div class="list-single-main-item fl-wrap block_box" id="sec4">
                            <div class="list-single-main-item-title">
                                <h3>Cindramata</h3>
                            </div>
                            <div class="list-single-main-item_content fl-wrap">
                            
                                <div class="listing-item-grid_container fl-wrap">
                                    
                                    <div class="listing-item-container init-grid-items fl-wrap nocolumn-lic">
                                        @foreach($cindramata as $item)
                                        <!-- listing-item  -->
                                        <div class="listing-item" style="height: 484.516px;">
                                            <article class="geodir-category-listing fl-wrap">
                                                <div class="geodir-category-img">
                                                    
                                                    <a href="listing-single.html" class="geodir-category-img-wrap fl-wrap">
                                                    <img src="{{ asset('uploads/images/gambar-header-objek-wisata/'.$item->gambar_header) }}" alt=""> 
                                                    </a>
                                                
                                                    <div class="geodir-category-opt">
                                                        <div class="listing-rating-count-wrap">
                                                            <div class="review-score">4.8</div>
                                                            <div class="listing-rating card-popup-rainingvis" data-starrating2="5"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><div class="card-popup-rainingvis_bg"><span class="card-popup-rainingvis_bg_item"></span><span class="card-popup-rainingvis_bg_item"></span><span class="card-popup-rainingvis_bg_item"></span><span class="card-popup-rainingvis_bg_item"></span><span class="card-popup-rainingvis_bg_item"></span><div></div></div></div>
                                                            <br>
                                                            <div class="reviews-count">12 reviews</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="geodir-category-content fl-wrap title-sin_item">
                                                    <div class="geodir-category-content-title fl-wrap">
                                                        <div class="geodir-category-content-title-item">
                                                            <h3 class="title-sin_map"><a href="listing-single.html">{{ $item->nama }}</a><span class="verified-badge"><i class="fal fa-check"></i></span></h3>
                                                            <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i> {{ $item->alamat }}</a></div>
                                                        </div>
                                                    </div>
                                                    <div class="geodir-category-text fl-wrap">
                                                        <p class="small-text">{{ meta_description($item->keterangan) }}.</p>
                                                        
                                                    </div>
                                                    <div class="geodir-category-footer fl-wrap">
                                                        <a class="listing-item-category-wrap">
                                                            <div class="listing-item-category blue-bg"><i class="far fa-shopping-bag"></i></div>
                                                            <span>Cindramata</span>
                                                        </a>
                                                        <div class="geodir-opt-list">
                                                            <ul class="no-list-style">
                                                            
                                                                <li><a href="#1" class="single-map-item" data-newlatitude="{{ $item->latitude }}" data-newlongitude="{{$item->longitude}}"><i class="fal fa-map-marker-alt"></i><span class="geodir-opt-tooltip">On the map <strong>1</strong></span> </a></li>
                                                                
                                                            </ul>
                                                        </div>
                                
                                                    
                                                    
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <!-- listing-item end -->                                       
                                        @endforeach                            
                                    </div>
                                </div>
                                <a href="listing.html" class="btn  dec_btn  color2-bg">Lihat Semua Objek Wisata<i class="fal fa-arrow-alt-right"></i></a>
                            </div>
                        </div>
                        @endif

                                                          
                    </div>
                </div>
                <!-- list-single-main-wrapper-col end -->
                <!-- list-single-sidebar -->
                <div class="col-md-4">
                    <!--box-widget-item -->
                                                   
                    <div class="box-widget-item fl-wrap block_box">
                        <div class="box-widget-item-header">
                            <h3>Lokasi / Contacts  </h3>
                        </div>
                        <div class="box-widget">
                            <div class="map-container">
                                <div id="singleMap" data-latitude="{{ $kabupaten->latitude }}" data-longitude="{{$kabupaten->longitude}}" data-mapTitle="Our Location"></div>
                            </div>
                            
                        </div>
                    </div>
                    
   
                    <div class="box-widget-item fl-wrap block_box">
                        <div class="box-widget-item-header">
                            <h3>Kabupaten Lainnya :</h3>
                        </div>
                        <div class="box-widget  fl-wrap">
                            <div class="box-widget-content">
                                <!--widget-posts-->
                                <div class="widget-posts  fl-wrap">
                                    <ul class="no-list-style">
                                        @foreach($kabupaten_lain as $item)
                                        <li>
                                            <div class="widget-posts-img"><a href="{{ url('/kabupaten/'.$item->slug) }}"><img src="{{ asset('uploads/images/foto-kabupaten/'.$item->gambar) }}" alt=""></a>  
                                            </div>
                                            <div class="widget-posts-descr">
                                                <h4><a href="listing-single.html">{{ $item->nama }}</a></h4>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- widget-posts end-->
                            </div>
                        </div>
                    </div>
                    <!--box-widget-item end -->      
                    <!--box-widget-item -->
                    <div class="box-widget-item fl-wrap block_box">
                        <div class="box-widget-item-header">
                            <h3>Tags</h3>
                        </div>
                        <div class="box-widget opening-hours fl-wrap">
                            <div class="box-widget-content">
                                <div class="list-single-tags tags-stylwrap">
                                    <a href="#">Hotel</a>
                                    <a href="#">Hostel</a>
                                    <a href="#">Room</a>
                                    <a href="#">Spa</a>
                                    <a href="#">Restourant</a>
                                    <a href="#">Parking</a>                                                                               
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--box-widget-item end -->       
                </div>
                <!-- list-single-sidebar end -->                                
            </div>
        </div>
    </section>
    <div class="limit-box fl-wrap"></div>
</div
@endsection