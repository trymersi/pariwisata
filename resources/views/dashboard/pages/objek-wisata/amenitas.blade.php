@extends('dashboard.layouts.app')

@section('content')
<div class="row">
    <div id="flStackForm" class="col-md-8 layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>
                            Form Tambah Data Amenitas {{ $page_name }} {{ $nama_objek_wisata }}
                        </h4>
                    </div>                                                                        
                </div>
            </div>
            
            <div class="widget-content widget-content-area">
                @if(isset($edit->id))
                <form method="post" action="{{ url ('dashboard/objek-wisata/amenitas/update/'.$edit->id) }}" enctype="multipart/form-data">
                    @csrf {{ method_field('PATCH') }}
                    <input type="text" hidden name="id_edit" value="{{ $edit->id }}">
                @else
                <form method="post" action="{{ url('dashboard/objek-wisata/amenitas/store') }}" enctype="multipart/form-data">
                    @csrf
                @endif

                    <input type="text" hidden name="objek_wisata_id" value="{{ $objek_wisata_id }}">

                    <h5>Sarana Penunjang</h5>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-4 col-sm-6 col-sm-4 col-form-label">Tempat Parkir</label>
                        <div class="col-xl-8 col-lg-6 col-sm-8">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input value="1" type="radio" @if(isset($edit->tempat_parkir) && $edit->tempat_parkir == 1) checked="checked" @endif id="tempat_parkir1" name="tempat_parkir" class="custom-control-input">
                                <label class="custom-control-label" for="tempat_parkir1">Tersedia</label>
                                </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input value="0" type="radio" @if(isset($edit->tempat_parkir) && $edit->tempat_parkir == 0) checked="checked" @endif id="tempat_parkir2" name="tempat_parkir" class="custom-control-input">
                                <label class="custom-control-label" for="tempat_parkir2">Tidak Tersedia</label>
                            </div>
                            @error('tempat_parkir')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-4 col-sm-6 col-sm-4 col-form-label">Fasilitas Kesehatan</label>
                        <div class="col-xl-8 col-lg-6 col-sm-8">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input value="1" type="radio" @if(isset($edit->fasilitas_kesehatan) && $edit->fasilitas_kesehatan == 1) checked="checked" @endif id="fasilitas_kesehatan1" name="fasilitas_kesehatan" class="custom-control-input">
                                <label class="custom-control-label" for="fasilitas_kesehatan1">Tersedia</label>
                                </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input value="0" type="radio" @if(isset($edit->fasilitas_kesehatan) && $edit->fasilitas_kesehatan == 0) checked="checked" @endif id="fasilitas_kesehatan2" name="fasilitas_kesehatan" class="custom-control-input">
                                <label class="custom-control-label" for="fasilitas_kesehatan2">Tidak Tersedia</label>
                            </div>
                            @error('fasilitas_kesehatan')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-4 col-sm-6 col-sm-4 col-form-label">Fasilitas Perbelanjaan</label>
                        <div class="col-xl-8 col-lg-6 col-sm-8">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input value="1" type="radio" @if(isset($edit->fasilitas_perbelanjaan) && $edit->fasilitas_perbelanjaan == 1) checked="checked" @endif id="fasilitas_perbelanjaan1" name="fasilitas_perbelanjaan" class="custom-control-input">
                                <label class="custom-control-label" for="fasilitas_perbelanjaan1">Tersedia</label>
                                </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input value="0" type="radio"  @if(isset($edit->fasilitas_perbelanjaan) && $edit->fasilitas_perbelanjaan == 0) checked="checked" @endif id="fasilitas_perbelanjaan2" name="fasilitas_perbelanjaan" class="custom-control-input">
                                <label class="custom-control-label" for="fasilitas_perbelanjaan2">Tidak Tersedia</label>
                            </div>
                            @error('fasilitas_perbelanjaan')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-4 col-sm-6 col-sm-4 col-form-label">Listrik</label>
                        <div class="col-xl-8 col-lg-6 col-sm-8">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input value="1" type="radio"  @if(isset($edit->listrik) && $edit->listrik == 1) checked="checked" @endif id="listrik1" name="listrik" class="custom-control-input">
                                <label class="custom-control-label" for="listrik1">Tersedia</label>
                                </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input value="0" type="radio" @if(isset($edit->listrik) && $edit->listrik == 0) checked="checked" @endif id="listrik2" name="listrik" class="custom-control-input">
                                <label class="custom-control-label" for="listrik2">Tidak Tersedia</label>
                            </div>
                            @error('listrik')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-4 col-sm-6 col-sm-4 col-form-label">Sinyal Provider</label>
                        <div class="col-xl-8 col-lg-6 col-sm-8">
                            <select name="sinyal_provider[]" class="form-control select" multiple="multiple">
                                <option value="">Pilih Internet Provider</option>
                                <option @if(old('sinyal_provider.0') || in_array('Telkomsel',$provider)) selected="" @endif value="Telkomsel">Telkomsel</option>
                                <option @if(old('sinyal_provider.1') || in_array('XL Axiata',$provider)) selected="" @endif value="XL Axiata">XL Axiata</option>
                                <option @if(old('sinyal_provider.2') || in_array('Indosat',$provider)) selected="" @endif value="Indosat">Indosat</option>
                                <option @if(old('sinyal_provider.3') || in_array('3 Tri',$provider)) selected="" @endif value="3 Tri">3 Tri</option>
                                <option @if(old('sinyal_provider.4') || in_array('Axis',$provider)) selected="" @endif value="Axis">Axis</option>
                                <option @if(old('sinyal_provider.5') || in_array('Smartfren',$provider)) selected="" @endif value="Smartfren">Smartfren</option>
                            </select>
                            <p>Anda dapat memilih lebih dari satu</p>
                            @error('sinyal_provider')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>
                    <h5>Sarana Pendukung</h5>
                    <div class="form-group row mb-4">
                        <label  class="col-xl-4 col-sm-6 col-sm-4 col-form-label">Street Furniture</label>
                        <div class="col-xl-8 col-lg-6 col-sm-8">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input value="1" type="radio" @if(isset($edit->street_furniture) && $edit->street_furniture == 1) checked="checked" @endif id="street_furniture1" name="street_furniture" class="custom-control-input">
                                <label class="custom-control-label" for="street_furniture1">Tersedia</label>
                                </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input value="0" type="radio" @if(isset($edit->street_furniture) && $edit->street_furniture == 0) checked="checked" @endif id="street_furniture2" name="street_furniture" class="custom-control-input">
                                <label class="custom-control-label" for="street_furniture2">Tidak Tersedia</label>
                            </div>
                            @error('street_furniture')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-4 col-sm-6 col-sm-4 col-form-label">Bengkel</label>
                        <div class="col-xl-8 col-lg-6 col-sm-8">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input value="1" type="radio" @if(isset($edit->bengkel) && $edit->bengkel == 1) checked="checked" @endif id="bengkel1" name="bengkel" class="custom-control-input">
                                <label class="custom-control-label" for="bengkel1">Tersedia</label>
                                </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input value="0" type="radio" @if(isset($edit->bengkel) && $edit->bengkel == 0) checked="checked" @endif id="bengkel2" name="bengkel" class="custom-control-input">
                                <label class="custom-control-label" for="bengkel2">Tidak Tersedia</label>
                            </div>
                            @error('bengkel')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-4 col-sm-6 col-sm-4 col-form-label">Money Changer</label>
                        <div class="col-xl-8 col-lg-6 col-sm-8">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input value="1" type="radio" @if(isset($edit->money_changer) && $edit->money_changer == 1) checked="checked" @endif id="money_changer1" name="money_changer" class="custom-control-input">
                                <label class="custom-control-label" for="money_changer1">Tersedia</label>
                                </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input value="0" type="radio" @if(isset($edit->money_changer) && $edit->money_changer == 0) checked="checked" @endif id="money_changer2" name="money_changer" class="custom-control-input">
                                <label class="custom-control-label" for="money_changer2">Tidak Tersedia</label>
                            </div>
                            @error('money_changer')
                                <span><code>{{$message}}</code></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-4 col-sm-6 col-sm-4 col-form-label">Tempat Sewa Kendaraan</label>
                        <div class="col-xl-8 col-lg-6 col-sm-8">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input value="1" type="radio" @if(isset($edit->tempat_sewa_kendaraan) && $edit->tempat_sewa_kendaraan == 1) checked="checked" @endif id="tempat_sewa_kendaraan1" name="tempat_sewa_kendaraan" class="custom-control-input">
                                <label class="custom-control-label" for="tempat_sewa_kendaraan1">Tersedia</label>
                                </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input value="0" type="radio" @if(isset($edit->tempat_sewa_kendaraan) && $edit->tempat_sewa_kendaraan == 0) checked="checked" @endif id="tempat_sewa_kendaraan2" name="tempat_sewa_kendaraan" class="custom-control-input">
                                <label class="custom-control-label" for="tempat_sewa_kendaraan2">Tidak Tersedia</label>
                            </div>
                            @error('tempat_sewa_kendaraan')
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
                        <h4>Form Tambah Data Amenitas {{ $page_name }} {{ $nama_objek_wisata }}</h4>
                        <li>Form untuk memberikan informasi fasilitas yang tersedia di {{ $page_name }} {{ $nama_objek_wisata }}</li>
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