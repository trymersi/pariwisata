@extends('frontend.main')

@section('content')
<div class="content">
    <!--  section  -->
    <section class="parallax-section single-par" data-scrollax-parent="true">
        <div class="bg par-elem "  data-bg="{{ asset('uploads/images/setting/'.$setting->slider_gambar_objek_wisata) }}" data-scrollax="properties: { translateY: '30%' }"></div>
        <div class="overlay op7"></div>
        <div class="container">
            <div class="section-title center-align big-title">
                <h2><span>HUBUNGI KAMI</span></h2>
                <span class="section-separator"></span>
                <div class="breadcrumbs fl-wrap"><a href="{{ url('/') }}">Home</a><a href="#">Halaman</a><span>Hubungi Kami</span></div>
            </div>
        </div>
        <div class="header-sec-link">
            <a href="#sec1" class="custom-scroll-link"><i class="fal fa-angle-double-down"></i></a> 
        </div>
    </section>
    <!--  section  end-->               
    <!--  section  -->
    <section   id="sec1" data-scrollax-parent="true">
        <div class="container">
            <!--about-wrap -->
            <div class="about-wrap">
                <div class="row">
                    <div class="col-md-4">
                        <div class="ab_text-title fl-wrap">
                            <h3>Kontak Kami</h3>
                            <span class="section-separator fl-sec-sep"></span>
                        </div>
                        <!--box-widget-item -->                                       
                        <div class="box-widget-item fl-wrap block_box">
                            <div class="box-widget">
                                <div class="box-widget-content bwc-nopad">
                                    <div class="list-author-widget-contacts list-item-widget-contacts bwc-padside">
                                        <ul class="no-list-style">
                                            <li><span><i class="fal fa-map-marker"></i> Alamat :</span> <a href="#singleMap" class="custom-scroll-link">{{ $setting->alamat_kantor }}</a></li>
                                            <li><span><i class="fal fa-phone"></i> Telepon :</span> <a href="#">{{ $setting->notel }}</a></li>
                                            <li><span><i class="fal fa-envelope"></i> Mail :</span> <a href="#">{{ $setting->email }}</a></li>
                                        </ul>
                                    </div>
                                    <div class="list-widget-social bottom-bcw-box  fl-wrap">
                                        <ul class="no-list-style">
                                            <li><a href="#" target="_blank" ><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#" target="_blank" ><i class="fab fa-vk"></i></a></li>
                                            <li><a href="#" target="_blank" ><i class="fab fa-instagram"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--box-widget-item end -->  
                        <!--box-widget-item -->
                       
                        <!--box-widget-item end -->                                            
                    </div>
                    <div class="col-md-8">
                        <div class="ab_text">
                            <div class="ab_text-title fl-wrap">
                                <h3>HUBUNGI KAMI</h3>
                                <span class="section-separator fl-sec-sep"></span>
                            </div>
                            <p>Anda dapat menggunakan halaman ini untuk bertanya terkain konten pada situs ini dan juga dapat memberikan masukan maupun kontribusi.</p>
                            <div id="contact-form">
                                <div id="message"></div>
                                @if(session()->has('message'))
                                    <div class="reviews-comments-item-text fl-wrap" style="margin-bottom:10px;">
                                        <p>" {{ session()->get('message') }} "</p>
                                    </div>
                                    <br>
                                @endif
                                <form  class="custom-form" method="post" action="{{ action('Frontend\HomeController@contactSave') }}">
                                    @csrf
                                    <fieldset>
                                        <label><i class="fal fa-user"></i></label>
                                        <input type="text" name="name" id="name" placeholder="Nama Kamu *" value=""/>
                                        <div class="clearfix"></div>
                                        <label><i class="fal fa-envelope"></i>  </label>
                                        <input type="text"  name="email" id="email" placeholder="Alamat Email*" value=""/>
                                        <textarea name="comments"  id="comments" cols="40" rows="3" placeholder="Pesan Kamu:"></textarea>
                                    </fieldset>
                                    <button type="submit" class="btn float-btn color2-bg" >Kirim<i class="fal fa-paper-plane"></i></button>
                                </form>
                            </div>
                            <!-- contact form  end--> 
                        </div>
                    </div>
                </div>
            </div>
            <!-- about-wrap end  --> 
        </div>
    </section>
    <section class="no-padding-section">
        <div class="map-container">
            <div id="singleMap" data-latitude="{{ $setting->latitude }}" data-longitude="{{ $setting->longitude }}" data-mapTitle="Our Location"></div>
        </div>
    </section>
</div>
@endsection