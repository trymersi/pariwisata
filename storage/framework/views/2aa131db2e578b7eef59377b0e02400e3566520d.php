<?php echo $__env->make('dashboard.inc.function', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(ucwords($page_name)); ?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('uploads/images/setting/'.$setting_website->icon)); ?>"/>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <?php echo $__env->make('dashboard.inc.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
    <?php echo $__env->yieldPushContent('css'); ?>
    <?php echo toastr_css(); ?>
</head>
<body <?php echo e(($has_scrollspy) ? scrollspy($scrollspy_offset) : ''); ?> class=" <?php echo e(($page_name === 'alt_menu') ? 'alt-menu' : ''); ?> <?php echo e(($page_name === 'error404') ? 'error404 text-center' : ''); ?> <?php echo e(($page_name === 'error500') ? 'error500 text-center' : ''); ?> <?php echo e(($page_name === 'error503') ? 'error503 text-center' : ''); ?> <?php echo e(($page_name === 'maintenence') ? 'maintanence text-center' : ''); ?>">
    
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <?php echo $__env->make('dashboard.inc.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">



        <?php echo $__env->make('dashboard.inc.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">

            <?php echo $__env->yieldContent('content'); ?>

            <?php if($page_name == 'account_settings'): ?>
            <?php echo $__env->make('dashboard.inc.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
        
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->
    
    <?php echo $__env->make('dashboard.inc.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldPushContent('js'); ?>

    <div class="modal fade" id="modaltos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    
                    <p class="modal-text">
                        Dengan menyetujui syarat dan kondisi ini, anda bertanggung jawab penuh dengan apa yang anda masukan atau inputkan pada form tersebut baik itu tulisan maupun gambar
                    </p>
                </div>
                
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>
<?php /**PATH D:\xampp\htdocs\project\coding\pariwisata2\resources\views/dashboard/layouts/app.blade.php ENDPATH**/ ?>