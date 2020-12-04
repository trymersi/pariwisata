@extends('frontend.main')

@section('content')
<div class="content">
<!--section  -->
<section class="hero-section"   data-scrollax-parent="true">
    <div class="bg-tabs-wrap">
        <div class="bg-parallax-wrap" data-scrollax="properties: { translateY: '200px' }">
            <div class="bg bg_tabs"  data-bg="{{ asset('uploads/images/setting/'.$setting->slider_gambar_utama) }}"></div>
            <div class="overlay op7"></div>
        </div>
    </div>
    <div class="container small-container">
        <div class="intro-item fl-wrap">
            <span class="section-separator"></span>
            <div class="bubbles">
                <h1>Temukan Tempat Terbaik Di Provinsi Riau</h1>
            </div>
            <h3>Find some of the best tips from around the city from our partners and friends.</h3>
        </div>
        <!-- main-search-input-tabs-->
        <div class="main-search-input-tabs  tabs-act fl-wrap">
            <ul class="tabs-menu change_bg no-list-style">
                <li class="current"><a href="#tab-inpt1" data-bgtab="{{ asset('uploads/images/setting/'.$setting->slider_gambar_objek_wisata) }}"> Objek Wisata</a></li>
                <li onclick="location.href = '{{ url('/event') }}';" ><a href="#tab-inpt1" data-bgtab="{{ asset('uploads/images/setting/'.$setting->slider_gambar_event) }}"> Event</a></li>
                <li><a href="#tab-inpt3" data-bgtab="{{ asset('uploads/images/setting/'.$setting->slider_gambar_restoran) }}"> Restoran</a></li>
                <li><a href="#tab-inpt4" data-bgtab="{{ asset('uploads/images/setting/'.$setting->slider_gambar_hotel) }}"> Hotel</a></li>
            </ul>
            <!--tabs -->                       
            <div class="tabs-container fl-wrap  ">
                <!--tab -->
                <div class="tab">
                    <div id="tab-inpt1" class="tab-content first-tab">
                        <form  method="post" action="{{ action('Frontend\ObjekWisataController@store') }}">
                            @csrf
                            <div class="main-search-input-wrap fl-wrap">
                                <div class="main-search-input fl-wrap">
                                    <div class="main-search-input-item">
                                        <label><i class="fal fa-keyboard"></i></label>
                                        <input type="text" name="keyword" placeholder="Apa yang kamu cari ?" value=""/>
                                    </div>
                                
                                    <div class="main-search-input-item">
                                        <select data-placeholder="All Categories"  class="chosen-select" >
                                            <option value="">Seluruh Kabupaten</option>
                                            @foreach($list_kabupaten as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button class="main-search-button color2-bg">Cari <i class="far fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--tab end-->
                <!--tab -->
                
                <!--tab end-->                                
                <!--tab -->
                <div class="tab">
                    <div id="tab-inpt3" class="tab-content">
                        <div class="main-search-input-wrap fl-wrap">
                            <form method="post" action="{{ action('Frontend\RestaurantController@store') }}">
                            @csrf
                                <div class="main-search-input fl-wrap">
                                    <div class="main-search-input-item">
                                        <label><i class="fal fa-cheeseburger"></i></label>
                                        <input type="text" name="keyword" placeholder="Nama Restoran / Tempat Makan" value=""/>
                                    </div>

                                    <div class="main-search-input-item">
                                        <select data-placeholder="All Categories"  class="chosen-select" >
                                            <option value="">Seluruh Kabupaten</option>
                                                @foreach($list_kabupaten as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <button class="main-search-button color2-bg" onclick="window.location.href='listing.html'">Search <i class="far fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--tab end-->                                 
                <!--tab -->
                <div class="tab">
                    <div id="tab-inpt4" class="tab-content">
                        <div class="main-search-input-wrap fl-wrap">
                            <div class="main-search-input fl-wrap">
                                <div class="main-search-input-item">
                                    <label><i class="fal fa-cheeseburger"></i></label>
                                    <input type="text" placeholder="Hotel Name" value=""/>
                                </div>

                                <div class="main-search-input-item">
                                    <select data-placeholder="All Categories"  class="chosen-select" >
                                        <option>Pilih Kabupaten</option>
                                        <option>Shops</option>
                                        <option>Hotels</option>
                                        <option>Restaurants</option>
                                        <option>Fitness</option>
                                        <option>Events</option>
                                    </select>
                                </div>
                                <button class="main-search-button color2-bg" onclick="window.location.href='listing.html'">Search <i class="far fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--tab end-->                                  
            </div>
            <!--tabs end-->
        </div>
        <!-- main-search-input-tabs end-->
        <div class="hero-categories fl-wrap">
            <h4 class="hero-categories_title">Just looking around ? Use quick search by category :</h4>
            <ul class="no-list-style">
                <li><a href="{{ url('/objek-wisata') }}"><i class="fas fa-map-marked-alt"></i><span>Objek Wisata</span></a></li>
                <li><a href="{{ url('/hotel') }}"><i class="far fa-bed"></i><span>Hotel</span></a></li>
                <li><a href="{{ url('/restoran') }}"><i class="fas fa-utensils"></i><span>Restoran</span></a></li>
                <li><a href="{{ url('/tempat-ibadah') }}"><i class="fas fa-mosque"></i><span>Tempat Ibadah</span></a></li>
                <li><a href="{{ url('/event') }}"><i class="far fa-cocktail"></i><span>Event</span></a></li>
            </ul>
        </div>
    </div>
    <div class="header-sec-link">
        <a href="#sec1" class="custom-scroll-link"><i class="fal fa-angle-double-down"></i></a> 
    </div>
</section>
<!--section end-->
<!--section  -->
<section class="slw-sec" id="sec1">
    <div class="section-title">
        <h2>Objek Wisata Provinsi Riau</h2>
        <div class="section-subtitle">Objek Wisata Terbaik Di Provinsi Riau</div>
        <span class="section-separator"></span>
        <p>Lihat dan datangi objek - objek wisata yang ada di Provinsi Riau.</p>
    </div>
    <div class="listing-slider-wrap fl-wrap">
        <div class="listing-slider fl-wrap">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <!--  swiper-slide  -->
                    @foreach($objek_wisata as $wisata)
                    <div class="swiper-slide">
                        <div class="listing-slider-item fl-wrap">
                            <!-- listing-item  -->
                            <div class="listing-item listing_carditem">
                                
                                    <article class="geodir-category-listing fl-wrap">
                                        <div class="geodir-category-img">
                                            
                                            <a href="listing-single.html" class="geodir-category-img-wrap fl-wrap">
                                            <img src="{{ asset('uploads/images/gambar-header-objek-wisata/'.$wisata->gambar_header) }}" alt=""> 
                                            </a>
                                            <div class="geodir_status_date gsd_open"><i class="fal fa-lock-open"></i>Buka</div>
                                            <div class="geodir-category-opt">
                                                <div class="geodir-category-opt_title">
                                                    <h4><a href="listing-single.html">{{ $wisata->nama }}</a></h4>
                                                    <div class="geodir-category-location"><a href="#"><i class="fas fa-map-marker-alt"></i>  {{ $wisata->alamat }}</a></div>
                                                </div>
                                                <div class="listing-rating-count-wrap">
                                                    <div class="review-score">4.1</div>
                                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="4"></div>
                                                    <br>
                                                    <div class="reviews-count">26 reviews</div>
                                                </div>
                                                <div class="listing_carditem_footer fl-wrap">
                                                    <a class="listing-item-category-wrap" href="#">
                                                        <div class="listing-item-category red-bg"><i class="far fa-bookmark"></i></div>
                                                        <span>Objek Wisata</span>
                                                    </a>
                                                  
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </article> 
                               
                                
                            </div>
                            <!-- listing-item end -->                                                   
                        </div>
                    </div>
                    @endforeach
                    <!--  swiper-slide end  -->  
                    
                    <!--  swiper-slide end  -->                                        
                </div>
            </div>
            <div class="listing-carousel-button listing-carousel-button-next2"><i class="fas fa-caret-right"></i></div>
            <div class="listing-carousel-button listing-carousel-button-prev2"><i class="fas fa-caret-left"></i></div>
        </div>
        <div class="tc-pagination_wrap">
            <div class="tc-pagination2"></div>
        </div>
    </div>
</section>
<!--section end-->
<div class="sec-circle fl-wrap"></div>
<!--section -->
<section   class="gray-bg hidden-section particles-wrapper">
    <div class="container">
        <div class="section-title">
            <h2>Explore Best Cities</h2>
            <div class="section-subtitle">Catalog of Categories</div>
            <span class="section-separator"></span>
            <p>In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus.</p>
        </div>
        
        <div class="listing-item-grid_container fl-wrap">
            <div class="row">
                <!--  listing-item-grid  -->
                @if(isset($kabupaten[0]))
                <div class="col-sm-4">
                    <div class="listing-item-grid">
                        <div class="bg"  data-bg="{{ asset('uploads/images/foto-kabupaten/'.$kabupaten[0]->gambar) }}"></div>
                        <div class="d-gr-sec"></div>
                        <div class="listing-counter color2-bg"><span>{{ $kabupaten[0]->total_objek_wisata }} </span> Objek Wisata</div>
                        <div class="listing-item-grid_title">
                            <h3><a href="{{ url('/kabupaten/'.$kabupaten[0]->slug) }}">{{ $kabupaten[0]->nama }}</a></h3>
                            <p>{{ meta_description($kabupaten[0]->keterangan) }}</p>
                        </div>
                    </div>
                </div>
                @endif
                <!--  listing-item-grid end  -->
                <!--  listing-item-grid  -->
                @if(isset($kabupaten[1]))
                <div class="col-sm-4">
                    <div class="listing-item-grid">
                        <div class="bg"  data-bg="{{ asset('uploads/images/foto-kabupaten/'.$kabupaten[1]->gambar) }}"></div>
                        <div class="d-gr-sec"></div>
                        <div class="listing-counter color2-bg"><span>{{ $kabupaten[1]->total_objek_wisata }} </span> Objek Wisata</div>
                        <div class="listing-item-grid_title">
                            <h3><a href="{{ url('/kabupaten/'.$kabupaten[1]->slug) }}">{{ $kabupaten[1]->nama }}</a></h3>
                            <p>{{ meta_description($kabupaten[1]->keterangan) }}</p>
                        </div>
                    </div>
                </div>
                @endif
                <!--  listing-item-grid end  -->                                
                <!--  listing-item-grid  -->
                @if(isset($kabupaten[2]))
                <div class="col-sm-4">
                    <div class="listing-item-grid">
                        <div class="bg"  data-bg="{{ asset('uploads/images/foto-kabupaten/'.$kabupaten[2]->gambar) }}"></div>
                        <div class="d-gr-sec"></div>
                        <div class="listing-counter color2-bg"><span>{{ $kabupaten[2]->total_objek_wisata }} </span> Objek Wisata</div>
                        <div class="listing-item-grid_title">
                            <h3><a href="{{ url('/kabupaten/'.$kabupaten[2]->slug) }}">{{ $kabupaten[2]->nama }}</a></h3>
                            <p>{{ meta_description($kabupaten[2]->keterangan) }}</p>
                        </div>
                    </div>
                </div>
                @endif
                <!--  listing-item-grid end  -->
                <!--  listing-item-grid  -->
                @if(isset($kabupaten[3]))
                <div class="col-sm-4">
                    <div class="listing-item-grid">
                        <div class="bg"  data-bg="{{ asset('uploads/images/foto-kabupaten/'.$kabupaten[3]->gambar) }}"></div>
                        <div class="d-gr-sec"></div>
                        <div class="listing-counter color2-bg"><span>{{ $kabupaten[3]->total_objek_wisata }} </span> Objek Wisata</div>
                        <div class="listing-item-grid_title">
                            <h3><a href="{{ url('/kabupaten/'.$kabupaten[3]->slug) }}">{{ $kabupaten[3]->nama }}</a></h3>
                            <p>{{ meta_description($kabupaten[3]->keterangan) }}</p>
                        </div>
                    </div>
                </div>
                @endif
                <!--  listing-item-grid end  -->
                <!--  listing-item-grid  -->
                @if(isset($kabupaten[4]))
                <div class="col-sm-8">
                    <div class="listing-item-grid">
                        <div class="bg"  data-bg="{{ asset('uploads/images/foto-kabupaten/'.$kabupaten[4]->gambar) }}"></div>
                        <div class="d-gr-sec"></div>
                        <div class="listing-counter color2-bg"><span>{{ $kabupaten[4]->total_objek_wisata }} </span> Objek Wisata</div>
                        <div class="listing-item-grid_title">
                            <h3><a href="{{ url('/kabupaten/'.$kabupaten[4]->slug) }}">{{ $kabupaten[4]->nama }}</a></h3>
                            <p>{{ meta_description($kabupaten[4]->keterangan) }}</p>
                        </div>
                    </div>
                </div>
                @endif
                <!--  listing-item-grid end  -->                                                                                               
            </div>
        </div>
        <a href="listing.html" class="btn dec_btn   color2-bg">Lihat Semua Kabupaten<i class="fal fa-arrow-alt-right"></i></a>
    </div>
</section>
<!--  section  -->
<!--section end-->
<section class="parallax-section small-par" data-scrollax-parent="true">
    <div class="bg par-elem "  data-bg="{{ asset('uploads/images/setting/'.$setting->gambar_promosi_satu) }}" data-scrollax="properties: { translateY: '30%' }"></div>
    <div class="overlay  op7"></div>
    <div class="container">
        <div class=" single-facts single-facts_2 fl-wrap">
            <!-- inline-facts -->
            <div class="inline-facts-wrap">
                <div class="inline-facts">
                    <div class="milestone-counter">
                        <div class="stats animaper">
                            <div class="num" data-content="0" data-num="{{ $total['objek_wisata'] }}">{{ $total['objek_wisata'] }}</div>
                        </div>
                    </div>
                    <h6>Total Objek Wisata</h6>
                </div>
            </div>
            <!-- inline-facts end -->
            <!-- inline-facts  -->
            <div class="inline-facts-wrap">
                <div class="inline-facts">
                    <div class="milestone-counter">
                        <div class="stats animaper">
                            <div class="num" data-content="0" data-num="{{ $total['restoran'] }}">{{ $total['restoran'] }}</div>
                        </div>
                    </div>
                    <h6>Total Restoran</h6>
                </div>
            </div>
            <!-- inline-facts end -->
            <!-- inline-facts  -->
            <div class="inline-facts-wrap">
                <div class="inline-facts">
                    <div class="milestone-counter">
                        <div class="stats animaper">
                            <div class="num" data-content="0" data-num="{{ $total['hotel'] }}">{{ $total['hotel'] }}</div>
                        </div>
                    </div>
                    <h6>Total Hotel</h6>
                </div>
            </div>
            <!-- inline-facts end -->
            <!-- inline-facts  -->
            <div class="inline-facts-wrap">
                <div class="inline-facts">
                    <div class="milestone-counter">
                        <div class="stats animaper">
                            <div class="num" data-content="0" data-num="{{ $total['tempat_ibadah'] }}">{{ $total['tempat_ibadah'] }}</div>
                        </div>
                    </div>
                    <h6>Total Tempat Ibadah</h6>
                </div>
            </div>
            <!-- inline-facts end -->
        </div>
    </div>
</section>
<!--section end--> 
<!--section  -->
<section>
    <div class="container big-container">
        <div class="section-title">
            <h2><span>Most Popular Palces</span></h2>
            <div class="section-subtitle">Best Listings</div>
            <span class="section-separator"></span>
            <p>Proin dapibus nisl ornare diam varius tempus. Aenean a quam luctus, finibus tellus ut, convallis eros sollicitudin turpis.</p>
        </div>
        <div class="listing-filters gallery-filters fl-wrap">
            <a href="#" class="gallery-filter  gallery-filter-active" data-filter="*">Semua Kategori</a>
            <a href="#" class="gallery-filter" data-filter=".restaurant">Restoran </a>
            <a href="#" class="gallery-filter" data-filter=".hotels">Hotel</a>
            <a href="#" class="gallery-filter" data-filter=".events">Event</a>
            <a href="#" class="gallery-filter" data-filter=".fitness">Tempat Ibadah</a>
        </div>
        <div class="grid-item-holder gallery-items fl-wrap">
            <!--  gallery-item-->
            @foreach ($restoran as $item)
            <div class="gallery-item restaurant">
                <div class="listing-item">
                    <article class="geodir-category-listing fl-wrap">
                        <div class="geodir-category-img">
                            <a href="listing-single.html" class="geodir-category-img-wrap fl-wrap">
                            <div class="geodir_status_date gsd_open"><i class="fas fa-city"></i>{{ $item->nama_kabupaten }}</div>
                            <div class="geodir-category-opt">
                                <div class="listing-rating-count-wrap">
                                    <div class="review-score">4.7</div>
                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                    <br>
                                    <div class="reviews-count">9 reviews</div>
                                </div>
                            </div>
                            <img src="{{ asset('uploads/images/gambar-header-restaurant/'.$item->gambar) }}" alt="{{ ucwords($item->nama) }}"> 
                            </a>
                            @if(isset($item->gambar_header))
                            <div class="listing-avatar"><a href="author-single.html"><img src="{{ asset('uploads/images/gambar-header-objek-wisata/'.$item->gambar_header) }}" alt=""></a>
                                <span class="avatar-tooltip"><strong>{{ $item->nama_objek_wisata }}</strong></span>
                            </div>
                            @endif
                        </div>
                        <div class="geodir-category-content fl-wrap title-sin_item">
                            <div class="geodir-category-content-title fl-wrap">
                                <div class="geodir-category-content-title-item">
                                    <h3 class="title-sin_map"><a href="listing-single.html">{{ ucwords($item->nama) }}</a><span class="verified-badge"><i class="fal fa-check"></i></span></h3>
                                    <div class="geodir-category-location fl-wrap"><a href="#" ><i class="fas fa-map-marker-alt"></i> {{ $item->alamat }}</a></div>
                                </div>
                            </div>
                            <div class="geodir-category-text fl-wrap">
                                <p class="small-text">{!! strip_tags(meta_description($item->deskripsi)) !!}</p>
                                <div class="facilities-list fl-wrap">
                                   
                                </div>
                            </div>
                            <div class="geodir-category-footer fl-wrap">
                                <a class="listing-item-category-wrap">
                                    <div class="listing-item-category red-bg"><i class="fal fa-cheeseburger"></i></div>
                                    <span>Restoran</span>
                                </a>
                                <div class="geodir-opt-list">
                                    <ul class="no-list-style">
                                        <li><a href="#" class="show_gcc"><i class="fal fa-envelope"></i><span class="geodir-opt-tooltip">Contact Info</span></a></li>
                                        <li><a href="#1" class="single-map-item" data-newlatitude="{{ $item->latitude }}" data-newlongitude="{{ $item->longitude }}"><i class="fal fa-map-marker-alt"></i><span class="geodir-opt-tooltip">On the map <strong>1</strong></span> </a></li>
                                        <li>
                                            <div class="dynamic-gal gdop-list-link" data-dynamicPath="[{'src': 'images/all/1.jpg'},{'src': 'images/all/1.jpg'}, {'src': 'images/all/1.jpg'}]"><i class="fal fa-search-plus"></i><span class="geodir-opt-tooltip">Gallery</span></div>
                                        </li>
                                    </ul>
                                </div>
                               
                                <div class="geodir-category_contacts">
                                    <div class="close_gcc"><i class="fal fa-times-circle"></i></div>
                                    <ul class="no-list-style">
                                        <li><span><i class="fal fa-phone"></i> Kontak : </span><a href="#">{{ $item->nomor_kontak }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>                           
            </div>
            @endforeach

            @foreach ($hotel as $item)
            <div class="gallery-item hotels">
                <div class="listing-item">
                    <article class="geodir-category-listing fl-wrap">
                        <div class="geodir-category-img">
                            <a href="listing-single.html" class="geodir-category-img-wrap fl-wrap">
                            <div class="geodir_status_date gsd_open"><i class="fas fa-city"></i>{{ $item->nama_kabupaten }}</div>
                            <div class="geodir-category-opt">
                                <div class="listing-rating-count-wrap">
                                    <div class="review-score">4.7</div>
                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                    <br>
                                    <div class="reviews-count">9 reviews</div>
                                </div>
                            </div>
                            <img src="{{ asset('uploads/images/gambar-header-hotel/'.$item->gambar) }}" alt="{{ ucwords($item->nama) }}"> 
                            </a>
                            @if(isset($item->gambar_header))
                            <div class="listing-avatar"><a href="author-single.html"><img src="{{ asset('uploads/images/gambar-header-objek-wisata/'.$item->gambar_header) }}" alt=""></a>
                                <span class="avatar-tooltip"><strong>{{ $item->nama_objek_wisata }}</strong></span>
                            </div>
                            @endif
                        </div>
                        <div class="geodir-category-content fl-wrap title-sin_item">
                            <div class="geodir-category-content-title fl-wrap">
                                <div class="geodir-category-content-title-item">
                                    <h3 class="title-sin_map"><a href="listing-single.html">{{ ucwords($item->nama) }}</a><span class="verified-badge"><i class="fal fa-check"></i></span></h3>
                                    <div class="geodir-category-location fl-wrap"><a href="#" ><i class="fas fa-map-marker-alt"></i> {{ $item->alamat }}</a></div>
                                </div>
                            </div>
                            <div class="geodir-category-text fl-wrap">
                                <p class="small-text">{!! strip_tags(meta_description($item->deskripsi)) !!}</p>
                                <div class="facilities-list fl-wrap">
                                   
                                </div>
                            </div>
                            <div class="geodir-category-footer fl-wrap">
                                <a class="listing-item-category-wrap">
                                    <div class="listing-item-category yellow-bg"><i class="fal fa-bed"></i></div>
                                    <span>Hotel</span>
                                </a>
                                <div class="geodir-opt-list">
                                    <ul class="no-list-style">
                                        <li><a href="#" class="show_gcc"><i class="fal fa-envelope"></i><span class="geodir-opt-tooltip">Contact Info</span></a></li>
                                        <li><a href="#1" class="single-map-item" data-newlatitude="{{ $item->latitude }}" data-newlongitude="{{ $item->longitude }}"><i class="fal fa-map-marker-alt"></i><span class="geodir-opt-tooltip">On the map <strong>1</strong></span> </a></li>
                                        <li>
                                            <div class="dynamic-gal gdop-list-link" data-dynamicPath="[{'src': 'images/all/1.jpg'},{'src': 'images/all/1.jpg'}, {'src': 'images/all/1.jpg'}]"><i class="fal fa-search-plus"></i><span class="geodir-opt-tooltip">Gallery</span></div>
                                        </li>
                                    </ul>
                                </div>
                               
                                <div class="geodir-category_contacts">
                                    <div class="close_gcc"><i class="fal fa-times-circle"></i></div>
                                    <ul class="no-list-style">
                                        <li><span><i class="fal fa-phone"></i> Kontak : </span><a href="#">{{ $item->nomor_kontak }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>                           
            </div>
            @endforeach

            @foreach ($event as $item)
            <div class="gallery-item events">
                <div class="listing-item">
                    <article class="geodir-category-listing fl-wrap">
                        <div class="geodir-category-img">
                            <a href="listing-single.html" class="geodir-category-img-wrap fl-wrap">
                            <div class="geodir_status_date gsd_open"><i class="fas fa-city"></i>{{ $item->nama_kabupaten }}</div>
                            <div class="geodir-category-opt">
                                <div class="listing-rating-count-wrap">
                                    <div class="review-score">4.7</div>
                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                    <br>
                                    <div class="reviews-count">9 reviews</div>
                                </div>
                            </div>
                            <img src="{{ asset('uploads/images/gambar-header-event/'.$item->gambar) }}" alt="{{ ucwords($item->nama) }}"> 
                            </a>
                            @if(isset($item->gambar_header))
                            <div class="listing-avatar"><a href="author-single.html"><img src="{{ asset('uploads/images/gambar-header-objek-wisata/'.$item->gambar_header) }}" alt=""></a>
                                <span class="avatar-tooltip"><strong>{{ $item->nama_objek_wisata }}</strong></span>
                            </div>
                            @endif
                        </div>
                        <div class="geodir-category-content fl-wrap title-sin_item">
                            <div class="geodir-category-content-title fl-wrap">
                                <div class="geodir-category-content-title-item">
                                    <h3 class="title-sin_map"><a href="listing-single.html">{{ ucwords($item->nama) }}</a><span class="verified-badge"><i class="fal fa-check"></i></span></h3>
                                    <div class="geodir-category-location fl-wrap"><a href="#" ><i class="fas fa-map-marker-alt"></i> {{ $item->alamat }}</a></div>
                                </div>
                            </div>
                            <div class="geodir-category-text fl-wrap">
                                <p class="small-text">{!! strip_tags(meta_description($item->deskripsi)) !!}</p>
                                <div class="facilities-list fl-wrap">
                                   
                                </div>
                            </div>
                            <div class="geodir-category-footer fl-wrap">
                                <a class="listing-item-category-wrap">
                                    <div class="listing-item-category purp-bg"><i class="fal fa-cocktail"></i></div>
                                    <span>Event</span>
                                </a>
                                <div class="geodir-opt-list">
                                    <ul class="no-list-style">
                                        <li><a href="#" class="show_gcc"><i class="fal fa-envelope"></i><span class="geodir-opt-tooltip">Contact Info</span></a></li>
                                        <li><a href="#1" class="single-map-item" data-newlatitude="{{ $item->latitude }}" data-newlongitude="{{ $item->longitude }}"><i class="fal fa-map-marker-alt"></i><span class="geodir-opt-tooltip">On the map <strong>1</strong></span> </a></li>
                                        <li>
                                            <div class="dynamic-gal gdop-list-link" data-dynamicPath="[{'src': 'images/all/1.jpg'},{'src': 'images/all/1.jpg'}, {'src': 'images/all/1.jpg'}]"><i class="fal fa-search-plus"></i><span class="geodir-opt-tooltip">Gallery</span></div>
                                        </li>
                                    </ul>
                                </div>
                               
                                <div class="geodir-category_contacts">
                                    <div class="close_gcc"><i class="fal fa-times-circle"></i></div>
                                    <ul class="no-list-style">
                                        <li><span><i class="fal fa-phone"></i> Kontak : </span><a href="#">{{ $item->nomor_kontak }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>                           
            </div>
            @endforeach

            @foreach ($tempat_ibadah as $item)
            <div class="gallery-item fitness">
                <div class="listing-item">
                    <article class="geodir-category-listing fl-wrap">
                        <div class="geodir-category-img">
                            <a href="listing-single.html" class="geodir-category-img-wrap fl-wrap">
                            <div class="geodir_status_date gsd_open"><i class="fas fa-city"></i>{{ $item->nama_kabupaten }}</div>
                            <div class="geodir-category-opt">
                                <div class="listing-rating-count-wrap">
                                    <div class="review-score">4.7</div>
                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                    <br>
                                    <div class="reviews-count">9 reviews</div>
                                </div>
                            </div>
                            <img src="{{ asset('uploads/images/gambar-header-tempat-ibadah/'.$item->gambar) }}" alt="{{ ucwords($item->nama) }}"> 
                            </a>
                            @if(isset($item->gambar_header))
                            <div class="listing-avatar"><a href="author-single.html"><img src="{{ asset('uploads/images/gambar-header-objek-wisata/'.$item->gambar_header) }}" alt=""></a>
                                <span class="avatar-tooltip"><strong>{{ $item->nama_objek_wisata }}</strong></span>
                            </div>
                            @endif
                        </div>
                        <div class="geodir-category-content fl-wrap title-sin_item">
                            <div class="geodir-category-content-title fl-wrap">
                                <div class="geodir-category-content-title-item">
                                    <h3 class="title-sin_map"><a href="listing-single.html">{{ ucwords($item->nama) }}</a><span class="verified-badge"><i class="fal fa-check"></i></span></h3>
                                    <div class="geodir-category-location fl-wrap"><a href="#" ><i class="fas fa-map-marker-alt"></i> {{ $item->alamat }}</a></div>
                                </div>
                            </div>
                            <div class="geodir-category-text fl-wrap">
                                <p class="small-text">{!! strip_tags(meta_description($item->deskripsi)) !!}</p>
                                <div class="facilities-list fl-wrap">
                                   
                                </div>
                            </div>
                            <div class="geodir-category-footer fl-wrap">
                                <a class="listing-item-category-wrap">
                                    <div class="listing-item-category blue-bg"><i class="fas fa-mosque"></i></div>
                                    <span>Tempat Ibadah</span>
                                </a>
                                <div class="geodir-opt-list">
                                    <ul class="no-list-style">
                                        <li><a href="#" class="show_gcc"><i class="fal fa-envelope"></i><span class="geodir-opt-tooltip">Contact Info</span></a></li>
                                        <li><a href="#1" class="single-map-item" data-newlatitude="{{ $item->latitude }}" data-newlongitude="{{ $item->longitude }}"><i class="fal fa-map-marker-alt"></i><span class="geodir-opt-tooltip">On the map <strong>1</strong></span> </a></li>
                                        @if((getGambarObjekWisata($item->id) != null))
                                        <li>
                                            <div class="dynamic-gal gdop-list-link" data-dynamicPath="[@foreach(getGambarObjekWisata($item->id) as $key) {{ $key }}@endforeach]"><i class="fal fa-search-plus"></i><span class="geodir-opt-tooltip">Gallery</span></div>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                               
                                <div class="geodir-category_contacts">
                                    <div class="close_gcc"><i class="fal fa-times-circle"></i></div>
                                    <ul class="no-list-style">
                                        <li><span><i class="fal fa-phone"></i> Kontak : </span><a href="#">{{ $item->nomor_kontak }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>                           
            </div>
            @endforeach
                                        
        </div>
        <a href="listing.html" class="btn  dec_btn  color2-bg">Check Out All Listings<i class="fal fa-arrow-alt-right"></i></a>
    </div>
</section>
<!--section end-->
<!--section  -->
<section class="parallax-section" data-scrollax-parent="true">
    <div class="bg par-elem "  data-bg="{{ asset('uploads/images/setting/'.$setting->gambar_promosi_dua) }}" data-scrollax="properties: { translateY: '30%' }"></div>
    <div class="overlay op7"></div>
    <!--container-->
    <div class="container">
        <div class="video_section-title fl-wrap">
            <h4>Aliquam erat volutpat interdum</h4>
            <h2>Get ready to start your exciting journey. <br> Our agency will lead you through the amazing digital world</h2>
        </div>
        <a href="{{ $setting->video_promosi }}" class="promo-link big_prom   image-popup"><i class="fal fa-play"></i><span>Promo Video</span></a>
    </div>
</section>
<!--section end-->
<!--section  -->
<section      data-scrollax-parent="true">
    <div class="container">
        <div class="section-title">
            <h2>Feed Instagram <i class="fab fa-instagram"></i></h2>
            
            <span class="section-separator"></span>
            <p>Temukan tempat tempat menarik pada halaman instagram kami.</p>
        </div>
        <div class="process-wrap fl-wrap">
            <ul class="no-list-style">
                <div id="instafeed" class="instagram-gallery-medium"></div>
            </ul>
            <div class="process-end"><i class="fal fa-check"></i></div>
        </div>
    </div>
</section>
<!--section end-->
<!--section  -->
<section class="gradient-bg hidden-section" data-scrollax-parent="true">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="colomn-text  pad-top-column-text fl-wrap">
                    <div class="colomn-text-title">
                        <h3>Our App  Available Now</h3>
                        <p>In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu mi magna. Etiam suscipit commodo gravida. Lorem ipsum dolor sit amet, conse ctetuer adipiscing elit.</p>
                        <a href="#" class=" down-btn color3-bg"><i class="fab fa-apple"></i>  Apple Store </a>
                        <a href="#" class=" down-btn color3-bg"><i class="fab fa-android"></i>  Google Play </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="collage-image">
                    <img src="{{ asset('assets/frontend/images/api.png') }}" class="main-collage-image" alt="">                               
                    <div class="images-collage-title color2-bg icdec"> <img src="{{ asset('uploads/images/setting/'.$setting->logo_website) }}"   alt=""></div>
                    <div class="images-collage_icon green-bg" style="right:-20px; top:120px;"><i class="fal fa-thumbs-up"></i></div>
                    <div class="collage-image-min cim_1"><img src="{{ asset('uploads/images/setting/'.$setting->slider_gambar_event) }}" alt=""></div>
                    <div class="collage-image-min cim_2"><img src="{{ asset('uploads/images/setting/'.$setting->slider_gambar_objek_wisata) }}" alt=""></div>
                    <div class="collage-image-input">Search <i class="fa fa-search"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="gradient-bg-figure" style="right:-30px;top:10px;"></div>
    <div class="gradient-bg-figure" style="left:-20px;bottom:30px;"></div>
    <div class="circle-wrap" style="left:270px;top:120px;" data-scrollax="properties: { translateY: '-200px' }">
        <div class="circle_bg-bal circle_bg-bal_small"></div>
    </div>
    <div class="circle-wrap" style="right:420px;bottom:-70px;" data-scrollax="properties: { translateY: '150px' }">
        <div class="circle_bg-bal circle_bg-bal_big"></div>
    </div>
    <div class="circle-wrap" style="left:420px;top:-70px;" data-scrollax="properties: { translateY: '100px' }">
        <div class="circle_bg-bal circle_bg-bal_big"></div>
    </div>
    <div class="circle-wrap" style="left:40%;bottom:-70px;"  >
        <div class="circle_bg-bal circle_bg-bal_middle"></div>
    </div>
    <div class="circle-wrap" style="right:40%;top:-10px;"  >
        <div class="circle_bg-bal circle_bg-bal_versmall" data-scrollax="properties: { translateY: '-350px' }"></div>
    </div>
    <div class="circle-wrap" style="right:55%;top:90px;"  >
        <div class="circle_bg-bal circle_bg-bal_versmall" data-scrollax="properties: { translateY: '-350px' }"></div>
    </div>
</section>
<!--section end-->   
<section>
    <div class="container">
        <div class="section-title">
            <h2> Testimonilas</h2>
            <div class="section-subtitle">Clients Reviews</div>
            <span class="section-separator"></span>
            <p>Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="testimonilas-carousel-wrap fl-wrap">
        <div class="listing-carousel-button listing-carousel-button-next"><i class="fas fa-caret-right"></i></div>
        <div class="listing-carousel-button listing-carousel-button-prev"><i class="fas fa-caret-left"></i></div>
        <div class="testimonilas-carousel">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <!--testi-item-->
                    <div class="swiper-slide">
                        <div class="testi-item fl-wrap">
                            
                            <div class="testimonilas-text fl-wrap">
                                <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                <p>"Vestibulum orci felis, ullamcorper non condimentum non, ultrices ac nunc. Mauris non ligula suscipit, vulputate mi accumsan, dapibus felis. Nullam sed sapien dui. Nulla auctor sit amet sem non porta. "</p>
                                <a href="#" class="testi-link" target="_blank">Via Facebook</a>
                                <div class="testimonilas-avatar fl-wrap">
                                    <h3>Andy Dimasky</h3>
                                    <h4>Restaurant Owner</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--testi-item end-->
                    <!--testi-item-->
                    <div class="swiper-slide">
                        <div class="testi-item fl-wrap">
                            
                            <div class="testimonilas-text fl-wrap">
                                <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                <p>"Vestibulum orci felis, ullamcorper non condimentum non, ultrices ac nunc. Mauris non ligula suscipit, vulputate mi accumsan, dapibus felis. Nullam sed sapien dui. Nulla auctor sit amet sem non porta. "</p>
                                <a href="#" class="testi-link" target="_blank">Via Twitter</a>
                                <div class="testimonilas-avatar fl-wrap">
                                    <h3>Frank Dellov</h3>
                                    <h4>Hotel Owner</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--testi-item end-->
                    <!--testi-item-->
                    <div class="swiper-slide">
                        <div class="testi-item fl-wrap">
                          
                            <div class="testimonilas-text fl-wrap">
                                <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                <p>"Vestibulum orci felis, ullamcorper non condimentum non, ultrices ac nunc. Mauris non ligula suscipit, vulputate mi accumsan, dapibus felis. Nullam sed sapien dui. Nulla auctor sit amet sem non porta. "</p>
                                <a href="#" class="testi-link" target="_blank">Via Facebook</a>
                                <div class="testimonilas-avatar fl-wrap">
                                    <h3>Centa Simpson</h3>
                                    <h4>Restaurant Owner</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--testi-item end-->
                    <!--testi-item-->
                    <div class="swiper-slide">
                        <div class="testi-item fl-wrap">
                            
                            <div class="testimonilas-text fl-wrap">
                                <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                <p>"Vestibulum orci felis, ullamcorper non condimentum non, ultrices ac nunc. Mauris non ligula suscipit, vulputate mi accumsan, dapibus felis. Nullam sed sapien dui. Nulla auctor sit amet sem non porta. "</p>
                                <a href="#" class="testi-link" target="_blank">Via Instagram</a>
                                <div class="testimonilas-avatar fl-wrap">
                                    <h3>Linda Svensky</h3>
                                    <h4>Shop Owner</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--testi-item end-->
                </div>
            </div>
        </div>
        <div class="tc-pagination"></div>
    </div>
    <div class="waveWrapper waveAnimation">
      <div class="waveWrapperInner bgMiddle">
        <div class="wave-bg-anim waveMiddle" style="background-image: url('{{ asset('assets/frontend/images/wave-top.png') }}')"></div>
      </div>
      <div class="waveWrapperInner bgBottom">
        <div class="wave-bg-anim waveBottom" style="background-image: url('{{ asset('assets/frontend/images/wave-top.png') }})"></div>
      </div>
    </div> 						
</section>
<section class="gray-bg">
    <div class="container">
        <div class="clients-carousel-wrap fl-wrap">
            <div class="cc-btn   cc-prev"><i class="fal fa-angle-left"></i></div>
            <div class="cc-btn cc-next"><i class="fal fa-angle-right"></i></div>
            <div class="clients-carousel">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <!--client-item-->
                        @foreach($link_terkait as $item)
                        <div class="swiper-slide">
                            <a href="{{ $item->link }}" target="_blank" class="client-item"><img src="{{ asset('uploads/images/link-terkait/'.$item->path) }}" alt=""></a>
                        </div>
                        @endforeach
                        
                        <!--client-item end-->
                                                                                                                                                                                                                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--section end-->
</div>
@endsection