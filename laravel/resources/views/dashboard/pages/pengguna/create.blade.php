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
                        <form method="post" action="{{ action('Backend\PenggunaController@store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row mb-4">
                                <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" placeholder="Masukan Nama Lengkap">
                                    @error('nama')
                                        <span><code>{{$message}}</code></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4 ">
                                <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Email</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Masukan Data Email">
                                    @error('email')
                                        <span><code>{{$message}}</code></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Username</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Masukan Username">
                                    @error('username')
                                        <span><code>{{$message}}</code></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Password</label>
                                    <input type="password" class="form-control" value="{{old('password')}}" name="password" placeholder="Minimal 6 karakter" required="" aria-required="true">
                                    @error('password')
                                        <span><code>{{$message}}</code></span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Ulangi Password</label>
                                    <input type="password" class="form-control" value="{{old('password_confirmation')}}" name="password_confirmation" placeholder="Ulangi Password" required="" aria-required="true">
                                    @error('password_confirmation')
                                        <span><code>{{$message}}</code></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Level Admin</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <select name="level" class="form-control select level">
                                        <option selected="selected" value="">Pilih Level Admin</option>
                                        <option @if(old('level') == 1) selected="" @endif value="1">Superadmin</option>
                                        <option @if(old('level') == 2) selected="" @endif value="2">Admin Destinasi</option>
                                        <option @if(old('level') == 3) selected="" @endif value="3">Admin Ekraf</option>
                                        <option @if(old('level') == 4) selected="" @endif value="4">Admin SDP</option>
                                        <option @if(old('level') == 5) selected="" @endif value="5">Admin Pemasaran</option>
                                        <option @if(old('level') == 6) selected="" @endif value="6">Admin UPT</option>
                                        <option @if(old('level') == 7) selected="" @endif value="7">Admin Kabupaten</option>
                                    </select>
                                    @error('level')
                                        <span><code>{{$message}}</code></span>
                                    @enderror
                                </div>
                            </div>

                            <div id="kabupaten-div" class="form-group row mb-4 d-none">
                                <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Pilih Kabupaten</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <select id="kabupaten-select" name="kabupaten" class="form-control select">
                                        <option selected="selected"  value="">Pilih Nama Kabupaten</option>
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
                                <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Foto User</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <input type="file" class="form-control-file" name="foto" value="{{ old('foto') }}" placeholder="Masukan Foto" accept="image/jpg,image/jpeg,image/png">
                                    @error('foto')
                                        <span><code>{{$message}}</code></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-2">Status User</div>
                                <div class="col-sm-10">
                                    <div class="form-check pl-0">
                                        <div class="custom-control custom-checkbox checkbox-primary">
                                            <input type="checkbox" name="status" class="custom-control-input" id="status">
                                            <label class="custom-control-label" for="status">Aktifkan User ?</label>
                                            <small>Centang untuk mengaktifkan user</small>
                                        </div>
                                        @error('status')
                                        <span><code>{{$message}}</code></span>
                                        @enderror
                                    </div>
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
                                    <a class="btn btn-warning mt-3" href="{{ url('/dashboard/pengguna') }}">
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
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/file-upload/file-upload-with-preview.min.css')}}">
@endpush
@push('js')
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{asset('plugins/file-upload/file-upload-with-preview.min.js')}}"></script>
    <script>
        $( document ).ready(function() {
            $(".select").select2({
                tags: true,
            });

            $('.level').on('change',function()
            {
                if($(this).val() == 7)
                {
                    $('#kabupaten-div').removeClass('d-none');
                    $('#kabupaten-select').prop('required',true);
                }
                else
                {
                    $('#kabupaten-div').addClass('d-none');
                    $('#kabupaten-select').prop('required',false);
                }
            })
           
        });
    </script>
@endpush