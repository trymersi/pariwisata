

<?php $__env->startSection('content'); ?>
<div class="row">
    <div id="flStackForm" class="col-md-8 layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>
                            Form Tambah Data <?php echo e($page_name); ?>

                        </h4>
                    </div>                                                                        
                </div>
            </div>
            
            <div class="widget-content widget-content-area">
                <form method="post" action="<?php echo e(url ('dashboard/objek-wisata/update/'.$edit->id)); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?> <?php echo e(method_field('PATCH')); ?>


                    <?php if(Auth::user()->level == 1 || Auth::user()->level == 3): ?>
                        <div class="form-group row mb-4">
                            <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Kabupaten</label>
                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                <select name="kabupaten"  id="kabupaten" class="form-control select">
                                    <option selected="selected" value="">Pilih Kabupaten</option>
                                    <?php $__currentLoopData = $kabupaten; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php if(old('kabupaten',$edit->kabupaten_id) == $kab->id): ?> selected="" <?php endif; ?> value="<?php echo e($kab->id); ?>"><?php echo e($kab->nama); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['kabupaten'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span><code><?php echo e($message); ?></code></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Kecamatan</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <select name="kecamatan"  id="kecamatan" class="form-control select">
                                <option selected="selected" value="">Pilih Kecamatan</option>
                                <?php $__currentLoopData = $kecamatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if(old('kabupaten',$edit->kecamatan_id) == $kec->id): ?> selected="" <?php endif; ?> value="<?php echo e($kec->id); ?>"><?php echo e($kec->text); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['kecamatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span><code><?php echo e($message); ?></code></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Desa</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" name="desa" value="<?php echo e(old('desa',$edit->desa)); ?>" placeholder="Masukan nama desa lokasi objek wisata">
                            <?php $__errorArgs = ['desa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span><code><?php echo e($message); ?></code></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama Objek Wisata</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" name="nama" value="<?php echo e(old('nama',$edit->nama)); ?>" placeholder="Masukan nama objek wisata">
                            <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span><code><?php echo e($message); ?></code></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Alamat Objek Wisata</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" name="alamat" value="<?php echo e(old('alamat',$edit->alamat)); ?>" placeholder="Masukan alamat objek wisata">
                            <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span><code><?php echo e($message); ?></code></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Jenis Wisata</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <select name="jenis[]" class="form-control select" multiple="multiple">
                                <option value="">Pilih Jenis Wisata</option>
                                <option <?php if(old('jenis.0') || in_array(1,$jenis)): ?> selected="" <?php endif; ?> value="1">Alam</option>
                                <option <?php if(old('jenis.1') || in_array(2,$jenis)): ?> selected="" <?php endif; ?> value="2">Buatan</option>
                                <option <?php if(old('jenis.2') || in_array(3,$jenis)): ?> selected="" <?php endif; ?> value="3">Budaya</option>
                            </select>
                            <?php $__errorArgs = ['jenis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span><code><?php echo e($message); ?></code></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Gambar Header</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="file" class="form-control-file" name="gambar_header" value="<?php echo e(old('gambar_header')); ?>" placeholder="Masukan Foto" accept="image/jpg,image/jpeg,image/png">
                            <?php $__errorArgs = ['gambar_header'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span><code><?php echo e($message); ?></code></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p> Upload foto baru untuk mengubah gambar header</p>
                                <img width="150px" src="<?php echo e(url('uploads/images/gambar-header-objek-wisata/')); ?>/<?php echo e($edit->gambar_header); ?>">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Video Promosi</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" name="video_promosi" value="<?php echo e(old('video_promosi',$edit->video_promosi)); ?>" placeholder="Masukan url video dari youtube">
                            <?php $__errorArgs = ['video_promosi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span><code><?php echo e($message); ?></code></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">
                            Lokasi <br>
                            <a id="button-cari" class="btn btn-success mt-3">
                                Cari Lokasi 
                                <svg id="loading-cari" class="spinner-border d-none"></svg>
                                <svg id="icon-cari" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
                                <svg id="icon-selesai" class="d-none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            </a>
                        </label>
                        
                        <div class="col-xl-5 col-lg-4 col-sm-5">
                            <input type="text" class="form-control" id="latitude" name="latitude" value="<?php echo e(old('latitude',$edit->latitude)); ?>" placeholder="Masukan Latitude">
                            <code class="map-error"></code>
                            <?php $__errorArgs = ['latitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span><code><?php echo e($message); ?></code></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-xl-5 col-lg-4 col-sm-5">
                            <input type="text" class="form-control" id="longitude" name="longitude" value="<?php echo e(old('longitude',$edit->longitude)); ?>" placeholder="Masukan Longitude">
                            <?php $__errorArgs = ['longitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span><code><?php echo e($message); ?></code></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <textarea id="summernote" name="deskripsi"><?php echo old('deskripsi',$edit->deskripsi); ?></textarea>
                            <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span><code><?php echo e($message); ?></code></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>   
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2">Objek Wisata Pilihan</div>
                        <div class="col-sm-10">
                            <div class="form-check pl-0">
                                <div class="custom-control custom-checkbox checkbox-info">
                                    <input type="checkbox" name="pilihan" <?php if($edit->pilihan == 1): ?> checked="checked" <?php endif; ?> class="custom-control-input" id="pilihan">
                                    <label class="custom-control-label" for="pilihan">Apakah Objek Wisata ini ditampilkan pada slide aplikasi ?</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if(Auth::user()->level == 1 || Auth::user()->level == 2): ?>
                        <div class="form-group row mb-4">
                            <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Status</label>
                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                <select name="status" class="form-control select">
                                    <option selected="selected" value="">Pilih Status</option>
                                    <option <?php if(old('status',$edit->status) == 1): ?> selected="" <?php endif; ?> value="1">Diusulkan</option>
                                    <option <?php if(old('status',$edit->status) == 2): ?> selected="" <?php endif; ?> value="2">Pending</option>
                                    <option <?php if(old('status',$edit->status) == 3): ?> selected="" <?php endif; ?> value="3">Aktif</option>
                                    <option <?php if(old('status',$edit->status) == 4): ?> selected="" <?php endif; ?> value="4">Tolak</option>
                                </select>
                                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span><code><?php echo e($message); ?></code></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="form-group row">
                        <div class="col-sm-2">Setuju</div>
                        <div class="col-sm-10">
                            <div class="form-check pl-0">
                                <div class="custom-control custom-checkbox checkbox-info">
                                    <input type="checkbox" name="tos" class="custom-control-input" id="hChkbox">
                                    <label class="custom-control-label" for="hChkbox">Term & Condition (<a href="#" class="text muted badge badge-primary" data-toggle="modal" data-target="#modaltos">klik disini untuk membaca</a>)</label>
                                </div>
                                <?php $__errorArgs = ['tos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span><code>Harap centang term and condition untuk menyimpan data !</code></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <a class="btn btn-warning mt-3" href="<?php echo e(url('/dashboard/objek-wisata')); ?>">
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
                        <h4>Form Tambah Data <?php echo e($page_name); ?></h4>
                        <li>Masukan data detail objek wisata untuk ditambahkan</li>
                        <div id="map"></div>
                    </div>                                                                        
                </div>
            </div>
            
        </div>
    </div>
</div> 
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <script
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(apiMap()); ?>&callback=initMap"
    defer
    ></script>
    <link href="<?php echo e(asset('plugins/select2/select2.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('plugins/summernote/dist/summernote.css')); ?>" rel="stylesheet" />
    <style>
        #map {
            height: 350px;
        }
        </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('js'); ?>
    
    <script src="<?php echo e(asset('plugins/summernote/dist/summernote.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/select2/select2.min.js')); ?>"></script>
    <script>
        
        let map
        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: <?php echo e($edit->latitude); ?>, lng: <?php echo e($edit->longitude); ?> },
                zoom: 15,
            });
            var marker = new google.maps.Marker({position: { lat: <?php echo e($edit->latitude); ?>, lng: <?php echo e($edit->longitude); ?> }, map: map});
        }

        function changeMap(lat,long)
        {
            var data = {lat: +lat , lng: +long};
            console.log(data)
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 15, center: data}
            );
            var marker = new google.maps.Marker({position: data, map: map});
        }

        $(document).ready(function() {
            initMap()
            
            $("#longitude").keyup(function()
            {
                console.log($("#longitude").val())
                if($("#latitude").val() != '')
                {
                    changeMap($("#latitude").val(),$("#longitude").val())
                }
            })

            $("#latitude").keyup(function()
            {
                console.log($("#latitude").val())
                if($("#longitude").val() != '')
                {
                    changeMap($("#latitude").val(),$("#longitude").val())
                }
            })

            $('#summernote').summernote({
                placeholder: 'Masukan keterangan lengkap disini, anda juga dapat memasukan gambar pada bagian text',
                height: 350
            });

            $(".select").select2({
                tags: true,
            });

            $("#button-cari").on('click',function()
            {
                $("#loading-cari").removeClass('d-none');
                $("#icon-cari").addClass('d-none');
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else { 
                    $(".map-error").html("Mohon maaf browser tidak support, harap masukan lokasi manual");
                }
                function showPosition(position) 
                {
                    setTimeout(function(){ 
                        $('#map').removeClass('d-none');
                        changeMap(position.coords.latitude,position.coords.longitude)
                        
                        $("#latitude").val(position.coords.latitude);
                        $("#longitude").val(position.coords.longitude);
                        $("#icon-selesai").removeClass('d-none');
                        $("#loading-cari").addClass('d-none'); 
                    }, 1000);
                    
                }
            })
            
            <?php if(Auth::user()->level == 7): ?>
                $('#kecamatan').select2({
                    ajax: {
                        url:"<?php echo e(url('dashboard/objek-wisata/list-kecamatan')); ?>/" + <?php echo e(Auth::user()->kabupaten_id); ?>,
                        processResults: function (data) {
                            return {
                                results: data
                            };
                        }
                    }
                });
            <?php endif; ?>
            
            <?php if(old('kabupaten',$edit->kabupaten_id)): ?>
                    $('#kecamatan').select2({
                        ajax: {
                            url:"<?php echo e(url('dashboard/objek-wisata/list-kecamatan')); ?>/" + <?php echo e(old('kabupaten',$edit->kabupaten_id)); ?>,
                            processResults: function (data) {
                                return {
                                    results: data
                                };
                            }
                        }
                    });
            <?php endif; ?>
           
            $('#kabupaten').on('change',function()
            {
                var id_kabupaten = $(this).val();

                $('#kecamatan').select2({
                   
                    placeholder: "Pilih Kecamatan",
                    ajax: {
                        url:"<?php echo e(url('dashboard/objek-wisata/list-kecamatan')); ?>/" + id_kabupaten,
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
     
<?php $__env->stopPush(); ?>
<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\project\coding\pariwisata2\resources\views/dashboard/pages/objek-wisata/edit.blade.php ENDPATH**/ ?>