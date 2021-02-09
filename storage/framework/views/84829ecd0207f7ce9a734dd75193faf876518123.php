

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="container">
        
        <div class="row">
            <div id="flStackForm" class="col-lg-12 layout-spacing layout-top-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">                                
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>
                                    Form Edit Data <?php echo e($page_name); ?> <?php echo e($edit->nama_kategori); ?>

                                </h4>
                            </div>                                                                        
                        </div>
                    </div>
                    
                    <div class="widget-content widget-content-area">
                        <form method="post" action="<?php echo e(url ('dashboard/event/update/'.$edit->id)); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?> <?php echo e(method_field('PATCH')); ?>


                            <?php if(Auth::user()->level != 7): ?>
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
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama Objek Wisata</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <select name="objek_wisata"  id="objek_wisata" class="form-control select">
                                            <option selected="selected" value="">Pilih Objek Wisata</option>
                                            <?php $__currentLoopData = $objek_wisata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $objek): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(old('objek_wisata',$edit->objek_wisata_id) == $objek->id): ?> selected="" <?php endif; ?> value="<?php echo e($objek->id); ?>"><?php echo e($objek->text); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['objek_wisata'];
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
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama Event</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" class="form-control" name="nama_event" value="<?php echo e(old('nama_event',$edit->nama)); ?>" placeholder="Masukan Nama Event">
                                        <?php $__errorArgs = ['nama_event'];
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
                                        <p> Upload foto baru untuk mengubah gambar</p>
                                        <img width="50%" src="<?php echo e(url('uploads/images/gambar-header-event/')); ?>/<?php echo e($edit->gambar_header); ?>">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">
                                        Jadwal <br>
                                    </label>
                                    
                                    <div class="col-xl-5 col-lg-4 col-sm-5">
                                        <input type="text" class="form-control" id="dateTimeFlatpickr" name="tanggal_mulai" value="<?php echo e(old('tanggal_mulai',date("d-m-Y",strtotime($edit->tanggal_mulai)))); ?>" placeholder="Masukan Tanggal Mulai">
                                        <?php $__errorArgs = ['tanggal_mulai'];
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
                                        <input type="text" class="form-control" id="dateTimeFlatpickr2" name="tanggal_selesai" value="<?php echo e(old('tanggal_selesai',date("d-m-Y",strtotime($edit->tanggal_selesai)))); ?>" placeholder="Masukan Tanggal Selesai">
                                        <?php $__errorArgs = ['tanggal_selesai'];
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

                                <?php if(Auth::user()->level == 1 || Auth::user()->level == 4): ?>
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
                                    <a class="btn btn-warning mt-3" href="<?php echo e(url('/dashboard/event')); ?>">
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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <link href="<?php echo e(asset('plugins/select2/select2.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('plugins/flatpickr/flatpickr.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>
<?php $__env->startPush('js'); ?>
    
    <script src="<?php echo e(asset('plugins/flatpickr/flatpickr.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/select2/select2.min.js')); ?>"></script>
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

            
            <?php if(Auth::user()->level == 7): ?>
                $('#objek_wisata').select2({
                    placeholder: "Pilih Objek Wisata",
                    ajax: {
                        url:"<?php echo e(url('dashboard/restaurant/list-objek-wisata')); ?>/" + <?php echo e(Auth::user()->kabupaten_id); ?>,
                        processResults: function (data) {
                            return {
                                results: data
                            };
                        }
                    }
                });
            <?php endif; ?>
            
            <?php if(old('kabupaten')): ?>
                    $('#objek_wisata').select2({
                        placeholder: "Pilih Objek Wisata",
                        ajax: {
                            url:"<?php echo e(url('dashboard/restaurant/list-objek-wisata')); ?>/" + <?php echo e(old('kabupaten')); ?>,
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

                $('#objek_wisata').select2({
                   
                    placeholder: "Pilih Objek Wisata",
                    ajax: {
                        url:"<?php echo e(url('dashboard/restaurant/list-objek-wisata')); ?>/" + id_kabupaten,
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
<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\project\coding\pariwisata2\resources\views/dashboard/pages/event/edit.blade.php ENDPATH**/ ?>