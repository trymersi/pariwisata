

<?php $__env->startSection('content'); ?>
<div class="row">
    <div id="flStackForm" class="col-md-8 layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>
                            Form Setting Website <?php echo e($page_name); ?>

                        </h4>
                    </div>                                                                        
                </div>
            </div>
            
            <div class="widget-content widget-content-area">
                <form method="post" action="<?php echo e(url ('dashboard/pengaturan/update/'.$edit->id)); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?> <?php echo e(method_field('PATCH')); ?>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama Website</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" name="nama_website" value="<?php echo e(old('nama_website',$edit->nama_website)); ?>" placeholder="Masukan nama website">
                            <?php $__errorArgs = ['nama_website'];
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
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Keterangan Website</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <textarea class="form-control" name="keterangan_website" rows="3"><?php echo e(old('keterangan_website',$edit->keterangan_website)); ?></textarea>
                            <?php $__errorArgs = ['keterangan_website'];
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
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Alamat Kantor</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <textarea class="form-control" name="alamat_kantor" rows="3"><?php echo e(old('alamat_kantor',$edit->alamat_kantor)); ?></textarea>
                            <?php $__errorArgs = ['alamat_kantor'];
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
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">icon</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="file" class="form-control-file" name="icon" value="<?php echo e(old('icon')); ?>"  accept="image/jpg,image/jpeg,image/png">
                            <?php $__errorArgs = ['icon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span><code><?php echo e($message); ?></code></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p> Upload gambar baru untuk mengubah</p>
                            <img width="150px" src="<?php echo e(url('uploads/images/setting/')); ?>/<?php echo e($edit->icon); ?>">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Email Website</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="email" class="form-control" name="email_website" value="<?php echo e(old('email_website',$edit->email)); ?>" placeholder="Masukan Email website">
                            <?php $__errorArgs = ['nama_website'];
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
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nomor Telepon</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="notel" class="form-control" name="notel" value="<?php echo e(old('notel',$edit->notel)); ?>" placeholder="Masukan Nomor Telepon Kantor">
                            <?php $__errorArgs = ['nama_website'];
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
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Logo Website</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="file" class="form-control-file" name="logo_website" value="<?php echo e(old('logo_website')); ?>"  accept="image/jpg,image/jpeg,image/png">
                            <?php $__errorArgs = ['logo_website'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span><code><?php echo e($message); ?></code></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p> Upload gambar baru untuk mengubah</p>
                            <img width="150px" src="<?php echo e(url('uploads/images/setting/')); ?>/<?php echo e($edit->logo_website); ?>">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Gambar Login</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="file" class="form-control-file" name="gambar_login" value="<?php echo e(old('gambar_login')); ?>"  accept="image/jpg,image/jpeg,image/png">
                            <?php $__errorArgs = ['gambar_login'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span><code><?php echo e($message); ?></code></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p> Upload gambar baru untuk mengubah</p>
                            <img width="150px" src="<?php echo e(url('uploads/images/setting/')); ?>/<?php echo e($edit->gambar_login); ?>">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Video Promosi</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" name="video_promo" value="<?php echo e(old('video_promo',$edit->video_promosi)); ?>" placeholder="Masukan Link promosi destinasi riau">
                            <?php $__errorArgs = ['video_promo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span><code><?php echo e($message); ?></code></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p> Url / Link dari situs youtube</p>
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
                    <h3>Gambar Slider</h3>
                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Gambar Slider Utama</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="file" class="form-control-file" name="slider_gambar_utama" value="<?php echo e(old('slider_gambar_utama')); ?>"  accept="image/jpg,image/jpeg,image/png">
                            <?php $__errorArgs = ['slider_gambar_utama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span><code><?php echo e($message); ?></code></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p> Upload gambar baru untuk mengubah</p>
                            <img width="150px" src="<?php echo e(url('uploads/images/setting/')); ?>/<?php echo e($edit->slider_gambar_utama); ?>">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Gambar Slider Objek Wisata</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="file" class="form-control-file" name="slider_gambar_objek_wisata" value="<?php echo e(old('slider_gambar_objek_wisata')); ?>"  accept="image/jpg,image/jpeg,image/png">
                            <?php $__errorArgs = ['slider_gambar_objek_wisata'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span><code><?php echo e($message); ?></code></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p> Upload gambar baru untuk mengubah</p>
                            <img width="150px" src="<?php echo e(url('uploads/images/setting/')); ?>/<?php echo e($edit->slider_gambar_objek_wisata); ?>">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Gambar Slider Event</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="file" class="form-control-file" name="slider_gambar_event" value="<?php echo e(old('slider_gambar_event')); ?>"  accept="image/jpg,image/jpeg,image/png">
                            <?php $__errorArgs = ['slider_gambar_event'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span><code><?php echo e($message); ?></code></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p> Upload gambar baru untuk mengubah</p>
                            <img width="150px" src="<?php echo e(url('uploads/images/setting/')); ?>/<?php echo e($edit->slider_gambar_event); ?>">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Gambar Slider Restoran</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="file" class="form-control-file" name="slider_gambar_restoran" value="<?php echo e(old('slider_gambar_restoran')); ?>"  accept="image/jpg,image/jpeg,image/png">
                            <?php $__errorArgs = ['slider_gambar_restoran'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span><code><?php echo e($message); ?></code></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p> Upload gambar baru untuk mengubah</p>
                            <img width="150px" src="<?php echo e(url('uploads/images/setting/')); ?>/<?php echo e($edit->slider_gambar_restoran); ?>">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Gambar Slider Hotel</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="file" class="form-control-file" name="slider_gambar_hotel" value="<?php echo e(old('slider_gambar_hotel')); ?>"  accept="image/jpg,image/jpeg,image/png">
                            <?php $__errorArgs = ['slider_gambar_hotel'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span><code><?php echo e($message); ?></code></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p> Upload gambar baru untuk mengubah</p>
                            <img width="150px" src="<?php echo e(url('uploads/images/setting/')); ?>/<?php echo e($edit->slider_gambar_hotel); ?>">
                        </div>
                    </div>

                    <h3>Gambar Promosi</h3>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Gambar Promosi 1</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="file" class="form-control-file" name="gambar_promosi_satu" value="<?php echo e(old('gambar_promosi_satu')); ?>"  accept="image/jpg,image/jpeg,image/png">
                            <?php $__errorArgs = ['gambar_promosi_satu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span><code><?php echo e($message); ?></code></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p> Upload gambar baru untuk mengubah</p>
                            <img width="150px" src="<?php echo e(url('uploads/images/setting/')); ?>/<?php echo e($edit->gambar_promosi_satu); ?>">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Gambar Promosi 2</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="file" class="form-control-file" name="gambar_promosi_dua" value="<?php echo e(old('gambar_promosi_dua')); ?>"  accept="image/jpg,image/jpeg,image/png">
                            <?php $__errorArgs = ['gambar_promosi_dua'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span><code><?php echo e($message); ?></code></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p> Upload gambar baru untuk mengubah</p>
                            <img width="150px" src="<?php echo e(url('uploads/images/setting/')); ?>/<?php echo e($edit->gambar_promosi_dua); ?>">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <a class="btn btn-warning mt-3" href="<?php echo e(url('/dashboard')); ?>">
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
                        <li>form untuk mengubah keterangan website</li>
                    </div>                                                                        
                </div>
            </div>

            <div class="widget-content widget-content-area">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Map</h4>
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
            
            <?php if(old('kabupaten')): ?>
                    $('#kecamatan').select2({
                        ajax: {
                            url:"<?php echo e(url('dashboard/objek-wisata/list-kecamatan')); ?>/" + <?php echo e(old('kabupaten')); ?>,
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
<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\project\coding\pariwisata2\resources\views/dashboard/pages/setting/update.blade.php ENDPATH**/ ?>