@extends('dashboard.layouts.app')

@section('content')
<div class="row">
    <div id="flStackForm" class="col-md-8 layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>
                            Form Ubah Data {{ $page_name }} {{ $edit->nama }}
                        </h4>
                    </div>                                                                        
                </div>
            </div>
            
            <div class="widget-content widget-content-area">
                <form method="post" action="{{ url ('dashboard/cindramata/update/'.$edit->id) }}" enctype="multipart/form-data">
                    @csrf {{ method_field('PATCH') }}

                    @if(Auth::user()->level == 1 || Auth::user()->level == 4)
                        <div class="form-group row mb-4">
                            <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Kabupaten</label>
                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                <select name="kabupaten"  id="kabupaten" class="form-control select">
                                    <option selected="selected" value="">Pilih Kabupaten</option>
                                    @foreach($kabupaten as $kab)
                                        <option @if(old('kabupaten',$edit->kabupaten_id) == $kab->id) selected="" @endif value="{{ $kab->id }}">{{ $kab->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kabupaten')
                                    <span><code>{{$message}}</code></span>
                                @enderror
                            </div>
                        </div>
                    @endif

                   

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama Cindramata</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" name="nama" value="{{ old('nama',$edit->nama) }}" placeholder="Masukan nama Cindramata">
                            @error('nama')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Jenis</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" name="jenis" value="{{ old('jenis',$edit->jenis) }}" placeholder="Masukan Jenis Cindramata">
                            @error('jenis')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Gambar</label>
                        <div class="col-xl-5 col-lg-4 col-sm-5">
                            <input type="file" class="form-control-file" name="gambar" value="{{ old('gambar') }}" placeholder="Masukan gambar" accept="image/jpg,image/jpeg,image/png">
                            @error('gambar')
                                <span><code>{{$message}}</code></span>
                            @enderror
                            <p> Upload foto baru untuk mengubah gambar</p>
                            <img width="50%" src="{{ asset('uploads/images/gambar-header-cindramata/') }}/{{ $edit->gambar }}">
                        </div>
                        <div class="col-xl-5 col-lg-4 col-sm-5">
                            <input type="text" class="form-control" name="sumber_gambar_header" value="{{ old('sumber_gambar_header') }}" placeholder="Masukan Sumber Foto">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <textarea id="summernote" name="deskripsi">{!! old('deskripsi',$edit->deskripsi) !!}</textarea>
                            @error('deskripsi')
                                <span><code>{{$message}}</code></span>
                            @enderror   
                        </div>
                    </div>

                  
                    
                    @if(Auth::user()->level == 1 || Auth::user()->level == 4)
                        <div class="form-group row mb-4">
                            <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Status</label>
                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                <select name="status" class="form-control select">
                                    <option selected="selected" value="">Pilih Status</option>
                                    <option @if(old('status',$edit->status) == 1) selected="" @endif value="1">Diusulkan</option>
                                    <option @if(old('status',$edit->status) == 2) selected="" @endif value="2">Pending</option>
                                    <option @if(old('status',$edit->status) == 3) selected="" @endif value="3">Aktif</option>
                                    <option @if(old('status',$edit->status) == 4) selected="" @endif value="4">Tolak</option>
                                </select>
                                @error('status')
                                    <span><code>{{$message}}</code></span>
                                @enderror
                            </div>
                        </div>
                    @endif

                    <div class="form-group row">
                        <div class="col-sm-2">Setuju</div>
                        <div class="col-sm-10">
                            <div class="form-check pl-0">
                                <div class="custom-control custom-checkbox checkbox-info">
                                    <input type="checkbox" name="tos" class="custom-control-input" id="hChkbox">
                                    <label class="custom-control-label" for="hChkbox">Term & Condition (<a href="#" class="text muted badge badge-primary" data-toggle="modal" data-target="#modaltos">klik disini untuk membaca</a>)</label>
                                </div>
                                @error('tos')
                                <span><code>Harap centang term and condition untuk menyimpan data !</code></span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <a class="btn btn-warning mt-3" href="{{ url('/dashboard/restaurant') }}">
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
                        <h4>Form Ubah Data {{ $page_name }}</h4>
                        <li>Masukan data cindramata untuk Diubah</li>
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
        
        // let map
        // function initMap() {
        //     map = new google.maps.Map(document.getElementById("map"), {
        //         center: { lat: {{ $edit->latitude }}, lng: {{ $edit->longitude }} },
        //         zoom: 15,
        //     });
        //     var marker = new google.maps.Marker({position: { lat: {{ $edit->latitude }}, lng: {{ $edit->longitude }} }, map: map});
        // }

        // function changeMap(lat,long)
        // {
        //     var data = {lat: +lat , lng: +long};
        //     console.log(data)
        //     var map = new google.maps.Map(
        //         document.getElementById('map'), {zoom: 15, center: data}
        //     );
        //     var marker = new google.maps.Marker({position: data, map: map});
        // }

        $(document).ready(function() {
            // initMap()
            
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
            
            @if(old('kabupaten',$edit->kabupaten_id))
                    $('#kecamatan').select2({
                        ajax: {
                            url:"{{url('dashboard/objek-wisata/list-kecamatan')}}/" + {{ old('kabupaten',$edit->kabupaten_id) }},
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