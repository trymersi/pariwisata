@extends('frontend.main')

@section('content')
<div class="content">
<!--section  -->
<section class="hero-section"   data-scrollax-parent="true">
    <div class="bg-tabs-wrap">
        <div class="bg-parallax-wrap" data-scrollax="properties: { translateY: '200px' }">
            <div class="bg bg_tabs"  data-bg="{{ asset('assets/frontend/images/bg/hero/1.jpg') }}"></div>
            <div class="overlay op7"></div>
        </div>
    </div>
    <div class="container small-container">
        <div class="intro-item fl-wrap">
            <span class="section-separator"></span>
            <div class="bubbles">
                <h1>Explore Best Places In City</h1>
            </div>
            <h3>Find some of the best tips from around the city from our partners and friends.</h3>
        </div>
        <!-- main-search-input-tabs-->
        <div class="main-search-input-tabs  tabs-act fl-wrap">
            <ul class="tabs-menu change_bg no-list-style">
                <li class="current"><a href="#tab-inpt1" data-bgtab="{{ asset('assets/frontend/images/bg/hero/1.jpg') }}"> Places</a></li>
                <li><a href="#tab-inpt2" data-bgtab="{{ asset('assets/frontend/images/bg/hero/1.jpg') }}"> Events</a></li>
                <li><a href="#tab-inpt3" data-bgtab="{{ asset('assets/frontend/images/bg/hero/1.jpg') }}"> Restaurants</a></li>
                <li><a href="#tab-inpt4" data-bgtab="{{ asset('assets/frontend/images/bg/hero/1.jpg') }}"> Hotels</a></li>
            </ul>
            <!--tabs -->                       
            <div class="tabs-container fl-wrap  ">
                <!--tab -->
                <div class="tab">
                    <div id="tab-inpt1" class="tab-content first-tab">
                        <div class="main-search-input-wrap fl-wrap">
                            <div class="main-search-input fl-wrap">
                                <div class="main-search-input-item">
                                    <label><i class="fal fa-keyboard"></i></label>
                                    <input type="text" placeholder="What are you looking for?" value=""/>
                                </div>
                                <div class="main-search-input-item location autocomplete-container">
                                    <label><i class="fal fa-map-marker-check"></i></label>
                                    <input type="text" placeholder="Location" class="autocomplete-input" id="autocompleteid" value=""/>
                                    <a href="#"><i class="fa fa-dot-circle-o"></i></a>
                                </div>
                                <div class="main-search-input-item">
                                    <select data-placeholder="All Categories"  class="chosen-select" >
                                        <option>All Categories</option>
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
                <!--tab -->
                <div class="tab">
                    <div id="tab-inpt2" class="tab-content">
                        <div class="main-search-input-wrap fl-wrap">
                            <div class="main-search-input fl-wrap">
                                <div class="main-search-input-item">
                                    <label><i class="fal fa-handshake-alt"></i></label>
                                    <input type="text" placeholder="Event Name or Place" value=""/>
                                </div>
                                <div class="main-search-input-item">
                                    <select data-placeholder="Loaction" class="chosen-select on-radius" >
                                        <option>All Cities</option>
                                        <option>New York</option>
                                        <option>London</option>
                                        <option>Paris</option>
                                        <option>Kiev</option>
                                        <option>Moscow</option>
                                        <option>Dubai</option>
                                        <option>Rome</option>
                                        <option>Beijing</option>
                                    </select>
                                </div>
                                <div class="main-search-input-item clact date-container">
                                    <span class="iconn-dec"><i class="fal fa-calendar"></i></span>
                                    <input type="text" placeholder="Event Date"     name="datepicker-here"   value=""/>
                                    <span class="clear-singleinput"><i class="fal fa-times"></i></span>
                                </div>
                                <button class="main-search-button color2-bg" onclick="window.location.href='listing.html'">Search <i class="far fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--tab end-->                                
                <!--tab -->
                <div class="tab">
                    <div id="tab-inpt3" class="tab-content">
                        <div class="main-search-input-wrap fl-wrap">
                            <div class="main-search-input fl-wrap">
                                <div class="main-search-input-item">
                                    <label><i class="fal fa-cheeseburger"></i></label>
                                    <input type="text" placeholder="Restaurant Name" value=""/>
                                </div>
                                <div class="main-search-input-item clact date-container">
                                    <span class="iconn-dec"><i class="fal fa-calendar"></i></span>
                                    <input type="text" placeholder="Date and Time"     name="datepicker-here-time"   value=""/>
                                    <span class="clear-singleinput"><i class="fal fa-times"></i></span>
                                </div>
                                <div class="main-search-input-item">
                                    <label><i class="fal fa-user-friends"></i></label>
                                    <input type="number" placeholder="Persons" value=""/>
                                </div>
                                <button class="main-search-button color2-bg" onclick="window.location.href='listing.html'">Search <i class="far fa-search"></i></button>
                            </div>
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
                                    <label><i class="fal fa-user-friends"></i></label>
                                    <input type="number" placeholder="Persons" value=""/>
                                </div>
                                <div class="main-search-input-item clact date-container3 daterangepicker_big">
                                    <span class="iconn-dec"><i class="fal fa-calendar"></i></span>
                                    <input type="text" placeholder="Date In Out"     name="dates"   value=""/>
                                    <span class="clear-singleinput"><i class="fal fa-times"></i></span>
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
                <li><a href="listing.html"><i class="far fa-cheeseburger"></i><span>Restaurants</span></a></li>
                <li><a href="listing.html"><i class="far fa-bed"></i><span>Hotels</span></a></li>
                <li><a href="listing.html"><i class="far fa-shopping-bag"></i><span>Shops</span></a></li>
                <li><a href="listing.html"><i class="far fa-dumbbell"></i><span>Fitness</span></a></li>
                <li><a href="listing.html"><i class="far fa-cocktail"></i><span>Events</span></a></li>
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
        <h2>The Latest Listings</h2>
        <div class="section-subtitle">Newest  Listings</div>
        <span class="section-separator"></span>
        <p>Mauris ac maximus neque. Nam in mauris quis libero sodales eleifend. Morbi varius, nulla sit amet rutrum elementum.</p>
    </div>
    <div class="listing-slider-wrap fl-wrap">
        <div class="listing-slider fl-wrap">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <!--  swiper-slide  -->
                    <div class="swiper-slide">
                        <div class="listing-slider-item fl-wrap">
                            <!-- listing-item  -->
                            <div class="listing-item listing_carditem">
                                <article class="geodir-category-listing fl-wrap">
                                    <div class="geodir-category-img">
                                        <div class="geodir-js-favorite_btn"><i class="fal fa-heart"></i><span>Save</span></div>
                                        <a href="listing-single.html" class="geodir-category-img-wrap fl-wrap">
                                        <img src="{{ asset('assets/frontend/images/all/1.jpg') }}" alt=""> 
                                        </a>
                                        <div class="geodir_status_date gsd_open"><i class="fal fa-lock-open"></i>Open Now</div>
                                        <div class="geodir-category-opt">
                                            <div class="geodir-category-opt_title">
                                                <h4><a href="listing-single.html">The Goggi Restaurant</a></h4>
                                                <div class="geodir-category-location"><a href="#"><i class="fas fa-map-marker-alt"></i>  34-42 Montgomery St , NY, USA</a></div>
                                            </div>
                                            <div class="listing-rating-count-wrap">
                                                <div class="review-score">4.1</div>
                                                <div class="listing-rating card-popup-rainingvis" data-starrating2="4"></div>
                                                <br>
                                                <div class="reviews-count">26 reviews</div>
                                            </div>
                                            <div class="listing_carditem_footer fl-wrap">
                                                <a class="listing-item-category-wrap" href="#">
                                                    <div class="listing-item-category red-bg"><i class="fal fa-cheeseburger"></i></div>
                                                    <span>Restaurants</span>
                                                </a>
                                                <div class="price-level geodir-category_price">
                                                    <span class="price-level-item" data-pricerating="2"></span>
                                                    <span class="price-name-tooltip">Pricey</span>
                                                </div>
                                                <div class="post-author"><a href="#"><img src="{{ asset('assets/frontend/images/avatar/1.jpg') }}" alt=""><span>By , Alisa Noory</span></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <!-- listing-item end -->                                                   
                        </div>
                    </div>
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
                <div class="col-sm-4">
                    <div class="listing-item-grid">
                        <div class="bg"  data-bg="{{ asset('assets/frontend/images/all/1.jpg') }}"></div>
                        <div class="d-gr-sec"></div>
                        <div class="listing-counter color2-bg"><span>16 </span> Locations</div>
                        <div class="listing-item-grid_title">
                            <h3><a href="listing.html">New York</a></h3>
                            <p>Constant care and attention to the patients makes good record</p>
                        </div>
                    </div>
                </div>
                <!--  listing-item-grid end  -->
                <!--  listing-item-grid  -->
                <div class="col-sm-4">
                    <div class="listing-item-grid">
                        <div class="bg"  data-bg="{{ asset('assets/frontend/images/all/1.jpg') }}"></div>
                        <div class="d-gr-sec"></div>
                        <div class="listing-counter color2-bg"><span>22 </span> Locations</div>
                        <div class="listing-item-grid_title">
                            <h3><a href="listing.html">Paris</a></h3>
                            <p>Constant care and attention to the patients makes good record</p>
                        </div>
                    </div>
                </div>
                <!--  listing-item-grid end  -->                                
                <!--  listing-item-grid  -->
                <div class="col-sm-4">
                    <div class="listing-item-grid">
                        <div class="bg"  data-bg="{{ asset('assets/frontend/images/all/1.jpg') }}"></div>
                        <div class="d-gr-sec"></div>
                        <div class="listing-counter color2-bg"><span>9 </span> Locations</div>
                        <div class="listing-item-grid_title">
                            <h3><a href="listing.html">Moscow</a></h3>
                            <p>Constant care and attention to the patients makes good record</p>
                        </div>
                    </div>
                </div>
                <!--  listing-item-grid end  -->
                <!--  listing-item-grid  -->
                <div class="col-sm-4">
                    <div class="listing-item-grid">
                        <div class="bg"  data-bg="{{ asset('assets/frontend/images/all/1.jpg') }}"></div>
                        <div class="d-gr-sec"></div>
                        <div class="listing-counter color2-bg"><span>12 </span> Locations</div>
                        <div class="listing-item-grid_title">
                            <h3><a href="listing.html">Rome</a></h3>
                            <p>Constant care and attention to the patients makes good record</p>
                        </div>
                    </div>
                </div>
                <!--  listing-item-grid end  -->
                <!--  listing-item-grid  -->
                <div class="col-sm-8">
                    <div class="listing-item-grid">
                        <div class="bg"  data-bg="{{ asset('assets/frontend/images/all/1.jpg') }}"></div>
                        <div class="d-gr-sec"></div>
                        <div class="listing-counter color2-bg"><span>33 </span> Locations</div>
                        <div class="listing-item-grid_title">
                            <h3><a href="listing.html">London</a></h3>
                            <p>Constant care and attention to the patients makes good record</p>
                        </div>
                    </div>
                </div>
                <!--  listing-item-grid end  -->                                                                                               
            </div>
        </div>
        <a href="listing.html" class="btn dec_btn   color2-bg">View All Cities<i class="fal fa-arrow-alt-right"></i></a>
    </div>
