@extends('dashboard.layouts.app')

@section('content')
<div class="row">
    <div id="flStackForm" class="col-md-8 layout-top-spacing">
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
                <form method="post" action="{{ action('Backend\TravelController@store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Kabupaten</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <select name="kabupaten"  id="kabupaten" class="form-control select">
                                <option selected="selected" value="">Pilih Kabupaten</option>
                                @foreach($kabupaten as $kab)
                                    <option @if(old('kabupaten') == $kab->id) selected="" @endif value="{{ $kab->id }}">{{ $kab->nama }}</option>
                                @endforeach
                            </select>
                            @error('kabupaten')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama Travel</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" placeholder="Masukan nama Travel">
                            @error('nama')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Alamat</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" placeholder="Masukan alamat travel">
                            @error('alamat')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Kontak </label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" name="kontak" value="{{ old('kontak') }}" placeholder="Masukan Kontak travel *">
                            @error('kontak')
                                <span><code>{{$message}}</code></span>
                            @enderror
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