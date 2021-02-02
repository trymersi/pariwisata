@extends('frontend.main')

@section('content')
<div class="content">
    <!-- Map -->
    <div class="map-container column-map right-pos-map fix-map hid-mob-map">
        <div id="map-main"></div>
        <ul class="mapnavigation no-list-style">
            <li><a href="#" class="prevmap-nav mapnavbtn"><span><i class="fas fa-caret-left"></i></span></a></li>
            <li><a href="#" class="nextmap-nav mapnavbtn"><span><i class="fas fa-caret-right"></i></span></a></li>
        </ul>
        <div class="scrollContorl mapnavbtn tolt"   data-microtip-position="top-left" data-tooltip="Enable Scrolling"><span><i class="fal fa-unlock"></i></span></div>
        <div class="location-btn geoLocation tolt" data-microtip-position="top-left" data-tooltip="Your location"><span><i class="fal fa-location"></i></span></div>
        <div class="map-close"><i class="fas fa-times"></i></div>
    </div>
    <!-- Map end -->
    <div class="col-list-wrap novis_to-top">
        <!-- list-main-wrap-header-->
        <div class="list-main-wrap-header fl-wrap fixed-listing-header">
            <div class="container">
                <!-- list-main-wrap-title-->
                <div class="list-main-wrap-title">
                    @if(isset($pencarian))
                    <h2>Hasil Pencarian : <span> "{{ $pencarian }}"  </span>dan Kabupaten : <span>{{ $pencarian_kabupaten }}</span></h2>
                    
                    @else
                    <h2>Seluruh Hotel </span></h2>
                    @endif
                </div>
                <!-- list-main-wrap-title end-->
                <!-- list-main-wrap-opt-->
                <div class="list-main-wrap-opt">
                    <!-- price-opt-->
                    
                    <!-- price-opt-->
                    <div class="grid-opt">
                        <ul class="no-list-style">
                            <li class="grid-opt_act"><span class="two-col-grid act-grid-opt tolt" data-microtip-position="bottom" data-tooltip="Grid View"><i class="fal fa-th"></i></span></li>
                            <li class="grid-opt_act"><span class="one-col-grid tolt" data-microtip-position="bottom" data-tooltip="List View"><i class="fal fa-list"></i></span></li>
                        </ul>
                    </div>
                    <!-- price-opt end-->
                </div>
                <!-- list-main-wrap-opt end-->                    
            </div>
            <a class="custom-scroll-link back-to-filters clbtg" href="#lisfw"><i class="fal fa-search"></i></a>
        </div>
        <!-- list-main-wrap-header end-->  
        <div class="clearfix"></div>
        <div class="container">
            <div class="mob-nav-content-btn mncb_half color2-bg show-list-wrap-search fl-wrap"><i class="fal fa-filter"></i>  Filters</div>
            <div class="mob-nav-content-btn mncb_half color2-bg schm  fl-wrap"><i class="fal fa-map-marker-alt"></i>  View on map</div>
        </div>
        <div class="clearfix"></div>
        <!-- listsearch-input-wrap-->
        <div class="listsearch-input-wrap lws_mobile fl-wrap tabs-act" id="lisfw">
            <div class="listsearch-input-wrap_contrl fl-wrap">
                <div class="container">
                    <ul class="tabs-menu fl-wrap no-list-style">
                        <li class="current"><a href="#filters-search"> <i class="fal fa-sliders-h"></i> Filters </a></li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="container">
                <!--tabs -->                       
                <div class="tabs-container fl-wrap">
                    <!--tab -->
                    <div class="tab">
                        <div id="filters-search" class="tab-content  first-tab ">
                            <div class="fl-wrap">
                                <div class="row">
                                    <!-- listsearch-input-item-->
                                    <form method="post" action="{{ action('Frontend\HotelController@store') }}">
                                        @csrf
                                    <div class="col-md-4">
                                        <div class="listsearch-input-item">
                                            <span class="iconn-dec"><i class="far fa-bookmark"></i></span>
                                            <input type="text" name="keyword" value="{{ old('keyword') }}" placeholder="Masukan Apa yang kamu cari" value=""/>
                                        </div>
                                    </div>
                                    <!-- listsearch-input-item end-->
                                    <!-- listsearch-input-item-->
                                    <div class="col-md-4">
                                        <div class="listsearch-input-item">
                                            <select name="kabupaten" data-placeholder="Kabupaten" class="chosen-select no-search-select" >
                                                <option value="">Pilih Kabupaten</option>
                                                @foreach($list_kabupaten as $item)
                                                <option value="{{ old('kabupaten',$item->id) }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- listsearch-input-item end-->  
                                
                                    <!-- listsearch-input-item-->
                                    <div class="col-md-3">
                                        <div class="listsearch-input-item">
                                            <button class="header-search-button color-bg" ><i class="far fa-search"></i><span>cari</span></button>
                                        </div>
                                    </div>
                                    </form>
                                    <!-- listsearch-input-item end-->                                         
                                </div>
                                <!-- hidden-listing-filter -->
                                                           
                               
                            </div>
                        </div>
                    </div>
                    <!--tab end-->
                    <!--tab --> 
                    
                </div>
                <!--tabs end-->
            </div>
        </div>
        <!-- listsearch-input-wrap end-->
        <!-- listing-item-container -->
        <div class="listing-item-container init-grid-items fl-wrap">
            <div class="container">
                <!-- listing-item  -->
                @foreach($hotel as $item)
                <div class="listing-item">
                    <article class="geodir-category-listing fl-wrap">
                        <div class="geodir-category-img">
                            
                            <a href="{{ url("/hotel/".$item->slug) }}" class="geodir-category-img-wrap fl-wrap">
                            <img src="{{ asset('uploads/images/gambar-header-hotel/'.$item->gambar) }}" alt=""> 
                            </a>
                            <div class="listing-avatar"><a href="{{ url("/hotel/".$item->slug) }}"><img src="{{ asset('uploads/images/foto-kabupaten/'.$item->gambar_kabupaten) }}" alt=""></a>
                                <span class="avatar-tooltip"><strong>{{ $item->nama_kabupaten }}</strong></span>
                            </div>
                            <div class="geodir_status_date gsd_open"><i class="fal fa-lock-open"></i>{{ $item->nama_kabupaten }}</div>
                            <div class="geodir-category-opt">
                                <div class="listing-rating-count-wrap">
                                    <div class="review-score">4.8</div>
                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                    <br>
                                    <div class="reviews-count">1 reviews</div>
                                </div>
                            </div>
                        </div>
                        <div class="geodir-category-content fl-wrap">
                            <div class="geodir-category-content-title fl-wrap">
                                <div class="geodir-category-content-title-item">
                                    <h3 class="title-sin_map"><a href="{{ url("/hotel/".$item->slug) }}">{{ $item->nama }}</a><span class="verified-badge"><i class="fal fa-check"></i></span></h3>
                                    <div class="geodir-category-location fl-wrap"><a href="#5" class="map-item"><i class="fas fa-map-marker-alt"></i> {{ $item->alamat }}</a></div>
                                </div>
                            </div>
                            <div class="geodir-category-text fl-wrap">
                                <p class="small-text">{{ meta_description($item->deskripsi) }}</p>
                                <div class="facilities-list fl-wrap">
                                    
                                </div>
                            </div>
                            <div class="geodir-category-footer fl-wrap">
                                <a class="listing-item-category-wrap">
                                    <div class="listing-item-category yellow-bg"><i class="far fa-bed"></i></div>
                                    <span>Hotel</span>
                                </a>
                                <div class="geodir-opt-list">
                                    <ul class="no-list-style">
                                        <li><a href="#" class="show_gcc"><i class="fal fa-envelope"></i><span class="geodir-opt-tooltip">Info Kontak</span></a></li>
                                        <li><a href="#1" class="single-map-item" data-newlatitude="{{ $item->latitude }}" data-newlongitude="{{ $item->longitude }}"><i class="fal fa-map-marker-alt"></i><span class="geodir-opt-tooltip">On the map <strong>1</strong></span> </a></li>
                                        @if((getGambarHotel($item->id) != null))
                                        <li>
                                            <div class="dynamic-gal gdop-list-link" data-dynamicPath="[@foreach(getGambarHotel($item->id) as $key) {{ $key }}@endforeach]"><i class="fal fa-search-plus"></i><span class="geodir-opt-tooltip">Gallery</span></div>
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
                @endforeach
                <!-- listing-item end -->                                       
                <!-- listing-item  -->
                                                                                                   
                <div class="pagination">
                    
                </div>
            </div>
        </div>
        <!-- listing-item-container end -->
    </div>
    <div class="limit-box fl-wrap"></div>
