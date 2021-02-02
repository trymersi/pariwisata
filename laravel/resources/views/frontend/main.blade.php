<!DOCTYPE HTML>
<html lang="en">
    <head>
        <!--=============== basic  ===============-->
        <meta charset="UTF-8">
        <title>{{ $page_name }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content="{{ $meta_keywords }}"/>
        <meta name="description" content="{{ $meta_description }}"/>
        <!--=============== css  ===============-->	
        <link type="text/css" rel="stylesheet" href="{{ asset('assets/frontend/css/reset.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('assets/frontend/css/plugins.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('assets/frontend/css/color.css') }}">
        <link href="{{ asset('assets/frontend/css/instagram.css') }}" rel="stylesheet" />
        <!--=============== favicons ===============-->
        <link rel="shortcut icon" href="{{ asset('uploads/images/setting/'.$setting_website->icon) }}">
        @stack('css')
    </head>
    <body>
        <!--loader-->
        <div class="loader-wrap">
            <div class="loader-inner">
                <div class="loader-inner-cirle"></div>
            </div>
        </div>
        <!--loader end-->
        <!-- main start  -->
        <div id="main">
            <!-- header -->
            <header class="main-header">
                <!-- logo-->
                <a href="{{ url('/') }}" class="logo-holder"><img src="{{ asset('uploads/images/setting/'.$setting_website->logo_website) }}" alt=""></a>
                <!-- logo end-->
                <!-- header-search_btn-->         
                <div class="header-search_btn show-search-button"><i class="fal fa-search"></i><span>Search</span></div>
                <!-- header-search_btn end-->
                <!-- header opt --> 
                
                <!-- header opt end--> 
                <!-- lang-wrap-->
              
                <!-- lang-wrap end-->                                 
                <!-- nav-button-wrap--> 
                <a href="dashboard-add-listing.html" class="add-list color-bg"><span><i class="fal fa-plus"></i></span> Mau Berkontribusi ? </a>
                
                <!-- nav-button-wrap end-->
                <!--  navigation --> 
                <div class="nav-holder main-menu">
                    <nav>
                        <ul class="no-list-style">
                            <li>
                                <a href="{{ url('/') }}" class="act-link">Home <i class="fa fa-caret-down"></i></a>
                                <!--second level -->   
                                <ul>
                                    <li><a href="{{ url('/') }}">Parallax Image</a></li>
                                  
                                </ul>
                                <!--second level end-->
                            </li>
                            <li>
                                <a href="{{ url('/objek-wisata') }}">Objek Wisata</a>
                            </li>
                            <li>
                                <a href="#">Amenitas <i class="fa fa-caret-down"></i></a>
                                <!--second level -->
                                <ul>
                                    <li><a href="{{ url('/hotel') }}">Hotel</a></li>
                                    <li><a href="{{ url('/restoran') }}">Tempat Makan</a></li>
                                    <li><a href="{{ url('/tempat-ibadah') }}">Tempat Ibadah</a></li>
                                    <li><a href="{{ url('/sovenir') }}">Sovenir</a></li>
                                    <li><a href="listing.html">Data Pemandu</a></li>
                                    <li><a href="listing.html">Agen Travel</a></li>
                                </ul>
                                <!--second level end-->
                            </li>
                            <li>
                                <a href="#">Berita <i class="fa fa-caret-down"></i></a>
                                <!--second level -->
                                <ul>
                                    <li><a href="{{ url('/berita') }}">Seluruh Berita</a></li>
                                    @foreach($kategori_berita_menu as $item)
                                    <li><a href="{{ url('/kategori/'.$item->slug) }}">{{ $item->nama }}</a></li>
                                    @endforeach
                                </ul>
                                <!--second level end-->
                            </li>
                            <li>
                                <a href="#">Kabupaten <i class="fa fa-caret-down"></i></a>
                                <!--second level -->
                                <ul>
                                    @foreach($kabupaten_menu as $item)
                                    <li><a href="{{ url('/kabupaten/'.$item->slug) }}">{{ $item->nama }}</a></li>
                                    @endforeach
                                </ul>
                                <!--second level end-->
                            </li>
                            <li>
                                <a href="{{ url('/event') }}">Kalender Event</a>
                            </li>
                            <li>
                                <a href="#">Informasi <i class="fa fa-caret-down"></i></a>
                                <!--second level -->
                                <ul>
                                    <li><a href="{{ url('/berita') }}">Ekonomi Kreatif</a></li>
                                    <li><a href="{{ url('/berita') }}">Desa Wisata</a></li>
                                    <li><a href="{{ url('/berita') }}">Sadar Wisata</a></li>
                                </ul>
                                <!--second level end-->
                            </li>

                            <li>
                                <a href="{{ url('/hubungi-kami') }}">Hubungi Kami <i class="fa fa-phone" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- navigation  end -->
                <!-- header-search_container -->                     
                <div class="header-search_container header-search vis-search">
                    <div class="container small-container">
                        <div class="header-search-input-wrap fl-wrap">
                            <!-- header-search-input --> 
                            <div class="header-search-input">
                                <label><i class="fal fa-keyboard"></i></label>
                                <input type="text" placeholder="What are you looking for ?"   value=""/>  
                            </div>
                            <!-- header-search-input end -->  
                            <!-- header-search-input --> 
                            <div class="header-search-input location autocomplete-container">
                                <label><i class="fal fa-map-marker"></i></label>
                                <input type="text" placeholder="Location..." class="autocomplete-input" id="autocompleteid2" value=""/>
                                <a href="#"><i class="fal fa-dot-circle"></i></a>
                            </div>
                            <!-- header-search-input end -->                                        
                            <!-- header-search-input --> 
                            <div class="header-search-input header-search_selectinpt ">
                                <select data-placeholder="Category" class="chosen-select no-radius" >
                                    <option>All Categories</option>
                                    <option>All Categories</option>
                                    <option>Shops</option>
                                    <option>Hotels</option>
                                    <option>Restaurants</option>
                                    <option>Fitness</option>
                                    <option>Events</option>
                                </select>
                            </div>
                            <!-- header-search-input end --> 
                            <button class="header-search-button green-bg" onclick="window.location.href='listing.html'"><i class="far fa-search"></i> Search </button>
                        </div>
                        <div class="header-search_close color-bg"><i class="fal fa-long-arrow-up"></i></div>
                    </div>
                </div>
                <!-- header-search_container  end --> 
                <!-- wishlist-wrap--> 
               
                <!--wishlist-wrap end --> 
            </header>
            <!-- header end-->
            <!-- wrapper-->
            <div id="wrapper">
                <!-- content-->
                @yield('content')
                <!--content end-->
            </div>
            <!-- wrapper end-->
            <!--footer -->
            <footer class="main-footer fl-wrap">
                <!-- footer-header-->
                <div class="footer-header fl-wrap grad ient-dark">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                <div  class="subscribe-header">
                                    <h3>Subscribe For a <span>Newsletter</span></h3>
                                    <p>Whant to be notified about new locations ?  Just sign up.</p>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="subscribe-widget">
                                    <div class="subcribe-form">
                                        <form id="subscribe">
                                            <input class="enteremail fl-wrap" name="email" id="subscribe-email" placeholder="Enter Your Email" spellcheck="false" type="text">
                                            <button type="submit" id="subscribe-button" class="subscribe-button"><i class="fal fa-envelope"></i></button>
                                            <label for="subscribe-email" class="subscribe-message"></label>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer-header end-->
                <!--footer-inner-->
                <div class="footer-inner   fl-wrap">
                    <div class="container">
                        <div class="row">
                            <!-- footer-widget-->
                            <div class="col-md-4">
                                <div class="footer-widget fl-wrap">
                                    <div class="footer-logo"><a href="{{ url('/') }}"><img src="{{ asset('uploads/images/setting/'.$setting_website->logo_website) }}" alt=""></a></div>
                                    <div class="footer-contacts-widget fl-wrap">
                                        <p>{{ $setting_website->keterangan_website }}</p>
                                        <ul  class="footer-contacts fl-wrap no-list-style">
                                            <li><span><i class="fal fa-envelope"></i> E-Mail :</span><a href="#" target="_blank">{{ $setting_website->email }}</a></li>
                                            <li> <span><i class="fal fa-map-marker"></i> Alamat :</span><a href="#" target="_blank">{{ $setting_website->alamat_kantor }}</a></li>
                                            <li><span><i class="fal fa-phone"></i> Telepon :</span><a href="#">{{ $setting_website->notel }}</a></li>
                                        </ul>
                                        <div class="footer-social">
                                            <span>Find  us on: </span>
                                            <ul class="no-list-style">
                                                <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                                <li><a href="#" target="_blank"><i class="fab fa-vk"></i></a></li>
                                                <li><a href="#" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- footer-widget end-->
                            <!-- footer-widget-->
                            <div class="col-md-4">
                                <div class="footer-widget fl-wrap">
                                    <h3>Our Last News</h3>
                                    <div class="footer-widget-posts fl-wrap">
                                        <ul class="no-list-style">
                                            @foreach($footer_post as $item)
                                            <li class="clearfix">
                                                <a href="#"  class="widget-posts-img"><img src="{{ asset('uploads/images/gambar-berita/'.$item->thumbnail) }}" class="respimg" alt=""></a>
                                                <div class="widget-posts-descr">
                                                    <a href="#" title="">{{ $item->title }}</a>
                                                    <span class="widget-posts-date"><i class="fal fa-calendar"></i> {{ tgl_indo($item->updated_at) }} </span> 
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <a href="blog.html" class="footer-link">Read all <i class="fal fa-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- footer-widget end-->
                            <!-- footer-widget  -->
                           
                            <!-- footer-widget end-->
                        </div>
                    </div>
                    <!-- footer bg-->
                    <div class="footer-bg" data-ran="4"></div>
                    <div class="footer-wave">
                        <svg viewbox="0 0 100 25">
                            <path fill="#fff" d="M0 30 V12 Q30 17 55 12 T100 11 V30z" />
                        </svg>
                    </div>
                    <!-- footer bg  end-->
                </div>
                <!--footer-inner end -->
                <!--sub-footer-->
                <div class="sub-footer  fl-wrap">
                    <div class="container">
                        <div class="copyright"> &#169; Townhub 2019 .  All rights reserved.</div>

                        <div class="subfooter-nav">
                            <ul class="no-list-style">
                                <li><a href="#">Terms of use</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Blog</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--sub-footer end -->
            </footer>
            <!--footer end -->  
            <!--map-modal -->
            <div class="map-modal-wrap">
                <div class="map-modal-wrap-overlay"></div>
                <div class="map-modal-item">
                    <div class="map-modal-container fl-wrap">
                        <div class="map-modal fl-wrap">
                            <div id="singleMap" data-latitude="40.7" data-longitude="-73.1"></div>
                        </div>
                        <h3><span>Location for : </span><a href="#">Listing Title</a></h3>
                        <div class="map-modal-close"><i class="fal fa-times"></i></div>
                    </div>
                </div>
            </div>
            <!--map-modal end -->                
            <!--register form -->
            
            <!--register form end -->
            <a class="to-top"><i class="fas fa-caret-up"></i></a>     
        </div>
        <!-- Main end -->
        <!--=============== scripts  ===============-->
        <script src="{{ asset('assets/frontend/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/scripts.js') }}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key={{ apiMap() }}&libraries=places&callback=initAutocomplete"></script>
        <script src="{{ asset('assets/frontend/js/map-single.js') }}"></script>   
        @stack('js')                       
        <script>
            $("#subscribe").ajaxChimp({
        language: "id",
        url: "http://kwst.us18.list-manage.com/subscribe/post?u=42df802713d4826a4b137cd9e&id=815d11e811"
    });
        </script>

        <!-- BEGIN - FC Instagram - Script -->
    <script src="{{ asset('assets/frontend/js/FCInstagram.js')}}"></script>
    <script>
    jQuery.fn.FCInstagram.accessData = {
        accessToken: "AQDySjTmhvwWd3hJsygNQ5AVBSIQlpQAKe2fdIcj-OJ5-d-mgXuHNoA1CsnVHRJejEdgFku7ix5_1aP4BzFPEV11XeHbA1Ee7qgZojhLuBE25DXXYP5psGSgqitRG1i0G-WWchsM-zwnytONYT0nX0eaJCvJcKCcCsYrT0WMn4zc_CdTlEc522fy6Nz4yYNqxC0_kCs0tPCFs5UB3QYcGtIXHTTkImssEPqbC4QpFn8Y1g", // Token
    };
    $('#instafeed').FCInstagram({
        max: 12,
        autoplay: true,
        complete: function () {
            console.log('completed');
        }
    });
    </script>
<!-- END - FC Instagram - Script -->
    </body>
</html>