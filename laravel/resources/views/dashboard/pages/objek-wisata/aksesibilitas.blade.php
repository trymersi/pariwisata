@extends('dashboard.layouts.app')

@section('content')
<div class="row">
    <div id="flStackForm" class="col-md-8 layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>
                            Form Tambah Data Aksesibilitas {{ $page_name }} {{ $nama_objek_wisata }}
                        </h4>
                    </div>                                                                        
                </div>
            </div>
            
            <div class="widget-content widget-content-area">
                @if(isset($edit->id))
                <form method="post" action="{{ url ('dashboard/objek-wisata/aksesibilitas/update/'.$edit->id) }}" enctype="multipart/form-data">
                    @csrf {{ method_field('PATCH') }}
                    <input type="text" hidden name="id_edit" value="{{ $edit->id }}">
                @else
                <form method="post" action="{{ url('dashboard/objek-wisata/aksesibilitas/store') }}" enctype="multipart/form-data">
                    @csrf
                @endif

                    <input type="text" hidden name="objek_wisata_id" value="{{ $objek_wisata_id }}">
                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Kondisi Jalan Menuju Objek</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" name="kondisi_jalan_menuju" value="{{ old('kondisi_jalan_menuju',isset($edit->kondisi_jalan_menuju) ? $edit->kondisi_jalan_menuju :'') }}" placeholder="Masukan kondisi jalan menuju objek wisata">
                            @error('kondisi_jalan_menuju')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Kondisi Jalan Didalam Objek</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" name="kondisi_jalan_dalam" value="{{ old('kondisi_jalan_dalam',isset($edit->kondisi_jalan_dalam) ? $edit->kondisi_jalan_dalam :'') }}" placeholder="Masukan kondisi jalan didalam objek wisata">
                            @error('kondisi_jalan_dalam')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Transportasi Menuju Objek</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" name="jenis_transportasi" value="{{ old('jenis_transportasi',isset($edit->jenis_transportasi) ? $edit->jenis_transportasi :'') }}" placeholder="Masukan jenis tranportasi yg digunakan agar sampai ke objek wisata">
                            @error('jenis_transportasi')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Biaya</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="number" class="form-control" name="biaya" value="{{ old('biaya',isset($edit->biaya) ? $edit->biaya :'') }}" placeholder="Masukan biaya yang dihabiskan agar sampai ke objek wisata">
                            @error('biaya')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <a class="btn btn-warning mt-3" href="{{ url('/dashboard/objek-wisata') }}">
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
                        <h4>Form Tambah Data Aksesibilitas {{ $page_name }} {{ $nama_objek_wisata }}</h4>
                        <li>Form untuk memberikan informasi akses menuju {{ $page_name }} {{ $nama_objek_wisata }}</li>
                    </div>                                                                        
                </div>
            </div>
            
        </div>
    </div>
</div> 
@endsection
@push('css')
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/summernote/dist/summernote.css') }}" rel="stylesheet" />
@endpush
@push('js')
    
    <script src="{{ asset('plugins/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    
@endpush