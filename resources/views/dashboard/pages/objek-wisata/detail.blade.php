@extends('dashboard.layouts.app')

@section('content')
<div class="row">
    <div id="flStackForm" class="col-md-8 layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>
                            Form Tambah Data Detail {{ $page_name }} {{ $nama_objek_wisata }}
                        </h4>
                    </div>                                                                        
                </div>
            </div>
            
            <div class="widget-content widget-content-area">
                @if(isset($edit->id))
                <form method="post" action="{{ url ('dashboard/objek-wisata/detail/update/'.$edit->id) }}" enctype="multipart/form-data">
                    @csrf {{ method_field('PATCH') }}
                    <input type="text" hidden name="id_edit" value="{{ $edit->id }}">
                @else
                <form method="post" action="{{ url('dashboard/objek-wisata/detail/store') }}" enctype="multipart/form-data">
                    @csrf
                @endif

                    <input type="text" hidden name="objek_wisata_id" value="{{ $objek_wisata_id }}">
                    <div class="form-group row mb-4">
                        <label  class="col-xl-3 col-sm-4 col-sm-3 col-form-label">Lembaga Pengelolah</label>
                        <div class="col-xl-9 col-lg-8 col-sm-9">
                            <input type="text" class="form-control" name="lembaga_pengelolah" value="{{ old('lembaga_pengelolah',isset($edit->lembaga_pengelola) ? $edit->lembaga_pengelola :'') }}" placeholder="Lembaga pengelolah objek wisata">
                            @error('lembaga_pengelolah')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-3 col-sm-4 col-sm-3 col-form-label">Jenis Pemasaran</label>
                        <div class="col-xl-9 col-lg-8 col-sm-9">
                            <select name="jenis_pemasaran[]" class="form-control select" multiple="multiple">
                                <option value="">Pilih Jenis Pemasaran</option>
                                <option @if(old('jenis_pemasaran.0') || in_array('Jaringan Sosial',$pemasaran)) selected="" @endif value="Jaringan Sosial">Jaringan Sosial</option>
                                <option @if(old('jenis_pemasaran.1') || in_array('Media Cetak',$pemasaran)) selected="" @endif value="Media Cetak">Media Cetak</option>
                                <option @if(old('jenis_pemasaran.2') || in_array('Media Elektronik',$pemasaran)) selected="" @endif value="Media Elektronik">Media Elektronik</option>
                            </select>
                            <p>Anda dapat memilih lebih dari satu</p>
                            @error('jenis_pemasaran')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row mb-4">
                        <label  class="col-xl-3 col-sm-4 col-sm-3 col-form-label">Peraturan Perundang Undangan</label>
                        <div class="col-xl-9 col-lg-8 col-sm-9">
                            <select name="peraturan_uu" class="form-control select">
                                <option value="">Pilih</option>
                                <option @if((isset($edit->peraturan_uu) && $edit->peraturan_uu == 1)) selected="" @endif value="1">Sudah Ada</option>
                                <option @if((isset($edit->peraturan_uu) && $edit->peraturan_uu == 0)) selected="" @endif value="0">Belum Ada</option>
                            </select>
                            @error('peraturan_uu')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-3 col-sm-4 col-sm-3 col-form-label">Stakeholder</label>
                        <div class="col-xl-9 col-lg-8 col-sm-9">
                            <input type="text" class="form-control" name="stakeholders" value="{{ old('stakeholders',isset($edit->stakeholders) ? $edit->stakeholders :'') }}" placeholder="Masukan data stakeholder">
                            @error('stakeholders')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-3 col-sm-4 col-sm-3 col-form-label">Nama Penanggung Jawab</label>
                        <div class="col-xl-9 col-lg-8 col-sm-9">
                            <input type="text" class="form-control" name="kontak_nama" value="{{ old('kontak_nama',isset($edit->kontak_nama) ? $edit->kontak_nama :'') }}" placeholder="Masukan nama penanggung jawab objek wisata">
                            @error('kontak_nama')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-3 col-sm-4 col-sm-3 col-form-label">Kontak Penanggung Jawab</label>
                        <div class="col-xl-9 col-lg-8 col-sm-9">
                            <input type="text" class="form-control" name="kontak_telepon" value="{{ old('kontak_telepon',isset($edit->kontak_telepon) ? $edit->kontak_telepon :'') }}" placeholder="Masukan nomor kontak penanggung jawab objek wisata">
                            @error('kontak_telepon')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-3 col-sm-4 col-sm-3 col-form-label">Harga Tiket</label>
                        <div class="col-xl-9 col-lg-8 col-sm-9">
                            <input type="number" class="form-control" name="harga_tiket" value="{{ old('harga_tiket',isset($edit->harga_tiket) ? $edit->harga_tiket :'') }}" placeholder="Masukan harga tiket">
                            <p>Masukan 0 jika tidak ada</p>
                            @error('harga_tiket')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-3 col-sm-4 col-sm-3 col-form-label">Halal ?</label>
                        <div class="col-xl-9 col-lg-8 col-sm-9">
                            <select name="halal" class="form-control select">
                                <option value="">Pilih</option>
                                <option @if((isset($edit->halal) && $edit->halal == 1)) selected="" @endif value="1">Halal</option>
                                <option @if((isset($edit->halal) && $edit->halal == 0)) selected="" @endif value="0">Tidak</option>
                            </select>
                            @error('halal')
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
                        <h4>Form Tambah Data Detail {{ $page_name }} {{ $nama_objek_wisata }}</h4>
                        <li>Data tambahan untuk  {{ $page_name }} {{ $nama_objek_wisata }}</li>
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
    <script>
        $(document).ready(function() {
            $(".select").select2({
                tags: true,
            });
        });
        
    </script>
@endpush