</div>

@push('js')
<script src="{{ asset('assets/frontend/js/map-plugins.js') }}"></script> 
    <script>
        (function ($) {
    "use strict";
    function mainMap() {
        function locationData(locationURL, locationImg, locationTitle, locationAddress, locationCategory, locationStarRating, locationRevievsCounter, locationStatus) {
            return ('<div class="map-popup-wrap"><div class="map-popup"><div class="infoBox-close"><i class="fal fa-times"></i></div><a href="' + locationURL + '" class="listing-img-content fl-wrap"><div class="infobox-status '+ locationStatus +'">' + locationStatus + '</div><img src="' + locationImg + '" alt=""><div class="card-popup-raining map-card-rainting" data-staRrating="' + locationStarRating + '"><span class="map-popup-reviews-count">( ' + locationRevievsCounter + ' reviews )</span></div></a> <div class="listing-content"><div class="listing-content-item fl-wrap"><div class="map-popup-location-category ' + locationCategory + '"></div><div class="listing-title fl-wrap"><h4><a href=' + locationURL + '>' + locationTitle + '</a></h4><div class="map-popup-location-info"><i class="fas fa-map-marker-alt"></i>' + locationAddress + '</div></div><div class="map-popup-footer"><a href=' + locationURL + ' class="main-link">Lihat Detail <i class="fal fa-long-arrow-right"></i></a></div></div></div></div> ')
        }
	    //  Map Infoboxes ------------------
        var locations = [
            @foreach($hotel as $item)
            [locationData('{{ url("/hotel/".$item->slug) }}', '{{ asset("uploads/images/gambar-header-hotel/".$item->gambar) }}', '{{ $item->nama }}', " {{ $item->alamat }}", 'hotels-cat', "5", "1", "{{ $item->nama_kabupaten }}"  ), {{ $item->latitude }}, {{$item->longitude}}, 0 , '{{ asset("uploads/images/gambar-header-hotel/".$item->gambar) }}'],
            @endforeach
        ];
	    //   Map Infoboxes end ------------------
        var map = new google.maps.Map(document.getElementById('map-main'), {
            zoom: 9,
            scrollwheel: false,
            center: new google.maps.LatLng(0.533333, 101.45),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoomControl: false,
            mapTypeControl: false,
            scaleControl: false,
            panControl: false,
            fullscreenControl: true,
            navigationControl: false,
            streetViewControl: false,
            animation: google.maps.Animation.BOUNCE,
            gestureHandling: 'cooperative',
            styles: [{
                "featureType": "administrative",
                "elementType": "labels.text.fill",
                "stylers": [{
                    "color": "#444444"
                }]
            }]
        });
        var boxText = document.createElement("div");
        boxText.className = 'map-box'
        var currentInfobox;
        var boxOptions = {
            content: boxText,
            disableAutoPan: true,
            alignBottom: true,
            maxWidth: 0,
            pixelOffset: new google.maps.Size(-150, -55),
            zIndex: null,
            boxStyle: {
                width: "300px"
            },
            closeBoxMargin: "0",
            closeBoxURL: "",
            infoBoxClearance: new google.maps.Size(1, 1),
            isHidden: false,
            pane: "floatPane",
            enableEventPropagation: false,
        };

      var markerCluster, overlay, i;
      var allMarkers = [];

      var clusterStyles = [
        {
          textColor: 'white',
          url: '',
          height: 50,
          width: 50
        }
      ];

      var ib = new InfoBox();
             google.maps.event.addListener(ib, "domready", function () {
                cardRaining();
 
            });
	  var markerImg;
	  var markerCount;
      for (i = 0; i < locations.length; i++) {
             var labels = '123456789';
		markerImg = locations[i][4];
		markerCount = locations[i][3] + 1;
        var overlaypositions = new google.maps.LatLng(locations[i][1], locations[i][2]),

        overlay = new CustomMarker(
         overlaypositions, map,{ marker_id: i},  markerImg , markerCount
        );

        allMarkers.push(overlay);

        google.maps.event.addDomListener(overlay, 'click', (function(overlay, i) {

        return function() {
             ib.setOptions(boxOptions);
             boxText.innerHTML = locations[i][0];
             ib.close();
             ib.open(map, overlay);
             currentInfobox = locations[i][3];
 
                    var latLng = new google.maps.LatLng(locations[i][1], locations[i][2]);
                    map.panTo(latLng);
                    map.panBy(0, -110);

            google.maps.event.addListener(ib,'domready',function(){
              $('.infoBox-close').click(function(e) {
                  e.preventDefault();
                  ib.close();
                  $('.map-marker-container').removeClass('clicked infoBox-opened');
              });

            });

          }
        })(overlay, i));

      }
        var options2 = {
            imagePath: '',
            styles: clusterStyles,
            minClusterSize: 2
        };
        markerCluster = new MarkerClusterer(map, allMarkers, options2);
        google.maps.event.addDomListener(window, "resize", function () {
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        });
 
        $('.map-item').on("click", function (e) {
            e.preventDefault();
            map.setZoom(15);
            var index = currentInfobox;
            var marker_index = parseInt($(this).attr('href').split('#')[1], 10);
            google.maps.event.trigger(allMarkers[marker_index-1], "click");
            if ($(window).width() > 1064) {
                if ($(".map-container").hasClass("fw-map")) {
                    $('html, body').animate({
                        scrollTop: $(".map-container").offset().top + "-110px"
                    }, 1000)
                    return false;
                }
            }
        });
        $('.nextmap-nav').on("click", function (e) {
            e.preventDefault();
             map.setZoom(15);
            var index = currentInfobox;
            if (index + 1 < allMarkers.length) {
                google.maps.event.trigger(allMarkers[index+ 1], 'click');
            } else {
                google.maps.event.trigger(allMarkers[0], 'click');
            }
        });
        $('.prevmap-nav').on("click", function (e) {
            e.preventDefault();
            map.setZoom(15);
            if (typeof (currentInfobox) == "undefined") {
                google.maps.event.trigger(allMarkers[allMarkers.length - 1], 'click');
            } else {
                var index = currentInfobox;
                if (index - 1 < 0) {
                    google.maps.event.trigger(allMarkers[allMarkers.length - 1], 'click');
                } else {
                    google.maps.event.trigger(allMarkers[index - 1], 'click');
                }
            }
        });
      // Scroll enabling button
      var scrollEnabling = $('.scrollContorl');

      $(scrollEnabling).click(function(e){
          e.preventDefault();
          $(this).toggleClass("enabledsroll");

          if ( $(this).is(".enabledsroll") ) {
             map.setOptions({'scrollwheel': true});
          } else {
             map.setOptions({'scrollwheel': false});
          }
      });		
        var zoomControlDiv = document.createElement('div');
        var zoomControl = new ZoomControl(zoomControlDiv, map);
        function ZoomControl(controlDiv, map) {
            zoomControlDiv.index = 1;
            map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(zoomControlDiv);
            controlDiv.style.padding = '5px';
            var controlWrapper = document.createElement('div');
            controlDiv.appendChild(controlWrapper);
            var zoomInButton = document.createElement('div');
            zoomInButton.className = "mapzoom-in";
            controlWrapper.appendChild(zoomInButton);
            var zoomOutButton = document.createElement('div');
            zoomOutButton.className = "mapzoom-out";
            controlWrapper.appendChild(zoomOutButton);
            google.maps.event.addDomListener(zoomInButton, 'click', function () {
                map.setZoom(map.getZoom() + 1);
            });
            google.maps.event.addDomListener(zoomOutButton, 'click', function () {
                map.setZoom(map.getZoom() - 1);
            });
        }
		
		
      // Geo Location Button
      $(".geoLocation, .input-with-icon.location a").on("click", function (e) {
          e.preventDefault();
          geolocate();
      });

      function geolocate() {

          if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function (position) {
                  var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                  map.setCenter(pos);
                  map.setZoom(12);
				  
		  var avrtimg = $(".avatar-img").attr("data-srcav");
         var markerIcon3 = {
            url: avrtimg,
        }		
        var marker3 = new google.maps.Marker({
            position: pos,
             map:  map,
 
            icon: markerIcon3,
            title: 'Your location'
        });			  
	 var myoverlay = new google.maps.OverlayView();
       myoverlay.draw = function () {
           // add an id to the layer that includes all the markers so you can use it in CSS
           this.getPanes().markerLayer.id='markerLayer';
       };
       myoverlay.setMap(map);			  
				  
              });
          }
      }		
    }
	
 	
	
	
	
 
	
	
	
    // Custom Map Marker
    // ----------------------------------------------- //

    function CustomMarker(latlng, map, args,   markerImg , markerCount) {
      this.latlng = latlng;
      this.args = args;
 
	  this.markerImg = markerImg;
	  this.markerCount = markerCount;
      this.setMap(map);
    }

    CustomMarker.prototype = new google.maps.OverlayView();

    CustomMarker.prototype.draw = function() {

      var self = this;

      var div = this.div;

      if (!div) {

        div = this.div = document.createElement('div');
        div.className = 'map-marker-container';

        div.innerHTML = '<div class="marker-container">'+
							'<span class="marker-count">'+self.markerCount+'</span>'+
                            '<div class="marker-card">'+
                               '<div class="marker-holder"><img src="'+self.markerImg+'" alt=""></div>'+
                            '</div>'+
                         '</div>'
 

        // Clicked marker highlight
        google.maps.event.addDomListener(div, "click", function(event) {
            $('.map-marker-container').removeClass('clicked infoBox-opened');
            google.maps.event.trigger(self, "click");
            $(this).addClass('clicked infoBox-opened');
        });


        if (typeof(self.args.marker_id) !== 'undefined') {
          div.dataset.marker_id = self.args.marker_id;
        }

        var panes = this.getPanes();
        panes.overlayImage.appendChild(div);
      }

      var point = this.getProjection().fromLatLngToDivPixel(this.latlng);

      if (point) {
        div.style.left = (point.x) + 'px';
        div.style.top = (point.y) + 'px';
      }
    };

    CustomMarker.prototype.remove = function() {
      if (this.div) {
        this.div.parentNode.removeChild(this.div);
        this.div = null; $(this).removeClass('clicked');
      }
    };

    CustomMarker.prototype.getPosition = function() { return this.latlng; };

    // -------------- Custom Map Marker / End -------------- //	
	
	
var head = document.getElementsByTagName( 'head' )[0];

// Save the original method
var insertBefore = head.insertBefore;

// Replace it!
head.insertBefore = function( newElement, referenceElement ) {

    if ( newElement.href && newElement.href.indexOf( 'https://fonts.googleapis.com/css?family=Roboto' ) === 0 ) {
        return;
    }

    insertBefore.call( head, newElement, referenceElement );
};	
	
	    var map = document.getElementById('map-main');
    if (typeof (map) != 'undefined' && map != null) {
        google.maps.event.addDomListener(window, 'load', mainMap);
    }
	
	
	
	
})(this.jQuery);
    </script>
@endpush
@endsection