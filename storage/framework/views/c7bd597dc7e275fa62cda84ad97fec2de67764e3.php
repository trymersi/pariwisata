

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
                            <form method="post" action="<?php echo e(action('Backend\PostController@store')); ?>" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php if(Auth::user()->level != 7): ?>
                                <div class="form-group row mb-4">
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Kabupaten</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <select name="kabupaten"  id="kabupaten" class="form-control select">
                                            <option selected="selected" value="">Pilih Kabupaten</option>
                                            <?php $__currentLoopData = $kabupaten; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(old('kabupaten') == $kab->id): ?> selected="" <?php endif; ?> value="<?php echo e($kab->id); ?>"><?php echo e($kab->nama); ?></option>
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
                                        </select>
                                        <p>Biarkan kosong jika tidak terkait dengan objek wisata</p>
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
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama Kategori</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <select name="kategori" class="form-control select">
                                            <option selected="selected" value="">Pilih Kategori</option>
                                            <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(old('kategori') == $kat->id): ?> selected="" <?php endif; ?> value="<?php echo e($kat->id); ?>"><?php echo e($kat->nama); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        
                                        <?php $__errorArgs = ['kategori'];
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
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Label Berita</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <select name="label[]" class="form-control select" multiple>
                                            <?php $__currentLoopData = $label; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(old('label') == $kat->id): ?> selected="" <?php endif; ?> value="<?php echo e($kat->id); ?>"><?php echo e($kat->nama); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <p>Anda dapat memilih label yang sudah ada, atau memasukan yang baru (ketik label lalu tekan tombol enter untuk menambahkan label baru)</p>
                                        <?php $__errorArgs = ['label'];
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
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Judul Berita</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" class="form-control" name="judul_berita" value="<?php echo e(old('judul_berita')); ?>" placeholder="Masukan judul berita">
                                        <?php $__errorArgs = ['judul_berita'];
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
                                    <label  class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Isi Berita</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <textarea id="summernote" name="isi_berita"><?php echo old('isi_berita'); ?></textarea>
                                        <?php $__errorArgs = ['isi_berita'];
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
    <link href="<?php echo e(asset('plugins/select2/select2.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('plugins/summernote/dist/summernote.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>
<?php $__env->startPush('js'); ?>
    
    <script src="<?php echo e(asset('plugins/summernote/dist/summernote.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/select2/select2.min.js')); ?>"></script>
    <script>
        
        $(document).ready(function() {
            
            $('#summernote').summernote({
                placeholder: 'Masukan keterangan lengkap disini, anda juga dapat memasukan gambar pada bagian text',
                height: 350
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
<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\project\coding\pariwisata2\resources\views/dashboard/pages/berita/create.blade.php ENDPATH**/ ?>