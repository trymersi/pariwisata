@extends('dashboard.layouts.app')

@section('content')
<div class="row">
    <div id="flStackForm" class="col-md-8 layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>
                            Form Tambah Penyedia/Penjual {{ $page_name }} {{ $sub_page }}
                        </h4>
                    </div>                                                                        
                </div>
            </div>
            
            <div class="widget-content widget-content-area">
                <form method="post" action="{{ url('dashboard/cindramata/penyedia/store') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="text" hidden name="id" value="{{ $id }}">

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama Penyedia/Penjual</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <select name="penyedia[]"  id="hotel" multiple="multiple" class="form-control select">
                                
                                @foreach($penyedia as $item)
                                    <option @if(old('penyedia') == $item->id) selected="" @endif value="{{ $item->id }}">{{ $item->nama_kabupaten }} - {{ $item->nama_kategori }} - {{ $item->jenis_usaha }} - {{ $item->nama_pelaku }}</option>
                                @endforeach
                            </select>
                            @error('penyedia')
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
                            <a class="btn btn-warning mt-3" href="{{ url('/dashboard/objek-wisata/sosial-media') }}/{{ $id }}">
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
                        <h4> Form Tambah Tempat Ibadah Terdekat {{ $page_name }} {{ $sub_page }}</h4>
                        <li>Pastikan longitude dan latitude objek wisata maupun Tempat Ibadah sudah diisi</li>
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
        });
  
    </script>
     
@endpush