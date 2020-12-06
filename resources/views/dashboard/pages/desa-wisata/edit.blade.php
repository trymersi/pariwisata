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
                        <form method="post" action="{{ url ('dashboard/desa-wisata/update/'.$edit->id) }}" enctype="multipart/form-data">
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
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Kecamatan</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <select name="kecamatan"  id="kecamatan" class="form-control select">
                                <option selected="selected" value="">Pilih Kecamatan</option>
                                @foreach($kecamatan as $kec)
                                    <option @if(old('kecamatan',$edit->kecamatan_id) == $kec->id) selected="" @endif value="{{ $kec->id }}">{{ $kec->text }}</option>
                                @endforeach
                            </select>
                            @error('kecamatan')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama Sadar Wisata</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" name="nama" value="{{ old('nama',$edit->nama) }}" placeholder="Masukan nama sadar wisata">
                            @error('nama')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Alamat Sadar Wisata</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" name="alamat" value="{{ old('alamat',$edit->alamat) }}" placeholder="Masukan alamat sadar wisata">
                            @error('alamat')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Potensi Wisata</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <select name="potensi[]" class="form-control select-potensi" multiple>
                                @foreach($potensi as $kat)
                                    <option selected="" value="{{ $kat }}">{{ $kat }}</option>
                                @endforeach
                            </select>
                            <p> (ketik Potensi lalu tekan tombol enter untuk menambahkan)</p>
                            @error('potensi')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Kontak Person</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" name="kontak" value="{{ old('kontak',$edit->kontak) }}" placeholder="Masukan Kontak Person *">
                            @error('kontak')
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
                                    <a class="btn btn-warning mt-3" href="{{ url('/dashboard/desa-wisata') }}">
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

@endpush
@push('js')
    
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script>
    $(document).ready(function() {
        $(".select").select2({
                tags: true,
            });
            $(".select-potensi").select2({
                tags: true,
            });
            
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