</section>
<!--  section  -->
<!--section end-->
<section class="parallax-section small-par" data-scrollax-parent="true">
    <div class="bg par-elem "  data-bg="{{ asset('assets/frontend/images/bg/1.jpg') }}" data-scrollax="properties: { translateY: '30%' }"></div>
    <div class="overlay  op7"></div>
    <div class="container">
        <div class=" single-facts single-facts_2 fl-wrap">
            <!-- inline-facts -->
            <div class="inline-facts-wrap">
                <div class="inline-facts">
                    <div class="milestone-counter">
                        <div class="stats animaper">
                            <div class="num" data-content="0" data-num="1254">1254</div>
                        </div>
                    </div>
                    <h6>New Visiters Every Week</h6>
                </div>
            </div>
            <!-- inline-facts end -->
            <!-- inline-facts  -->
            <div class="inline-facts-wrap">
                <div class="inline-facts">
                    <div class="milestone-counter">
                        <div class="stats animaper">
                            <div class="num" data-content="0" data-num="12168">12168</div>
                        </div>
                    </div>
                    <h6>Happy customers every year</h6>
                </div>
            </div>
            <!-- inline-facts end -->
            <!-- inline-facts  -->
            <div class="inline-facts-wrap">
                <div class="inline-facts">
                    <div class="milestone-counter">
                        <div class="stats animaper">
                            <div class="num" data-content="0" data-num="2172">2172</div>
                        </div>
                    </div>
                    <h6>Won Amazing Awards</h6>
                </div>
            </div>
            <!-- inline-facts end -->
            <!-- inline-facts  -->
            <div class="inline-facts-wrap">
                <div class="inline-facts">
                    <div class="milestone-counter">
                        <div class="stats animaper">
                            <div class="num" data-content="0" data-num="732">732</div>
                        </div>
                    </div>
                    <h6>New Listing Every Week</h6>
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
            <a href="#" class="gallery-filter  gallery-filter-active" data-filter="*">All Categories</a>
            <a href="#" class="gallery-filter" data-filter=".restaurant">Restaurants </a>
            <a href="#" class="gallery-filter" data-filter=".hotels">Hotels</a>
            <a href="#" class="gallery-filter" data-filter=".events">Events</a>
            <a href="#" class="gallery-filter" data-filter=".fitness">Fitness</a>
        </div>
        <div class="grid-item-holder gallery-items fl-wrap">
            <!--  gallery-item-->
            <div class="gallery-item restaurant events">
                <!-- listing-item  -->
                <div class="listing-item">
                    <article class="geodir-category-listing fl-wrap">
                        <div class="geodir-category-img">
                            <div class="geodir-js-favorite_btn"><i class="fal fa-heart"></i><span>Save</span></div>
                            <a href="listing-single.html" class="geodir-category-img-wrap fl-wrap">
                            <img src="{{ asset('assets/frontend/images/all/1.jpg') }}" alt=""> 
                            </a>
                            <div class="listing-avatar"><a href="author-single.html"><img src="{{ asset('assets/frontend/images/avatar/1.jpg') }}" alt=""></a>
                                <span class="avatar-tooltip">Added By  <strong>Alisa Noory</strong></span>
                            </div>
                            <div class="geodir_status_date gsd_open"><i class="fal fa-lock-open"></i>Open Now</div>
                            <div class="geodir-category-opt">
                                <div class="listing-rating-count-wrap">
                                    <div class="review-score">4.8</div>
                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                    <br>
                                    <div class="reviews-count">12 reviews</div>
                                </div>
                            </div>
                        </div>
                        <div class="geodir-category-content fl-wrap title-sin_item">
                            <div class="geodir-category-content-title fl-wrap">
                                <div class="geodir-category-content-title-item">
                                    <h3 class="title-sin_map"><a href="listing-single.html">Luxary Resaturant</a><span class="verified-badge"><i class="fal fa-check"></i></span></h3>
                                    <div class="geodir-category-location fl-wrap"><a href="#" ><i class="fas fa-map-marker-alt"></i> 27th Brooklyn New York, USA</a></div>
                                </div>
                            </div>
                            <div class="geodir-category-text fl-wrap">
                                <p class="small-text">Sed interdum metus at nisi tempor laoreet. Integer gravida orci a justo sodales.</p>
                                <div class="facilities-list fl-wrap">
                                    <div class="facilities-list-title">Facilities : </div>
                                    <ul class="no-list-style">
                                        <li class="tolt"  data-microtip-position="top" data-tooltip="Free WiFi"><i class="fal fa-wifi"></i></li>
                                        <li class="tolt"  data-microtip-position="top" data-tooltip="Parking"><i class="fal fa-parking"></i></li>
                                        <li class="tolt"  data-microtip-position="top" data-tooltip="Non-smoking Rooms"><i class="fal fa-smoking-ban"></i></li>
                                        <li class="tolt"  data-microtip-position="top" data-tooltip="Pets Friendly"><i class="fal fa-dog-leashed"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="geodir-category-footer fl-wrap">
                                <a class="listing-item-category-wrap">
                                    <div class="listing-item-category red-bg"><i class="fal fa-cheeseburger"></i></div>
                                    <span>Restaurants</span>
                                </a>
                                <div class="geodir-opt-list">
                                    <ul class="no-list-style">
                                        <li><a href="#" class="show_gcc"><i class="fal fa-envelope"></i><span class="geodir-opt-tooltip">Contact Info</span></a></li>
                                        <li><a href="#1" class="single-map-item" data-newlatitude="40.72956781" data-newlongitude="-73.99726866"><i class="fal fa-map-marker-alt"></i><span class="geodir-opt-tooltip">On the map <strong>1</strong></span> </a></li>
                                        <li>
                                            <div class="dynamic-gal gdop-list-link" data-dynamicPath="[{'src': 'images/all/1.jpg'},{'src': 'images/all/1.jpg'}, {'src': 'images/all/1.jpg'}]"><i class="fal fa-search-plus"></i><span class="geodir-opt-tooltip">Gallery</span></div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="price-level geodir-category_price">
                                    <span class="price-level-item" data-pricerating="3"></span>
                                    <span class="price-name-tooltip">Pricey</span>
                                </div>
                                <div class="geodir-category_contacts">
                                    <div class="close_gcc"><i class="fal fa-times-circle"></i></div>
                                    <ul class="no-list-style">
                                        <li><span><i class="fal fa-phone"></i> Call : </span><a href="#">+38099231212</a></li>
                                        <li><span><i class="fal fa-envelope"></i> Write : </span><a href="#">yourmail@domain.com</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <!-- listing-item end -->                              
            </div>
                                        
        </div>
        <a href="listing.html" class="btn  dec_btn  color2-bg">Check Out All Listings<i class="fal fa-arrow-alt-right"></i></a>
    </div>
