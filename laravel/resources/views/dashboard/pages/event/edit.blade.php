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
                        <form method="post" action="{{ url ('dashboard/event/update/'.$edit->id) }}" enctype="multipart/form-data">
                            @csrf {{ method_field('PATCH') }}

                            @if(Auth::user()->level != 7)
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
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama Objek Wisata</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <select name="objek_wisata"  id="objek_wisata" class="form-control select">
                                            <option selected="selected" value="">Pilih Objek Wisata</option>
                                            @foreach($objek_wisata as $objek)
                                                <option @if(old('objek_wisata',$edit->objek_wisata_id) == $objek->id) selected="" @endif value="{{ $objek->id }}">{{ $objek->text }}</option>
                                            @endforeach
                                        </select>
                                        @error('objek_wisata')
                                            <span><code>{{$message}}</code></span>
                                        @enderror
                                    </div>
                                </div>

                                

                                <div class="form-group row mb-4">
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama Event</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" class="form-control" name="nama_event" value="{{ old('nama_event',$edit->nama) }}" placeholder="Masukan Nama Event">
                                        @error('nama_event')
                                            <span><code>{{$message}}</code></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Gambar Header</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="file" class="form-control-file" name="gambar_header" value="{{ old('gambar_header') }}" placeholder="Masukan Foto" accept="image/jpg,image/jpeg,image/png">
                                        @error('gambar_header')
                                            <span><code>{{$message}}</code></span>
                                        @enderror
                                        <p> Upload foto baru untuk mengubah gambar</p>
                                        <img width="50%" src="{{ url('uploads/images/gambar-header-event/') }}/{{ $edit->gambar_header }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">
                                        Jadwal <br>
                                    </label>
                                    
                                    <div class="col-xl-5 col-lg-4 col-sm-5">
                                        <input type="text" class="form-control" id="dateTimeFlatpickr" name="tanggal_mulai" value="{{ old('tanggal_mulai',date("d-m-Y",strtotime($edit->tanggal_mulai))) }}" placeholder="Masukan Tanggal Mulai">
                                        @error('tanggal_mulai')
                                            <span><code>{{$message}}</code></span>
                                        @enderror
                                    </div>
                                    <div class="col-xl-5 col-lg-4 col-sm-5">
                                        <input type="text" class="form-control" id="dateTimeFlatpickr2" name="tanggal_selesai" value="{{ old('tanggal_selesai',date("d-m-Y",strtotime($edit->tanggal_selesai))) }}" placeholder="Masukan Tanggal Selesai">
                                        @error('tanggal_selesai')
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
                                    <a class="btn btn-warning mt-3" href="{{ url('/dashboard/event') }}">
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