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
                                    Form Edit Data {{ $page_name }} {{ $edit->nama_kecamatan }}
                                </h4>
                            </div>                                                                        
                        </div>
                    </div>
                    
                    <div class="widget-content widget-content-area">
                        <form method="post" action="{{ url ('dashboard/kecamatan/update/'.$edit->id) }}" enctype="multipart/form-data">
                            @csrf {{ method_field('PATCH') }}
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
                            <div class="form-group row mb-4">
                                <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama Kecamatan</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <input type="text" class="form-control" name="nama_kecamatan" value="{{ old('nama_kecamatan',$edit->nama) }}" placeholder="Masukan Data">
                                    @error('nama_kecamatan')
                                        <span><code>{{$message}}</code></span>
                                    @enderror
                                </div>
                                
                            </div>

                            <div class="form-group row mb-4">
                                <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Longitude</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <input type="text" class="form-control" name="longitude" value="{{ old('longitude',$edit->longitude) }}" placeholder="Masukan Longitude">
                                    @error('longitude')
                                        <span><code>{{$message}}</code></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Latitude</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <input type="text" class="form-control" name="latitude" value="{{ old('latitude',$edit->latitude) }}" placeholder="Masukan Latitude">
                                    @error('latitude')
                                        <span><code>{{$message}}</code></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="custom-file-container" data-upload-id="myFirstImage">
                                
                                <label>Foto kecamatan <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                <label class="custom-file-container__custom-file" >
                                    <input type="file" name="foto_kecamatan" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                   
                                </label>
                                @error('foto_kecamatan')
                                <span><code>{{$message}}</code></span>
                                @enderror
                                <div class="custom-file-container__image-preview"></div>
                                
                            </div>
                                       
                            <div class="form-group row mb-4">
                                <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Keterangan Lengkap</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <textarea id="summernote" name="keterangan_lengkap">{!! $edit->keterangan !!}</textarea>    
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
                                    <a class="btn btn-warning mt-3" href="{{ url('/dashboard/kecamatan') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                                        Batalkan
                                    </a>
                                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
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
    <link href="{{ asset('plugins/summernote/dist/summernote.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/file-upload/file-upload-with-preview.min.css')}}">
@endpush
@push('js')
    <script src="{{ asset('plugins/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{asset('plugins/file-upload/file-upload-with-preview.min.js')}}"></script>
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>

    <script>
        var firstUpload = new FileUploadWithPreview('myFirstImage',{
            presetFiles: [
                    "{{ $path }}/{{ $edit->gambar }}",
                ],
        })
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Masukan keterangan lengkap disini, anda juga dapat memasukan gambar pada bagian text',
                height: 350
            });
        });
        $(".select").select2({
                tags: true,
            });
    </script>
@endpush