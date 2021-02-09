@extends('dashboard.layouts.app')

@section('content')
<div class="row">
    <div id="flStackForm" class="col-md-8 layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>
                            Form Setting Aplikasi {{ $page_name }}
                        </h4>
                    </div>                                                                        
                </div>
            </div>
            
            <div class="widget-content widget-content-area">
                <form method="post" action="{{ action('Backend\AppSettingController@store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama Aplikasi</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" name="nama_aplikasi" value="{{ old('nama_aplikasi',$edit->nama_aplikasi) }}" placeholder="Masukan nama Aplikasi">
                            @error('nama_aplikasi')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Versi Aplikasi</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" name="versi_aplikasi" value="{{ old('versi_aplikasi',$edit->versi_aplikasi) }}" placeholder="Masukan Versi Aplikasi">
                            @error('versi_aplikasi')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Tentang Kami</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <textarea class="form-control" name="tentang_kami" id="summernote" rows="3">{!! old('tentang_kami',$edit->tentang_kami) !!}</textarea>
                            @error('tentang_kami')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Ketentuan</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <textarea class="form-control" name="ketentuan" id="summernote2" rows="3">{!! old('ketentuan',$edit->ketentuan) !!}</textarea>
                            @error('ketentuan')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Kebijakan</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <textarea class="form-control" name="kebijakan" id="summernote3" rows="3">{!! old('kebijakan',$edit->kebijakan) !!}</textarea>
                            @error('kebijakan')
                                <span><code>{{$message}}</code></span>
                            @enderror
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
                        <li>form untuk mengubah keterangan Aplikasi</li>
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
        
        $('#summernote').summernote({
            placeholder: 'Masukan keterangan lengkap disini, anda juga dapat memasukan gambar pada bagian text',
            height: 350
        });
        $('#summernote2').summernote({
            placeholder: 'Masukan keterangan lengkap disini, anda juga dapat memasukan gambar pada bagian text',
            height: 350
        });
        $('#summernote3').summernote({
            placeholder: 'Masukan keterangan lengkap disini, anda juga dapat memasukan gambar pada bagian text',
            height: 350
        });
    </script>
     
@endpush