</section>
<!--section end-->
<!--section  -->
<section class="parallax-section" data-scrollax-parent="true">
    <div class="bg par-elem "  data-bg="{{ asset('assets/frontend/images/bg/1.jpg') }}" data-scrollax="properties: { translateY: '30%' }"></div>
    <div class="overlay op7"></div>
    <!--container-->
    <div class="container">
        <div class="video_section-title fl-wrap">
            <h4>Aliquam erat volutpat interdum</h4>
            <h2>Get ready to start your exciting journey. <br> Our agency will lead you through the amazing digital world</h2>
        </div>
        <a href="https://vimeo.com/70851162" class="promo-link big_prom   image-popup"><i class="fal fa-play"></i><span>Promo Video</span></a>
    </div>
</section>
<!--section end-->
<!--section  -->
<section      data-scrollax-parent="true">
    <div class="container">
        <div class="section-title">
            <h2>How it works</h2>
            <div class="section-subtitle">Discover &amp; Connect </div>
            <span class="section-separator"></span>
            <p>Morbi varius, nulla sit amet rutrum elementum, est elit finibus tellus, ut tristique elit risus at metus.</p>
        </div>
        <div class="process-wrap fl-wrap">
            <ul class="no-list-style">
                <li>
                    <div class="process-item">
                        <span class="process-count">01 </span>
                        <div class="time-line-icon"><i class="fal fa-map-marker-alt"></i></div>
                        <h4> Find Interesting Place</h4>
                        <p>Proin dapibus nisl ornare diam varius tempus. Aenean a quam luctus, finibus tellus ut, convallis eros sollicitudin turpis.</p>
                    </div>
                    <span class="pr-dec"></span>
                </li>
                <li>
                    <div class="process-item">
                        <span class="process-count">02</span>
                        <div class="time-line-icon"><i class="fal fa-mail-bulk"></i></div>
                        <h4> Contact a Few Owners</h4>
                        <p>Faucibus ante, in porttitor tellus blandit et. Phasellus tincidunt metus lectus sollicitudin feugiat pharetra consectetur.</p>
                    </div>
                    <span class="pr-dec"></span>
                </li>
                <li>
                    <div class="process-item">
                        <span class="process-count">03</span>
                        <div class="time-line-icon"><i class="fal fa-layer-plus"></i></div>
                        <h4> Make a Listing</h4>
                        <p>Maecenas pulvinar, risus in facilisis dignissim, quam nisi hendrerit nulla, id vestibulum metus nullam viverra porta.</p>
                    </div>
                </li>
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
                    <div class="images-collage-title color2-bg icdec"> <img src="{{ asset('assets/frontend/images/logo.png') }}"   alt=""></div>
                    <div class="images-collage_icon green-bg" style="right:-20px; top:120px;"><i class="fal fa-thumbs-up"></i></div>
                    <div class="collage-image-min cim_1"><img src="{{ asset('assets/frontend/images/api/1.jpg') }}" alt=""></div>
                    <div class="collage-image-min cim_2"><img src="{{ asset('assets/frontend/images/api/1.jpg') }}" alt=""></div>
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

<section class="gray-bg">
    <div class="container">
        <div class="clients-carousel-wrap fl-wrap">
            <div class="cc-btn   cc-prev"><i class="fal fa-angle-left"></i></div>
            <div class="cc-btn cc-next"><i class="fal fa-angle-right"></i></div>
            <div class="clients-carousel">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <!--client-item-->
                        <div class="swiper-slide">
                            <a href="#" class="client-item"><img src="{{ asset('assets/frontend/images/clients/1.png') }}" alt=""></a>
                        </div>
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