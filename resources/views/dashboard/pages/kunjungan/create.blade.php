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
                <form method="post" action="{{ action('Backend\KunjunganController@store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Objek Wisata</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <select name="objek_wisata"  id="objek_wisata" class="form-control select">
                                <option selected="selected" value="">Pilih Objek Wisata</option>
                                @foreach($objek as $item)
                                    <option @if(old('objek_wisata') == $item->id) selected="" @endif value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('objek_wisata')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Waktu</label>
                        <div class="col-xl-5 col-lg-4 col-sm-5">
                            <select name="bulan"  id="bulan" class="form-control select">
                                <option selected="selected" value="">Pilih Bulan</option>
                                @foreach(bulanIndo() as $item)
                                <option @if(old('bulan') == $item['nomor']) selected="" @endif value="{{ $item['nomor'] }}">{{ $item['nama_bulan'] }}</option>
                                @endforeach
                            </select>
                            @error('bulan')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                        <div class="col-xl-5 col-lg-4 col-sm-5">
                            <select name="tahun"  id="tahun" class="form-control select">
                                <option selected="selected" value="">Pilih Tahun</option>
                                @for($i = 2015;$i<=2025;$i++)
                                <option @if(old('tahun') == $i) selected="" @endif @if($i == date('Y')) selected="" @endif value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            @error('tahun')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Pengunjung Lokal</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="number" class="form-control" name="pengunjung_lokal" value="{{ old('pengunjung_lokal') }}" placeholder="Masukan jumlah pengunjung lokal">
                            @error('pengunjung_lokal')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Pengunjung Internasional</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="number" class="form-control" name="pengunjung_internasional" value="{{ old('pengunjung_internasional') }}" placeholder="Masukan jumlah pengunjung Internasional">
                            @error('pengunjung_internasional')
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
                            <a class="btn btn-warning mt-3" href="{{ url('/dashboard/kunjungan') }}">
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

            $(".select-objek").select2({
                tags: true,
            });
            
            @if(Auth::user()->level == 7)
                $('#objek').select2({
                    tags: true,
                    ajax: {
                        url:"{{url('dashboard/pemandu-wisata/objek-wisata')}}/" + {{ Auth::user()->kabupaten_id }},
                        processResults: function (data) {
                            return {
                                results: data
                            };
                        }
                    }
                });
            @endif
            
            @if(old('kabupaten'))
                    $('#objek').select2({
                        tags: true,
                        ajax: {
                            url:"{{url('dashboard/pemandu-wisata/objek-wisata')}}/" + {{ old('kabupaten') }},
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

                $('#objek').select2({
                   
                    placeholder: "Pilih Objek Wisata",
                    tags: true,
                    ajax: {
                        url:"{{url('dashboard/pemandu-wisata/objek-wisata')}}/" + id_kabupaten,
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