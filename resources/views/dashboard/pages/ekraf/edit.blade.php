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
                                    Form Tambah Data {{ $page_name }}
                                </h4>
                            </div>                                                                        
                        </div>
                    </div>
                    
                    <div class="widget-content widget-content-area">
                        <form method="post" action="{{ url ('dashboard/ekraf/update/'.$edit->id) }}" enctype="multipart/form-data">
                            @csrf {{ method_field('PATCH') }}

                            @if(Auth::user()->level == 1 || Auth::user()->level == 3)
                                <div class="form-group row mb-4">
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Kabupaten</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <select name="kabupaten" class="form-control select">
                                            <option selected="selected" value="">Pilih Kabupaten</option>
                                            @foreach($kabupaten as $kab)
                                                <option @if(old('kabupaten',$edit->kabupaten_id) == $kab->id) selected="" @endif value="{{ $kab->id }}">{{ $kab->nama_kabupaten }}</option>
                                            @endforeach
                                        </select>
                                        @error('kabupaten')
                                            <span><code>{{$message}}</code></span>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row mb-4">
                                <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Kategori Ekraf</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <select name="kategori_ekraf" class="form-control select">
                                        <option selected="selected" value="">Pilih Kategori</option>
                                        @foreach($kategori as $kat)
                                            <option @if(old('kategori_ekraf',$edit->kategori_ekraf_id) == $kat->id) selected="" @endif value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori_ekraf')
                                        <span><code>{{$message}}</code></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama Pelaku Usaha</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <input type="text" class="form-control" name="pelaku_usaha" value="{{ old('pelaku_usaha',$edit->nama) }}" placeholder="Masukan data nama palaku usaha">
                                    @error('pelaku_usaha')
                                        <span><code>{{$message}}</code></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Alamat Pelaku Usaha</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <input type="text" class="form-control" name="alamat" value="{{ old('alamat',$edit->alamat) }}" placeholder="Masukan data alamat pelaku usaha">
                                    @error('alamat')
                                        <span><code>{{$message}}</code></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nomor Kontak</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <input type="number" class="form-control" name="nomor_kontak" value="{{ old('nomor_kontak',$edit->nomor_kontak) }}" placeholder="Masukan nomor telepon / hp">
                                    @error('nomor_kontak')
                                        <span><code>{{$message}}</code></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Jenis Usaha</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <input type="text" class="form-control" name="jenis_usaha" value="{{ old('jenis_usaha',$edit->jenis_usaha) }}" placeholder="Masukan jenis usaha">
                                    @error('jenis_usaha')
                                        <span><code>{{$message}}</code></span>
                                    @enderror
                                </div>
                            </div>

                            @if(Auth::user()->level == 1 || Auth::user()->level == 3)
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
                                <div class="col-sm-10">
                                    <a class="btn btn-warning mt-3" href="{{ url('/dashboard/ekraf') }}">
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