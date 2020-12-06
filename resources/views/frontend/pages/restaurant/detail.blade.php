@extends('frontend.main')

@section('content')
<div class="content">
    <section class="listing-hero-section hidden-section" data-scrollax-parent="true" id="sec1">
        <div class="bg-parallax-wrap">
            <div class="bg par-elem "  data-bg="{{ asset('uploads/images/gambar-header-restaurant/'.$restaurant->gambar) }}" data-scrollax="properties: { translateY: '30%' }"></div>
            <div class="overlay"></div>
        </div>
        <div class="container">
            <div class="list-single-header-item  fl-wrap">
                <div class="row">
                    <div class="col-md-9">
                        <h1>{{ $restaurant->nama }} <span class="verified-badge"><i class="fal fa-check"></i></span></h1>
                        <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i>  {{ $restaurant->nama_kabupaten }}</a> <a href="#"> <i class="fal fa-phone"></i>{{ $restaurant->kontak_telepon }}</a></div>
                    </div>
                    <div class="col-md-3">
                        <a class="fl-wrap list-single-header-column custom-scroll-link " href="#sec5">
                            <div class="listing-rating-count-wrap single-list-count">
                                <div class="review-score">4.1</div>
                                <div class="listing-rating card-popup-rainingvis" data-starrating2="4"></div>
                                <br>                                                
                                <div class="reviews-count">2 reviews</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="list-single-header_bottom fl-wrap">
                <a class="listing-item-category-wrap" href="#">
                    <div class="listing-item-category  red-bg"><i class="fal fa-cheeseburger"></i></div>
                    {!! $jenis !!}
                </a>
                {{-- <div class="geodir_status_date gsd_open"><i class="fal fa-lock-open"></i>{{ $restaurant->status }}</div> --}}
                {{-- <div class="list-single-author"> <a href="#">Jarak dari Provinsi : {{ $restaurant->jarak_provinsi }} </a></div>
                <div class="list-single-author"> <a href="#">Jarak dari Kabupaten : {{ $restaurant->jarak_kabuten }} </a></div> --}}
                {{-- <div class="list-single-author"> <a href="#">Jarak dari posisi saat ini : {{ $jarak }}  </a></div> --}}

                <div class="list-single-stats">
                    <ul class="no-list-style">
                        {{-- <li><span class="viewed-counter"><i class="fas fa-eye"></i> {{ number_format($pengunjung->total) }} Pengunjung </span></li> --}}
                        <li><span class="bookmark-counter"><i class="fas fa-heart"></i> Menyukai ini -  24 </span></li>
                    </ul>
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
                    <li><a href="#sec2"><i class="fal fa-info"></i>Deskripsi</a></li>
                    <li><a href="#sec3"><i class="fal fa-image"></i>Galeri</a></li>
                    {{-- <li><a href="#sec4"><i class="fal fa-utensils"></i>Menu</a></li> --}}
                    <li><a href="#sec5"><i class="fal fa-comments-alt"></i>Reviews</a></li>
                </ul>
            </nav>
            <div class="scroll-nav-wrapper-opt">
                <a href="#" class="scroll-nav-wrapper-opt-btn"> <i class="fas fa-heart"></i> Suka </a>
                <a href="#" class="scroll-nav-wrapper-opt-btn showshare"> <i class="fas fa-share"></i> Bagikan </a>
                <div class="share-holder hid-share">
                    <div class="share-container  isShare"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- scroll-nav-wrapper end--> 
    <section class="gray-bg no-top-padding">
        <div class="container">
            <div class="breadcrumbs inline-breadcrumbs fl-wrap">
                <a href="#">Home</a><a href="#">Listings</a><a href="#">New York</a><span>Listing Single</span> 
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <!-- list-single-main-wrapper-col -->
                <div class="col-md-8">
                    <!-- list-single-main-wrapper -->
                    <div class="list-single-main-wrapper fl-wrap" id="sec2">
                        <div class="list-single-main-media fl-wrap">
                            <img src="images/all/1.jpg" class="respimg" alt="">
                            <a href="https://vimeo.com/70851162" class="promo-link   image-popup"><i class="fal fa-video"></i><span>Promo Video</span></a>
                        </div>
                        <!-- list-single-main-item --> 
                        <div class="list-single-main-item fl-wrap block_box">
                            <div class="list-single-main-item-title">
                                <h3>Deskripsi</h3>
                            </div>
                            <div class="list-single-main-item_content fl-wrap">
                            
                                {!! $restaurant->deskripsi !!}
                                
                            </div>
                        </div>
                        <!-- list-single-main-item end -->                                               
                        <!-- list-single-main-item --> 
                        <div class="list-single-main-item fl-wrap block_box">
                            <div class="list-single-main-item-title">
                                <h3>List Menu</h3>
                            </div>
                            <div class="list-single-main-item_content fl-wrap">
                                <div class="listing-features fl-wrap">
                                    <ul class="no-list-style">
                                        @foreach ($menu as $menus) 
                                        <li><a href="#"><i class="fa fa-check"></i> {{ $menus->nama }}</a></li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- list-single-main-item end -->                                    
                        <!-- list-single-main-item-->   
                        <div class="list-single-main-item fl-wrap block_box" id="sec3">
                            <div class="list-single-main-item-title">
                                <h3>Gambar Menu Restaurant</h3>
                            </div>
                            <div class="list-single-main-item_content fl-wrap">
                                <div class="single-carousel-wrap fl-wrap lightgallery">
                                    <div class="sc-next sc-btn color2-bg"><i class="fas fa-caret-right"></i></div>
                                    <div class="sc-prev sc-btn color2-bg"><i class="fas fa-caret-left"></i></div>
                                    <div class="single-carousel fl-wrap full-height">
                                        <div class="swiper-container">
                                            <div class="swiper-wrapper">
                                                <!-- swiper-slide-->
                                                
                                                @foreach ($menu as $menus)   
                                                <div class="swiper-slide">
                                                    <div class="box-item">
                                                        <img  src="{{ asset('uploads/images/restaurant-menu/'.$menus->gambar) }}"   alt="">
                                                        <a href="{{ asset('uploads/images/restaurant-menu/'.$menus->gambar) }}" class="gal-link popup-image"><i class="fa fa-search"  ></i></a>
                                                    </div>
                                                </div>
                                                @endforeach
                                                <!-- swiper-slide end-->                                                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="list-single-main-item fl-wrap block_box" id="sec3">
                            <div class="list-single-main-item-title">
                                <h3>Galeri Restaurant</h3>
                            </div>
                            <div class="list-single-main-item_content fl-wrap">
                                <div class="single-carousel-wrap fl-wrap lightgallery">
                                    <div class="sc-next sc-btn color2-bg"><i class="fas fa-caret-right"></i></div>
                                    <div class="sc-prev sc-btn color2-bg"><i class="fas fa-caret-left"></i></div>
                                    <div class="single-carousel fl-wrap full-height">
                                        <div class="swiper-container">
                                            <div class="swiper-wrapper">
                                                <!-- swiper-slide-->
                                                
                                                @foreach ($galeri as $getgaleri)   
                                                <div class="swiper-slide">
                                                    <div class="box-item">
                                                        <img  src="{{ asset('uploads/images/gallery-restaurant/'.$getgaleri->gambar) }}"   alt="">
                                                        <a href="{{ asset('uploads/images/gallery-restaurant/'.$getgaleri->gambar) }}" class="gal-link popup-image"><i class="fa fa-search"  ></i></a>
                                                    </div>
                                                </div>
                                                @endforeach
                                                <!-- swiper-slide end-->                                                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- list-single-main-item end -->          
                        <!-- list-single-facts -->                               
                        {{-- <div class="list-single-facts fl-wrap">
                            <div class="row">
                                <div class="col-md-4">
                                    <!-- inline-facts -->
                                    <div class="inline-facts-wrap gradient-bg ">
                                        <div class="inline-facts">
                                            <i class="fal fa-smile-plus"></i>
                                            <div class="milestone-counter">
                                                <div class="stats animaper">
                                                    <div class="num" data-content="0" data-num="245">0</div>
                                                </div>
                                            </div>
                                            <h6>Pengunjung Baru Setiap Minggu</h6>
                                        </div>
                                        <div class="stat-wave">
                                            <svg viewbox="0 0 100 25">
                                                <path fill="#fff" d="M0 30 V12 Q30 17 55 2 T100 11 V30z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <!-- inline-facts end -->
                                </div>
                                <div class="col-md-4">
                                    <!-- inline-facts  -->
                                    <div class="inline-facts-wrap gradient-bg ">
                                        <div class="inline-facts">
                                            <i class="fal fa-users"></i>
                                            <div class="milestone-counter">
                                                <div class="stats animaper">
                                                    <div class="num" data-content="0" data-num="2557">0</div>
                                                </div>
                                            </div>
                                            <h6>Pengunjung Baru Setiap Bulan</h6>
                                        </div>
                                        <div class="stat-wave">
                                            <svg viewbox="0 0 100 25">
                                                <path fill="#fff" d="M0 30 V12 Q30 17 55 12 T100 11 V30z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <!-- inline-facts end -->
                                </div>
                                <div class="col-md-4">
                                    <!-- inline-facts  -->
                                    <div class="inline-facts-wrap gradient-bg ">
                                        <div class="inline-facts">
                                            <i class="fal fa-award"></i>
                                            <div class="milestone-counter">
                                                <div class="stats animaper">
                                                    <div class="num" data-content="0" data-num="25">0</div>
                                                </div>
                                            </div>
                                            <h6>Pengunjung Baru Setiap Tahun</h6>
                                        </div>
                                        <div class="stat-wave">
                                            <svg viewbox="0 0 100 25">
                                                <path fill="#fff" d="M0 30 V12 Q30 12 55 5 T100 11 V30z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <!-- inline-facts end -->  
                                </div>
                            </div>
                        </div> --}}
                        <!-- list-single-facts end -->       
                        <!-- list-single-main-item-->   
                        <!-- list-single-main-item end -->                                     
                        <!-- list-single-main-item -->   
                        <div class="list-single-main-item fl-wrap block_box" id="sec5">
                            <div class="list-single-main-item-title">
                                <h3>Ulasan -  <span> {{ count($ulasan) }} </span></h3>
                            </div>
                            <!--reviews-score-wrap-->   
                            <div class="reviews-score-wrap fl-wrap">
                                <div class="review-score-total">
                                    <span class="review-score-total-item">
                                    {{-- {{ hitungUlasan($ulasan) }} --}}
                                    </span>
                                    {{-- <div class="listing-rating card-popup-rainingvis" data-starrating2="{{ hitungUlasan($ulasan) }}"></div> --}}
                                </div>
                                <div class="review-score-detail">
                                    <!-- review-score-detail-list-->
                                    <div class="review-score-detail-list">
                                        <!-- rate item-->
                                        <div class="rate-item">
                                            <div class="rate-item-title"><span>Quality</span></div>
                                            <div class="rate-item-bg" data-percent="100%">
                                                <div class="rate-item-line gradient-bg"></div>
                                            </div>
                                            <div class="rate-item-percent">5.0</div>
                                        </div>
                                        <!-- rate item end-->
                                        <!-- rate item-->
                                        <div class="rate-item">
                                            
                                        </div>
                                        <!-- rate item end-->                                                        
                                        <!-- rate item-->
                                        <div class="rate-item">
                                           
                                        </div>
                                        <!-- rate item end-->  
                                        <!-- rate item-->
                                        <div class="rate-item">
                                            <br>
                                        </div>
                                        <!-- rate item end--> 
                                    </div>
                                    <!-- review-score-detail-list end-->
                                </div>
                            </div>
                            <!-- reviews-score-wrap end -->                                             
                            <div class="list-single-main-item_content fl-wrap">
                                <div class="reviews-comments-wrap">
                                    <!-- reviews-comments-item -->  
                                    @foreach($ulasan as $item)
                                    <div class="reviews-comments-item">
                                        <div class="review-comments-avatar">
                                            <img src="{{ asset('assets/frontend/images/avatar/1.png') }}" alt=""> 
                                        </div>
                                        <div class="reviews-comments-item-text fl-wrap">
                                            <div class="reviews-comments-header fl-wrap">
                                                <h4><a href="#">{{ $item->nama }}</a></h4>
                                                <div class="review-score-user">
                                                    <span class="review-score-user_item">4.2</span>
                                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="4"></div>
                                                </div>
                                            </div>
                                            <p>{{ $item->ulasan }}</p>
                                            <div class="reviews-comments-item-footer fl-wrap">
                                                <div class="reviews-comments-item-date"><span><i class="far fa-calendar-check"></i>{{ tgl_indo($item->created_at) }}</span></div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!--reviews-comments-item end--> 
                                    @endforeach                                           
                                </div>
                            </div>
                        </div>
                        <!-- list-single-main-item end -->                                       
                        <!-- list-single-main-item -->   
                        <div class="list-single-main-item fl-wrap block_box" id="sec6">
                            <div class="list-single-main-item-title fl-wrap">
                                <h3>Berikan Ulasan</h3>
                            </div>
                            <!-- Add Review Box -->
                            <div id="add-review" class="add-review-box">
                                <!-- Review Comment -->
                                <form method="post" action="{{ action('Frontend\RestaurantController@rating') }}" class="add-comment  custom-form" name="rangeCalc" >
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $restaurant->id }}">
                                    <input type="hidden" name="slug" value="{{ $restaurant->slug }}">
                                    <fieldset>
                                        <div class="review-score-form fl-wrap">
                                            <div class="review-range-container">
                                                <!-- review-range-item-->
                                                <div class="review-range-item">
                                                    <div class="range-slider-title">Rating Kamu</div>
                                                    <div class="range-slider-wrap ">
                                                        <input type="text" class="rate-range" data-min="0" data-max="5"  name="rgcl"  data-step="1" value="4">
                                                    </div>
                                                </div>
                                                <!-- review-range-item end --> 
                                                                                  
                                            </div>
                                            <div class="review-total">
                                                <span><input type="text" name="rg_total"   data-form="AVG({rgcl})" value="0"></span>    
                                                <strong>Rating Kamu</strong>
                                            </div>
                                        </div>
                                        <div class="list-single-main-item_content fl-wrap">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label><i class="fal fa-user"></i></label>
                                                    <input type="text" name="nama" placeholder="Nama *" value="{{ old('nama') }}"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label><i class="fal fa-envelope"></i>  </label>
                                                    <input type="text" name="email" placeholder="Email *" value="{{ old('email') }}"/>
                                                </div>
                                            </div>
                                            <textarea cols="40" rows="3" name="ulasan" placeholder="Ulasan:">{{ old('ulasan') }}</textarea>
                                            <div class="clearfix"></div>
                                            
                                            <div class="clearfix"></div>
                                            <button class="btn  color2-bg  float-btn">Berikan Ulasan <i class="fal fa-paper-plane"></i></button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <!-- Add Review Box / End -->
                        </div>
                        <!-- list-single-main-item end -->                                    
                    </div>
                </div>
                <!-- list-single-main-wrapper-col end -->
                <!-- list-single-sidebar -->
                <div class="col-md-4">
                    <!--box-widget-item end -->                                                                   
                    <!--box-widget-item -->                                       
                    <div class="box-widget-item fl-wrap block_box">
                        <div class="box-widget-item-header">
                            <h3>Lokasi / Kontak  </h3>
                        </div>
                        <div class="box-widget">
                            <div class="map-container">
                                <div id="singleMap" data-latitude="{{ $restaurant->latitude }}" data-longitude="{{ $restaurant->longitude }}" data-mapTitle="Our Location"></div>
                            </div>
                            <div class="box-widget-content bwc-nopad">
                                <div class="list-author-widget-contacts list-item-widget-contacts bwc-padside">
                                    <ul class="no-list-style">
                                        <li><span><i class="fal fa-map-marker"></i> Alamat : </span> <span>{{ $restaurant->alamat }}</span></li>
                                        <li><span><i class="fal fa-user"></i> Kontak Nama : </span> <span>{{ $restaurant->nama }}</span></li>
                                        <li><span><i class="fal fa-phone"></i> Kontak Telepon : </span> <span> {{ $restaurant->nomor_kontak }}</span></li>
                                    </ul>
                                </div>
                                <div class="list-widget-social bottom-bcw-box  fl-wrap">
                                    <ul class="no-list-style">
                                        <li><a href="#" target="_blank" ><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#" target="_blank" ><i class="fab fa-instagram"></i></a></li>
                                        {{-- <li><a href="#" target="_blank" ><i class="fa fa-map-marker"></i></a></li> --}}
                                    </ul>
                                    {{-- <div class="bottom-bcw-box_link"><a href="#" class="show-single-contactform tolt" data-microtip-position="top" data-tooltip="Write Message"><i class="fal fa-envelope"></i></a></div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--box-widget-item end -->                                  
                    <!--box-widget-item -->
                    {{-- <div class="box-widget-item fl-wrap block_box">
                        <div class="box-widget-item-header">
                            <h3> Price Range </h3>
                        </div>
                        <div class="box-widget">
                            <div class="box-widget-content">
                                <div class="claim-price-wdget fl-wrap">
                                    <div class="claim-price-wdget-content fl-wrap">
                                        <div class="pricerange fl-wrap"><span>Price : </span> 81$ - 320$ </div>
                                        <div class="claim-widget-link fl-wrap"><span>Own or work here?</span><a href="#">Claim Now!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!--box-widget-item end -->                                
                    <!--box-widget-item -->
                    <div class="box-widget-item fl-wrap block_box">
                        <div class="box-widget-item-header">
                            <h3>Menuju lokasi dengan Maps</h3>
                        </div>
                        <div class="box-widget">
                            <div class="box-widget-author fl-wrap">
                                <div class="box-widget-author-title">
                                    <div class="box-widget-author-title-img">
                                        <img src="{{ asset('uploads/images/gambar-header-restaurant/'.$restaurant->gambar) }}" alt=""> 
                                    </div>
                                    <div class="box-widget-author-title_content">
                                        <span>
                                            {{ $restaurant->nama }}
                                        </span>
                                        <span>
                                            {{ $restaurant->alamat }}
                                        </span>
                                    </div>
                                    <div class="box-widget-author-title_opt">
                                        <a href="user-single.html" target="_blank" class="tolt green-bg" data-microtip-position="top" data-tooltip="Menuju Lokasi"><i class="fas fa-map-marker"></i></a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--box-widget-item end -->     
                    <!--box-widget-item -->
                    <div class="box-widget-item fl-wrap block_box">
                        <div class="box-widget-item-header">
                            <h3>restaurant Terdekat</h3>
                        </div>
                        <div class="box-widget  fl-wrap">
                            <div class="box-widget-content">
                                <!--widget-posts-->
                                <div class="widget-posts  fl-wrap">
                                    <ul class="no-list-style">
                                        @foreach ($terdekat as $terdekat)
                                        <li>
                                            <div class="widget-posts-img"><a href="{{ url("/restoran/".$terdekat->slug) }}"><img src="{{ asset('uploads/images/gambar-header-restaurant/'.$terdekat->gambar) }}" alt=""></a>  
                                            </div>
                                            <div class="widget-posts-descr">
                                                <h4><a href="listing-single.html">{{ $terdekat->nama }}</a></h4>
                                                <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i> {{ $terdekat->nama_kabupaten }} {{ $terdekat->alamat }} {{ $terdekat->nama_kecamatan }} </a></div>
                                                <div class="widget-posts-descr-score">4.1</div>
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
                    {{-- <div class="box-widget-item fl-wrap block_box">
                        <div class="box-widget-item-header">
                            <h3>Tags</h3>
                        </div>
                        <div class="box-widget opening-hours fl-wrap">
                            <div class="box-widget-content">
                                <div class="list-single-tags tags-stylwrap">
                                    <a href="#">restaurant</a>
                                    <a href="#">Hostel</a>
                                    <a href="#">Room</a>
                                    <a href="#">Spa</a>
                                    <a href="#">Restourant</a>
                                    <a href="#">Parking</a>                                                                               
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!--box-widget-item end -->       
                </div>
                <!-- list-single-sidebar end -->                                
            </div>
        </div>
    </section>
    <div class="limit-box fl-wrap"></div>
</div>
@endsection