@extends('dashboard.layouts.app')

@section('content')
<div class="row">
    <div id="flStackForm" class="col-md-8 layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>
                            Form Setting Website {{ $page_name }}
                        </h4>
                    </div>                                                                        
                </div>
            </div>
            
            <div class="widget-content widget-content-area">
                <form method="post" action="{{ url ('dashboard/pengaturan/update/'.$edit->id) }}" enctype="multipart/form-data">
                    @csrf {{ method_field('PATCH') }}
                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama Website</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" name="nama_website" value="{{ old('nama_website',$edit->nama_website) }}" placeholder="Masukan nama website">
                            @error('nama_website')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Keterangan Website</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <textarea class="form-control" name="keterangan_website" rows="3">{{ old('keterangan_website',$edit->keterangan_website) }}</textarea>
                            @error('keterangan_website')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Alamat Kantor</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <textarea class="form-control" name="alamat_kantor" rows="3">{{ old('alamat_kantor',$edit->alamat_kantor) }}</textarea>
                            @error('alamat_kantor')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">icon</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="file" class="form-control-file" name="icon" value="{{ old('icon') }}"  accept="image/jpg,image/jpeg,image/png">
                            @error('icon')
                                <span><code>{{$message}}</code></span>
                            @enderror
                            <p> Upload gambar baru untuk mengubah</p>
                            <img width="150px" src="{{ url('uploads/images/setting/') }}/{{ $edit->icon }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Email Website</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="email" class="form-control" name="email_website" value="{{ old('email_website',$edit->email) }}" placeholder="Masukan Email website">
                            @error('nama_website')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nomor Telepon</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="notel" class="form-control" name="notel" value="{{ old('notel',$edit->notel) }}" placeholder="Masukan Nomor Telepon Kantor">
                            @error('nama_website')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Logo Website</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="file" class="form-control-file" name="logo_website" value="{{ old('logo_website') }}"  accept="image/jpg,image/jpeg,image/png">
                            @error('logo_website')
                                <span><code>{{$message}}</code></span>
                            @enderror
                            <p> Upload gambar baru untuk mengubah</p>
                            <img width="150px" src="{{ url('uploads/images/setting/') }}/{{ $edit->logo_website }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Gambar Login</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="file" class="form-control-file" name="gambar_login" value="{{ old('gambar_login') }}"  accept="image/jpg,image/jpeg,image/png">
                            @error('gambar_login')
                                <span><code>{{$message}}</code></span>
                            @enderror
                            <p> Upload gambar baru untuk mengubah</p>
                            <img width="150px" src="{{ url('uploads/images/setting/') }}/{{ $edit->gambar_login }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Video Promosi</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" name="video_promo" value="{{ old('video_promo',$edit->video_promosi) }}" placeholder="Masukan Link promosi destinasi riau">
                            @error('video_promo')
                                <span><code>{{$message}}</code></span>
                            @enderror
                            <p> Url / Link dari situs youtube</p>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">
                            Lokasi <br>
                            <a id="button-cari" class="btn btn-success mt-3">
                                Cari Lokasi 
                                <svg id="loading-cari" class="spinner-border d-none"></svg>
                                <svg id="icon-cari" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
                                <svg id="icon-selesai" class="d-none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            </a>
                        </label>
                        
                        <div class="col-xl-5 col-lg-4 col-sm-5">
                            <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude',$edit->latitude) }}" placeholder="Masukan Latitude">
                            <code class="map-error"></code>
                            @error('latitude')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                        <div class="col-xl-5 col-lg-4 col-sm-5">
                            <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude',$edit->longitude) }}" placeholder="Masukan Longitude">
                            @error('longitude')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>
                    <h3>Gambar Slider</h3>
                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Gambar Slider Utama</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="file" class="form-control-file" name="slider_gambar_utama" value="{{ old('slider_gambar_utama') }}"  accept="image/jpg,image/jpeg,image/png">
                            @error('slider_gambar_utama')
                                <span><code>{{$message}}</code></span>
                            @enderror
                            <p> Upload gambar baru untuk mengubah</p>
                            <img width="150px" src="{{ url('uploads/images/setting/') }}/{{ $edit->slider_gambar_utama }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Gambar Slider Objek Wisata</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="file" class="form-control-file" name="slider_gambar_objek_wisata" value="{{ old('slider_gambar_objek_wisata') }}"  accept="image/jpg,image/jpeg,image/png">
                            @error('slider_gambar_objek_wisata')
                                <span><code>{{$message}}</code></span>
                            @enderror
                            <p> Upload gambar baru untuk mengubah</p>
                            <img width="150px" src="{{ url('uploads/images/setting/') }}/{{ $edit->slider_gambar_objek_wisata }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Gambar Slider Event</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="file" class="form-control-file" name="slider_gambar_event" value="{{ old('slider_gambar_event') }}"  accept="image/jpg,image/jpeg,image/png">
                            @error('slider_gambar_event')
                                <span><code>{{$message}}</code></span>
                            @enderror
                            <p> Upload gambar baru untuk mengubah</p>
                            <img width="150px" src="{{ url('uploads/images/setting/') }}/{{ $edit->slider_gambar_event }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Gambar Slider Restoran</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="file" class="form-control-file" name="slider_gambar_restoran" value="{{ old('slider_gambar_restoran') }}"  accept="image/jpg,image/jpeg,image/png">
                            @error('slider_gambar_restoran')
                                <span><code>{{$message}}</code></span>
                            @enderror
                            <p> Upload gambar baru untuk mengubah</p>
                            <img width="150px" src="{{ url('uploads/images/setting/') }}/{{ $edit->slider_gambar_restoran }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Gambar Slider Hotel</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="file" class="form-control-file" name="slider_gambar_hotel" value="{{ old('slider_gambar_hotel') }}"  accept="image/jpg,image/jpeg,image/png">
                            @error('slider_gambar_hotel')
                                <span><code>{{$message}}</code></span>
                            @enderror
                            <p> Upload gambar baru untuk mengubah</p>
                            <img width="150px" src="{{ url('uploads/images/setting/') }}/{{ $edit->slider_gambar_hotel }}">
                        </div>
                    </div>

                    <h3>Gambar Promosi</h3>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Gambar Promosi 1</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="file" class="form-control-file" name="gambar_promosi_satu" value="{{ old('gambar_promosi_satu') }}"  accept="image/jpg,image/jpeg,image/png">
                            @error('gambar_promosi_satu')
                                <span><code>{{$message}}</code></span>
                            @enderror
                            <p> Upload gambar baru untuk mengubah</p>
                            <img width="150px" src="{{ url('uploads/images/setting/') }}/{{ $edit->gambar_promosi_satu }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Gambar Promosi 2</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="file" class="form-control-file" name="gambar_promosi_dua" value="{{ old('gambar_promosi_dua') }}"  accept="image/jpg,image/jpeg,image/png">
                            @error('gambar_promosi_dua')
                                <span><code>{{$message}}</code></span>
                            @enderror
                            <p> Upload gambar baru untuk mengubah</p>
                            <img width="150px" src="{{ url('uploads/images/setting/') }}/{{ $edit->gambar_promosi_dua }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <a class="btn btn-warning mt-3" href="{{ url('/dashboard') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                                Batalkan
                            </a>
                            <button type="submit" id="button-simpan" class="btn btn-primary mt-3">
                                Simpan <svg id="loading-simpan" class="spinner-border d-none"></svg>
                            </button>
                        </div>
                        
                    </div>
                </form>

            </div>
            
        </div>
        
    </div>
    <div id="flStackForm" class="col-md-4 layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Form Tambah Data {{ $page_name }}</h4>
                        <li>form untuk mengubah keterangan website</li>
                    </div>                                                                        
                </div>
            </div>

            <div class="widget-content widget-content-area">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Map</h4>
                        <div id="map"></div>
                    </div>                                                                        
                </div>
            </div>
            
        </div>
    </div>

    
</div> 
@endsection
@push('css')
    <script
    src="https://maps.googleapis.com/maps/api/js?key={{ apiMap() }}&callback=initMap"
    defer
    ></script>
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/summernote/dist/summernote.css') }}" rel="stylesheet" />
    <style>
        #map {
            height: 350px;
        }
        </style>
@endpush
@push('js')
    
    <script src="{{ asset('plugins/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script>
        
        let map
        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: {{ $edit->latitude }}, lng: {{ $edit->longitude }} },
                zoom: 15,
            });
            var marker = new google.maps.Marker({position: { lat: {{ $edit->latitude }}, lng: {{ $edit->longitude }} }, map: map});
        }

        function changeMap(lat,long)
        {
            var data = {lat: +lat , lng: +long};
            console.log(data)
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 15, center: data}
            );
            var marker = new google.maps.Marker({position: data, map: map});
        }
        $(document).ready(function() {
            initMap()
            
            $("#longitude").keyup(function()
            {
                console.log($("#longitude").val())
                if($("#latitude").val() != '')
                {
                    changeMap($("#latitude").val(),$("#longitude").val())
                }
            })

            $("#latitude").keyup(function()
            {
                console.log($("#latitude").val())
                if($("#longitude").val() != '')
                {
                    changeMap($("#latitude").val(),$("#longitude").val())
                }
            })

            $('#summernote').summernote({
                placeholder: 'Masukan keterangan lengkap disini, anda juga dapat memasukan gambar pada bagian text',
                height: 350
            });

            $(".select").select2({
                tags: true,
            });

            $("#button-cari").on('click',function()
            {
                $("#loading-cari").removeClass('d-none');
                $("#icon-cari").addClass('d-none');
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else { 
                    $(".map-error").html("Mohon maaf browser tidak support, harap masukan lokasi manual");
                }
                function showPosition(position) 
                {
                    setTimeout(function(){ 
                        $('#map').removeClass('d-none');
                        changeMap(position.coords.latitude,position.coords.longitude)
                        
                        $("#latitude").val(position.coords.latitude);
                        $("#longitude").val(position.coords.longitude);
                        $("#icon-selesai").removeClass('d-none');
                        $("#loading-cari").addClass('d-none'); 
                    }, 1000);
                    
                }
            })
            
            @if(Auth::user()->level == 7)
                $('#kecamatan').select2({
                    ajax: {
                        url:"{{url('dashboard/objek-wisata/list-kecamatan')}}/" + {{ Auth::user()->kabupaten_id }},
                        processResults: function (data) {
                            return {
                                results: data
                            };
                        }
                    }
                });
            @endif
            
            @if(old('kabupaten'))
                    $('#kecamatan').select2({
                        ajax: {
                            url:"{{url('dashboard/objek-wisata/list-kecamatan')}}/" + {{ old('kabupaten') }},
                            processResults: function (data) {
                                return {
                                    results: data
                                };
                            }
                        }
                    });
            @endif
           
            $('#kabupaten').on('change',function()
            {
                var id_kabupaten = $(this).val();

                $('#kecamatan').select2({
                   
                    placeholder: "Pilih Kecamatan",
                    ajax: {
                        url:"{{url('dashboard/objek-wisata/list-kecamatan')}}/" + id_kabupaten,
                        processResults: function (data) {
                            return {
                                results: data
                            };
                        }
                    }
                });
            })
        });
    </script>
     
@endpush