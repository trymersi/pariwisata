

<?php $__env->startSection('content'); ?>
<div class="row">
    <div id="flStackForm" class="col-md-8 layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>
                            Form Tambah Data Detail <?php echo e($page_name); ?> <?php echo e($nama_objek_wisata); ?>

                        </h4>
                    </div>                                                                        
                </div>
            </div>
            
            <div class="widget-content widget-content-area">
                <?php if(isset($edit->id)): ?>
                <form method="post" action="<?php echo e(url ('dashboard/objek-wisata/detail/update/'.$edit->id)); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?> <?php echo e(method_field('PATCH')); ?>

                    <input type="text" hidden name="id_edit" value="<?php echo e($edit->id); ?>">
                <?php else: ?>
                <form method="post" action="<?php echo e(url('dashboard/objek-wisata/detail/store')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                <?php endif; ?>

                    <input type="text" hidden name="objek_wisata_id" value="<?php echo e($objek_wisata_id); ?>">
                    <div class="form-group row mb-4">
                        <label  class="col-xl-3 col-sm-4 col-sm-3 col-form-label">Lembaga Pengelolah</label>
                        <div class="col-xl-9 col-lg-8 col-sm-9">
                            <input type="text" class="form-control" name="lembaga_pengelolah" value="<?php echo e(old('lembaga_pengelolah',isset($edit->lembaga_pengelola) ? $edit->lembaga_pengelola :'')); ?>" placeholder="Lembaga pengelolah objek wisata">
                            <?php $__errorArgs = ['lembaga_pengelolah'];
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
                        <label  class="col-xl-3 col-sm-4 col-sm-3 col-form-label">Jenis Pemasaran</label>
                        <div class="col-xl-9 col-lg-8 col-sm-9">
                            <select name="jenis_pemasaran[]" class="form-control select" multiple="multiple">
                                <option value="">Pilih Jenis Pemasaran</option>
                                <option <?php if(old('jenis_pemasaran.0') || in_array('Jaringan Sosial',$pemasaran)): ?> selected="" <?php endif; ?> value="Jaringan Sosial">Jaringan Sosial</option>
                                <option <?php if(old('jenis_pemasaran.1') || in_array('Media Cetak',$pemasaran)): ?> selected="" <?php endif; ?> value="Media Cetak">Media Cetak</option>
                                <option <?php if(old('jenis_pemasaran.2') || in_array('Media Elektronik',$pemasaran)): ?> selected="" <?php endif; ?> value="Media Elektronik">Media Elektronik</option>
                            </select>
                            <p>Anda dapat memilih lebih dari satu</p>
                            <?php $__errorArgs = ['jenis_pemasaran'];
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
                        <label  class="col-xl-3 col-sm-4 col-sm-3 col-form-label">Peraturan Perundang Undangan</label>
                        <div class="col-xl-9 col-lg-8 col-sm-9">
                            <select name="peraturan_uu" class="form-control select">
                                <option value="">Pilih</option>
                                <option <?php if((isset($edit->peraturan_uu) && $edit->peraturan_uu == 1)): ?> selected="" <?php endif; ?> value="1">Sudah Ada</option>
                                <option <?php if((isset($edit->peraturan_uu) && $edit->peraturan_uu == 0)): ?> selected="" <?php endif; ?> value="0">Belum Ada</option>
                            </select>
                            <?php $__errorArgs = ['peraturan_uu'];
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
                        <label  class="col-xl-3 col-sm-4 col-sm-3 col-form-label">Stakeholder</label>
                        <div class="col-xl-9 col-lg-8 col-sm-9">
                            <input type="text" class="form-control" name="stakeholders" value="<?php echo e(old('stakeholders',isset($edit->stakeholders) ? $edit->stakeholders :'')); ?>" placeholder="Masukan data stakeholder">
                            <?php $__errorArgs = ['stakeholders'];
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
                        <label  class="col-xl-3 col-sm-4 col-sm-3 col-form-label">Nama Penanggung Jawab</label>
                        <div class="col-xl-9 col-lg-8 col-sm-9">
                            <input type="text" class="form-control" name="kontak_nama" value="<?php echo e(old('kontak_nama',isset($edit->kontak_nama) ? $edit->kontak_nama :'')); ?>" placeholder="Masukan nama penanggung jawab objek wisata">
                            <?php $__errorArgs = ['kontak_nama'];
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
                        <label  class="col-xl-3 col-sm-4 col-sm-3 col-form-label">Kontak Penanggung Jawab</label>
                        <div class="col-xl-9 col-lg-8 col-sm-9">
                            <input type="text" class="form-control" name="kontak_telepon" value="<?php echo e(old('kontak_telepon',isset($edit->kontak_telepon) ? $edit->kontak_telepon :'')); ?>" placeholder="Masukan nomor kontak penanggung jawab objek wisata">
                            <?php $__errorArgs = ['kontak_telepon'];
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
                        <label  class="col-xl-3 col-sm-4 col-sm-3 col-form-label">Harga Tiket</label>
                        <div class="col-xl-9 col-lg-8 col-sm-9">
                            <input type="number" class="form-control" name="harga_tiket" value="<?php echo e(old('harga_tiket',isset($edit->harga_tiket) ? $edit->harga_tiket :'')); ?>" placeholder="Masukan harga tiket">
                            <p>Masukan 0 jika tidak ada</p>
                            <?php $__errorArgs = ['harga_tiket'];
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
                        <label  class="col-xl-3 col-sm-4 col-sm-3 col-form-label">Halal ?</label>
                        <div class="col-xl-9 col-lg-8 col-sm-9">
                            <select name="halal" class="form-control select">
                                <option value="">Pilih</option>
                                <option <?php if((isset($edit->halal) && $edit->halal == 1)): ?> selected="" <?php endif; ?> value="1">Halal</option>
                                <option <?php if((isset($edit->halal) && $edit->halal == 0)): ?> selected="" <?php endif; ?> value="0">Tidak</option>
                            </select>
                            <?php $__errorArgs = ['halal'];
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
                        <h4>Form Tambah Data Detail <?php echo e($page_name); ?> <?php echo e($nama_objek_wisata); ?></h4>
                        <li>Data tambahan untuk  <?php echo e($page_name); ?> <?php echo e($nama_objek_wisata); ?></li>
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
            $(".select").select2({
                tags: true,
            });
        });
        
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\project\coding\pariwisata2\resources\views/dashboard/pages/objek-wisata/detail.blade.php ENDPATH**/ ?>