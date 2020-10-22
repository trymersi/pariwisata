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
                                    Form Edit Data {{ $page_name }} {{ $edit->nama_kategori }}
                                </h4>
                            </div>                                                                        
                        </div>
                    </div>
                    
                    <div class="widget-content widget-content-area">
                        <form method="post" action="{{ url ('dashboard/kategori-berita/update/'.$edit->id) }}" enctype="multipart/form-data">
                            @csrf {{ method_field('PATCH') }}

                            <div class="form-group row mb-4">
                                <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama Kategori</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <input type="text" class="form-control" name="nama_kategori" value="{{ old('nama_kategori',$edit->nama) }}" placeholder="Masukan data nama kategori">
                                    @error('nama_kategori')
                                        <span><code>{{$message}}</code></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <a class="btn btn-warning mt-3" href="{{ url('/dashboard/kategori-ekraf') }}">
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
    <link href="{{ asset('plugins/summernote/dist/summernote.css') }}" rel="stylesheet" />
@endpush
@push('js')
    <script src="{{ asset('plugins/summernote/dist/summernote.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Masukan deskripsi lengkap disini, anda juga dapat memasukan gambar pada bagian text',
                height: 350
            });
        });
    </script>
@endpush