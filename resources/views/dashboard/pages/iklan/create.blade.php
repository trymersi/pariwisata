@extends('dashboard.layouts.app')

@section('content')
<div class="container">
    <div class="container">
        
        <div class="row">
            <div id="flStackForm" class="col-lg-12 layout-spacing layout-top-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">                                
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>
                                    Form Tambah Data {{ $page_name }}
                                </h4>
                            </div>                                                                        
                        </div>
                    </div>
                    
                        <div class="widget-content widget-content-area">
                            <form method="post" action="{{ action('Backend\IklanController@store') }}" enctype="multipart/form-data">
                                @csrf
                                

                                <div class="form-group row mb-4">
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama Iklan</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" class="form-control" name="nama_link" value="{{ old('nama_link') }}" placeholder="Masukan Nama Link">
                                        @error('nama_link')
                                            <span><code>{{$message}}</code></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Alamat Iklan</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" class="form-control" name="alamat_link" value="{{ old('alamat_link') }}" placeholder="Masukan Link">
                                        @error('alamat_link')
                                            <span><code>{{$message}}</code></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Gambar Banner</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="file" class="form-control-file" name="gambar_link" value="{{ old('gambar_link') }}" placeholder="Masukan Foto" accept="image/jpg,image/jpeg,image/png">
                                        @error('gambar_link')
                                            <span><code>{{$message}}</code></span>
                                        @enderror
                                    </div>
                                </div>

                            

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <a class="btn btn-warning mt-3" href="{{ url('/dashboard/iklan') }}">
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
            
        </div>
      
        
        
    </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" />
@endpush
@push('js')
    
    <script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script>
        
        $(document).ready(function() {
            
            var f2 = flatpickr(document.getElementById('dateTimeFlatpickr'), {
                dateFormat: "d-m-Y",
            });
           
            var f2 = flatpickr(document.getElementById('dateTimeFlatpickr2'), {
                dateFormat: "d-m-Y",
            });

            $(".select").select2({
                tags: true,
            });

            
            @if(Auth::user()->level == 7)
                $('#objek_wisata').select2({
                    placeholder: "Pilih Objek Wisata",
                    ajax: {
                        url:"{{url('dashboard/restaurant/list-objek-wisata')}}/" + {{ Auth::user()->kabupaten_id }},
                        processResults: function (data) {
                            return {
                                results: data
                            };
                        }
                    }
                });
            @endif
            
            @if(old('kabupaten'))
                    $('#objek_wisata').select2({
                        placeholder: "Pilih Objek Wisata",
                        ajax: {
                            url:"{{url('dashboard/restaurant/list-objek-wisata')}}/" + {{ old('kabupaten') }},
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

                $('#objek_wisata').select2({
                   
                    placeholder: "Pilih Objek Wisata",
                    ajax: {
                        url:"{{url('dashboard/restaurant/list-objek-wisata')}}/" + id_kabupaten,
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