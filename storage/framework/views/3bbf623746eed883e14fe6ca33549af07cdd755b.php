

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
                                    Form Tambah Data <?php echo e($page_name); ?>

                                </h4>
                            </div>                                                                        
                        </div>
                    </div>
                    
                    <div class="widget-content widget-content-area">
                        <form method="post" action="<?php echo e(action('Backend\KategoriEkrafController@store')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group row mb-4">
                                <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama Kategori</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <input type="text" class="form-control" name="nama_kategori" value="<?php echo e(old('nama_kategori')); ?>" placeholder="Masukan data nama kategori">
                                    <?php $__errorArgs = ['nama_kategori'];
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
                                <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Gambar Kategori</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <input type="file" class="form-control-file" name="gambar_kategori" value="<?php echo e(old('gambar_kategori')); ?>" placeholder="Masukan gambar kategori" accept="image/jpg,image/jpeg,image/png">
                                    <?php $__errorArgs = ['gambar_kategori'];
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
                                <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Deskripsi Lengkap</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <textarea id="summernote" name="deskripsi_lengkap"><?php echo old('deskripsi_lengkap'); ?></textarea>
                                    <?php $__errorArgs = ['deskripsi_lengkap'];
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
                                <div class="col-sm-10">
                                    <a class="btn btn-warning mt-3" href="<?php echo e(url('/dashboard/kategori-ekraf')); ?>">
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
    <link href="<?php echo e(asset('plugins/summernote/dist/summernote.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>
<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('plugins/summernote/dist/summernote.min.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Masukan deskripsi lengkap disini, anda juga dapat memasukan gambar pada bagian text',
                height: 350
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\project\coding\pariwisata2\resources\views/dashboard/pages/kategori-ekraf/create.blade.php ENDPATH**/ ?>