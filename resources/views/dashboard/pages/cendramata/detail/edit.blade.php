@extends('dashboard.layouts.app')

@section('content')
<div class="row">
    <div id="flStackForm" class="col-md-8 layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>
                            Form Tambah Gambar {{ $page_name }} {{ $sub_page }}
                        </h4>
                    </div>                                                                        
                </div>
            </div>
            
            <div class="widget-content widget-content-area">
                <form method="post" action="{{ url ('dashboard/cindramata/detail/update/'.$edit->id) }}" enctype="multipart/form-data">
                    @csrf {{ method_field('PATCH') }}

                    <input type="text" hidden name="cindramata_id" value="{{ $id }}">


                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama Produk</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" name="nama_produk" value="{{ old('nama_produk',$edit->nama) }}" placeholder="Masukan nama produk">
                            @error('nama_produk')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Gambar</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="file" class="form-control-file" name="gambar" value="{{ old('gambar') }}" placeholder="Masukan Foto" accept="image/jpg,image/jpeg,image/png">
                            @error('gambar')
                                <span><code>{{$message}}</code></span>
                            @enderror
                            <p> Upload foto baru untuk mengubah gambar</p>
                            <img width="50%" src="{{ url('uploads/images/produk-cindramata/') }}/{{ $edit->gambar }}">
                        </div>
                    </div>

                   

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
                            <a class="btn btn-warning mt-3" href="{{ url('/dashboard/objek-wisata/gambar') }}/{{ $id }}">
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
                        <h4>Form ubah data menu {{ $page_name }} {{ $sub_page }}</h4>
                        <li>Masukan data Produk untuk diubah</li>
                    </div>                                                                        
                </div>
            </div>
            
        </div>
    </div>
</div> 
@endsection
@push('css')

@endpush
@push('js')
    

    <script>
        
        $(document).ready(function() {
    
        });
    </script>
     
@endpush