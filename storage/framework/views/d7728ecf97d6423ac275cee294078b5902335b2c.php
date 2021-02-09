<link href="<?php echo e(asset('assets/css/loader.css')); ?>" rel="stylesheet" type="text/css" />
<script src="<?php echo e(asset('assets/js/loader.js')); ?>"></script>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
<link href="<?php echo e(asset('bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />

<?php if($page_name != 'coming_soon' && $page_name != 'contact_us' && $page_name != 'error404' && $page_name != 'error500' && $page_name != 'error503' && $page_name != 'faq' && $page_name != 'helpdesk' && $page_name != 'maintenence' && $page_name != 'privacy' && $page_name != 'auth_boxed' && $page_name != 'auth_default'): ?>
<link href="<?php echo e(asset('assets/css/plugins.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
<?php endif; ?>
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<?php switch($page_name):
    case ('dashboard'): ?>
      
<link href="<?php echo e(asset('plugins/apex/apexcharts.css')); ?>" rel="stylesheet" type="text/css">
<link href="<?php echo e(asset('assets/css/dashboard/dash.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('sales'): ?>
      
<link href="<?php echo e(asset('plugins/apex/apexcharts.css')); ?>" rel="stylesheet" type="text/css">
<link href="<?php echo e(asset('assets/css/dashboard/dash_1.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('calendar'): ?>
      
      <link href="<?php echo e(asset('plugins/fullcalendar/fullcalendar.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('plugins/fullcalendar/custom-fullcalendar.advance.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('plugins/flatpickr/flatpickr.css')); ?>" rel="stylesheet" type="text/css">
      <link href="<?php echo e(asset('plugins/flatpickr/custom-flatpickr.css')); ?>" rel="stylesheet" type="text/css">
      <link href="<?php echo e(asset('assets/css/forms/theme-checkbox-radio.css')); ?>" rel="stylesheet" type="text/css" />
      <style>
          
          .widget-content-area { border-radius: 6px; margin-bottom: 10px; }
          .daterangepicker.dropdown-menu {
              z-index: 1059;
          }
          
      </style>
      <?php break; ?>

    <?php case ('chat'): ?>
      
      <link href="<?php echo e(asset('assets/css/apps/mailing-chat.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('contacts'): ?>
      
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/forms/theme-checkbox-radio.css')); ?>">
      <link href="<?php echo e(asset('plugins/jquery-ui/jquery-ui.min.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/apps/contacts.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('invoice'): ?>
      
      <link href="<?php echo e(asset('assets/css/apps/invoice.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>
    
    <?php case ('mailbox'): ?>
      
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/editors/quill/quill.snow.css')); ?>">
      <link href="<?php echo e(asset('assets/css/apps/mailbox.css')); ?>" rel="stylesheet" type="text/css" />
      <script src="plugins/sweetalerts/promise-polyfill.js"></script>
      <link href="<?php echo e(asset('plugins/sweetalerts/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('plugins/sweetalerts/sweetalert.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('plugins/notification/snackbar/snackbar.min.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('notes'): ?>
      
      <link href="<?php echo e(asset('assets/css/apps/notes.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/forms/theme-checkbox-radio.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>
    
    <?php case ('scrumboard'): ?>
      
      <link href="<?php echo e(asset('assets/css/apps/scrumboard.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/forms/theme-checkbox-radio.css')); ?>" rel="stylesheet" type="text/css">
      <?php break; ?>

    <?php case ('todo-list'): ?>
      
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/editors/quill/quill.snow.css')); ?>">
      <link href="<?php echo e(asset('assets/css/apps/todolist.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('auth_boxed'): ?>
      
      <link href="<?php echo e(asset('assets/css/main.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/authentication/form-2.css')); ?>" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/forms/theme-checkbox-radio.css')); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/forms/switches.css')); ?>">
      <?php break; ?>
    
    <?php case ('auth_default'): ?>
      
      <link href="<?php echo e(asset('assets/css/main.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/authentication/form-1.css')); ?>" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/forms/theme-checkbox-radio.css')); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/forms/switches.css')); ?>">
      <?php break; ?>

    <?php case ('charts'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('plugins/apex/apexcharts.css')); ?>" rel="stylesheet" type="text/css">
      <style>
          .apexcharts-canvas {
              margin: 0 auto;
          }
      </style>
      <?php break; ?>

    <?php case ('accordions'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/components/tabs-accordian/custom-accordions.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('blockui'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/components/custom-modal.css')); ?>" rel="stylesheet" type="text/css">
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/animate/animate.css')); ?>">
      <style>   
        .blockui-growl-message {
            display: none;
            text-align: left;
            padding: 15px;
            background-color: #455a64;
            color: #fff;
            border-radius: 3px;
        }
        .blockui-animation-container { display: none; }
        .multiMessageBlockUi {
            display: none;
            background-color: #455a64;
            color: #fff;
            border-radius: 3px;
            padding: 15px 15px 10px 15px;
        }
        .multiMessageBlockUi i { display: block }
    </style>
      <?php break; ?>

    <?php case ('bootstrap_carousel'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/components/custom-carousel.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('cards'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/components/cards/card.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('countdown'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/components/custom-countdown.css')); ?>" rel="stylesheet" type="text/css">
      <?php break; ?>

    <?php case ('counter'): ?>  
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/components/custom-counter.css')); ?>" rel="stylesheet" type="text/css">
      <?php break; ?>

    <?php case ('lightbox'): ?>
      
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/forms/theme-checkbox-radio.css')); ?>">
      <link href="<?php echo e(asset('plugins/lightbox/photoswipe.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('plugins/lightbox/default-skin/default-skin.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('plugins/lightbox/custom-photswipe.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('list_group'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/components/custom-list-group.css')); ?>" rel="stylesheet" type="text/css">
      <?php break; ?>

    <?php case ('media_object'): ?>
      
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/forms/theme-checkbox-radio.css')); ?>">
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/components/custom-media_object.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('modals'): ?>
      
      <link href="<?php echo e(asset('plugins/animate/animate.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/components/custom-modal.css')); ?>" rel="stylesheet" type="text/css" />  
      <?php break; ?>

    <?php case ('pricing_table'): ?>
      
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/forms/switches.css')); ?>">
      <link href="<?php echo e(asset('plugins/pricing-table/css/component.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('session_timeout'): ?>
        <style>
            h4.modal-title { color: #000; }
            .modal-content { border: none; }
            .modal-body { text-align: center; }
            .modal-body p {
                color: #515365;
                font-weight: 600;
                margin-bottom: 0; }
            p span.countdown-holder { color: #e7515a; font-size: 18px; }
            .modal-footer { border: none; }
            .progress {
                width: 50%;
                margin: 0 auto;
                border-radius: 30px;
                height: 10px;
            }
            .modal-backdrop { background-color: #060818; }
            @media (min-width: 576px) { .modal-dialog { max-width: 350px; } }
            .layout-px-spacing {
                min-height: calc(100vh - 149px)!important;
            }
        </style>
      <?php break; ?>

    <?php case ('notifications'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('plugins/notification/snackbar/snackbar.min.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('sweet_alerts'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('plugins/animate/animate.css')); ?>" rel="stylesheet" type="text/css" />
      <script src="<?php echo e(asset('plugins/sweetalerts/promise-polyfill.js')); ?>"></script>
      <link href="<?php echo e(asset('plugins/sweetalerts/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('plugins/sweetalerts/sweetalert.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/components/custom-sweetalert.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('tabs'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/components/tabs-accordian/custom-tabs.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('timeline'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/components/timeline/custom-timeline.css')); ?>" rel="stylesheet" type="text/css" />
      <style>
          .toggle-code-snippet { margin-bottom: 0px; }
      </style>
      <?php break; ?>

    <?php case ('drag_n_drop'): ?>
      
      <link href="<?php echo e(asset('plugins/drag-and-drop/dragula/dragula.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('plugins/drag-and-drop/dragula/example.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('alerts'): ?>
      
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/elements/alert.css')); ?>">
      <style>
          .btn-light { border-color: transparent; }
      </style>
      <?php break; ?>

    <?php case ('avatars'): ?>
      
      <link href="<?php echo e(asset('assets/css/elements/avatar.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('badges'): ?>
      
      <link href="<?php echo e(asset('plugins/tagInput/tags-input.css')); ?>" rel="stylesheet" type="text/css" />
      <style>
          .tags-input-wrapper input { margin: 0 auto; }
      </style>
      <?php break; ?>

    <?php case ('breadcrumbs'): ?>
      
      <link href="<?php echo e(asset('assets/css/elements/miscellaneous.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/elements/breadcrumb.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('button_group'): ?>
      
      <style>
        .table-bordered td, .table-bordered th { border: 1px solid #ebedf2; }
      </style>
      <?php break; ?>

    <?php case ('buttons'): ?>
      
      <style>
        .table-bordered td, .table-bordered th { border: 1px solid #ebedf2; }
      </style>
      <?php break; ?>

    <?php case ('color_library'): ?>
      
      <link href="<?php echo e(asset('assets/css/elements/color_library.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('dropdown'): ?>
      
      <link href="<?php echo e(asset('assets/css/elements/miscellaneous.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('infobox'): ?>
      
      <link href="<?php echo e(asset('assets/css/elements/infobox.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('jumbotron'): ?>
      
      <link href="<?php echo e(asset('assets/css/elements/miscellaneous.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('loaders'): ?>
      
      <link href="<?php echo e(asset('plugins/loaders/custom-loader.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('progress_bar'): ?>
      
      <style>
        .t-rotate270 { -webkit-transform: rotate(270deg); transform:rotate(270deg) }
      </style>
      <?php break; ?>

    <?php case ('pagination'): ?>
      
      <link href="<?php echo e(asset('assets/css/elements/custom-pagination.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('popovers'): ?>
      
      <link href="<?php echo e(asset('assets/css/elements/popover.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>
    
    <?php case ('search'): ?>
      
      <link href="<?php echo e(asset('assets/css/elements/search.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('tooltips'): ?>
      
      <link href="<?php echo e(asset('assets/css/elements/tooltip.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('treeview'): ?>
      
      <link href="<?php echo e(asset('assets/css/elements/custom-tree_view.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('typography'): ?>
      
      <link href="<?php echo e(asset('assets/css/elements/custom-typography.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('font_icons'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="<?php echo e(asset('plugins/font-icons/fontawesome/css/regular.css')); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('plugins/font-icons/fontawesome/css/fontawesome.css')); ?>">
      <style>
          .feather-icon .icon-section {
            padding: 30px;
        }
        .feather-icon .icon-section h4 {
            color: #3b3f5c;
            font-size: 17px;
            font-weight: 600;
            margin: 0;
            margin-bottom: 16px;
        }
        .feather-icon .icon-content-container {
            padding: 0 16px;
            width: 86%;
            margin: 0 auto;
            border: 1px solid #bfc9d4;
            border-radius: 6px;
        }
        .feather-icon .icon-section p.fs-text {
            padding-bottom: 30px;
            margin-bottom: 30px;
        }
        .feather-icon .icon-container { cursor: pointer; }
        .feather-icon .icon-container svg {
            color: #3b3f5c;
            margin-right: 6px;
            vertical-align: middle;
            width: 20px;
            height: 20px;
            fill: rgba(0, 23, 55, 0.08);
        }
        .feather-icon .icon-container:hover svg {
            color: #1b55e2;
            fill: rgba(27, 85, 226, 0.23921568627450981);
        }
        .feather-icon .icon-container span { display: none; }
        .feather-icon .icon-container:hover span { color: #1b55e2; }
        .feather-icon .icon-link {
            color: #1b55e2;
            font-weight: 600;
            font-size: 14px;
        }


        /*FAB*/
        .fontawesome .icon-section {
            padding: 30px;
        }
        .fontawesome .icon-section h4 {
            color: #3b3f5c;
            font-size: 17px;
            font-weight: 600;
            margin: 0;
            margin-bottom: 16px;
        }
        .fontawesome .icon-content-container {
            padding: 0 16px;
            width: 86%;
            margin: 0 auto;
            border: 1px solid #bfc9d4;
            border-radius: 6px;
        }
        .fontawesome .icon-section p.fs-text {
            padding-bottom: 30px;
            margin-bottom: 30px;
        }
        .fontawesome .icon-container { cursor: pointer; }
        .fontawesome .icon-container i {
            font-size: 20px;
            color: #3b3f5c;
            vertical-align: middle;
            margin-right: 10px;
        }
        .fontawesome .icon-container:hover i { color: #1b55e2; }
        .fontawesome .icon-container span { color: #888ea8; display: none; }
        .fontawesome .icon-container:hover span { color: #1b55e2; }
        .fontawesome .icon-link {
            color: #1b55e2;
            font-weight: 600;
            font-size: 14px;
        }
      </style>
      <?php break; ?>

    <?php case ('maps'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('plugins/jvector/jquery-jvectormap-2.0.3.css')); ?>" rel="stylesheet" type="text/css" />
      <style>
          .jvectormap-container {
              border-radius: 14px;
              padding: 20px 0;
          }
          .jvectormap-zoomin, .jvectormap-zoomout, .jvectormap-goback {
              left: 20px;
              border-radius: 50%;
              background: #ffffff;
              padding: 6px 6px;
              color: #3b3f5c;
              border: 2px solid #3b3f5c;
              font-size: 19px;
              font-weight: 700;
              top: 20px;
          }
          .jvectormap-zoomout {
              top: 20px;
              left: 50px;
          }
      </style>
      <?php break; ?>
    
    <?php case ('coming_soon'): ?>
      
      <link href="<?php echo e(asset('assets/css/main.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/pages/coming-soon/style.css')); ?>" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/forms/theme-checkbox-radio.css')); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/forms/switches.css')); ?>">
      <?php break; ?>


    <?php case ('contact_us'): ?>
      
      <link href="<?php echo e(asset('assets/css/plugins.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/pages/contact_us.css')); ?>" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/forms/theme-checkbox-radio.css')); ?>">
      <style>
        #content {
            width: 100%;
            margin-top: 0;
            margin-left: 0;
        }
        .main-container {
          padding: 0 0 0 0;
        }
      </style>
      <?php break; ?>

    <?php case ('error404'): ?>
      
      <link href="<?php echo e(asset('assets/css/plugins.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/pages/error/style-400.css')); ?>" rel="stylesheet" type="text/css" />
      <style>
          #content {
              width: 100%;
              margin-top: 0;
              margin-left: 0;
          }
      </style>
      <?php break; ?>

    <?php case ('error500'): ?>
      
      <link href="<?php echo e(asset('assets/css/plugins.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/pages/error/style-500.css')); ?>" rel="stylesheet" type="text/css" />
      <style>
        #content {
            width: 100%;
            margin-top: 0;
            margin-left: 0;
        }
      </style>
      <?php break; ?>

    <?php case ('error503'): ?>
      
      <link href="<?php echo e(asset('assets/css/plugins.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/pages/error/style-503.css')); ?>" rel="stylesheet" type="text/css" />
      <style>
        #content {
            width: 100%;
            margin-top: 0;
            margin-left: 0;
        }
      </style>
      <?php break; ?>

    <?php case ('faq'): ?>
      
      <link href="<?php echo e(asset('assets/css/main.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/pages/faq/faq.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('faq2'): ?>
      
      <link href="<?php echo e(asset('assets/css/pages/faq/faq2.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('helpdesk'): ?>
      
      <link href="<?php echo e(asset('assets/css/main.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/pages/helpdesk.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('maintenence'): ?>
      
      <link href="<?php echo e(asset('assets/css/plugins.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/pages/error/style-maintanence.css')); ?>" rel="stylesheet" type="text/css" />
      <style>
        #content {
            width: 100%;
            margin-left: 0;
        }
      </style>
      <?php break; ?>
    
    <?php case ('privacy'): ?>
      
      <link href="<?php echo e(asset('assets/css/main.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/pages/privacy/privacy.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('alt_menu'): ?>
      
      <style>

        /*
            Just for demo purpose ---- Remove it.
        */        
        /*<starter kit design>*/

        .widget-one {

        }
        .widget-one h6 {
            font-size: 20px;
            font-weight: 600;
            letter-spacing: 0px;
            margin-bottom: 22px;
        }
        .widget-one p {
            font-size: 15px;
            margin-bottom: 0;
        }
        
        /*/<starter kit design>*/

      </style>
      <?php break; ?>
    
    <?php case ('boxed'): ?>
      
      <style>
        /*
            The below code is for DEMO purpose --- Use it if you are using this demo otherwise Remove it
        */

        body {
            max-width: 1140px;
            margin: 0 auto;
        }
        .header-container {
            max-width: 1140px;
            margin: 0 auto;
        }
        .sidebar-wrapper {
            left: auto;
        }
        #content {
            transition: auto;
        }

        /*
            ====================
                IE Support
            ====================
        */

        @media  all and (-ms-high-contrast: none), (-ms-high-contrast: active) {
            .header-container { width: 100%; }
        }

        /*
            Just for demo purpose ---- Remove it.
        */
        /*<starter kit design>*/

        .widget-one {

        }
        .widget-one h6 {
            font-size: 20px;
            font-weight: 600;
            letter-spacing: 0px;
            margin-bottom: 22px;
        }
        .widget-one p {
            font-size: 15px;
            margin-bottom: 0;
        }

      </style>
      <?php break; ?>
    
    <?php case ('breadcrumb'): ?>
      
      <style>
        /*
            The below code is for DEMO purpose --- Use it if you are using this demo otherwise Remove it
        */
        .page-title {
            float: none;
            margin-top: 0;
            margin-bottom: 0;
            align-self: center;
            padding-right: 15px;
            border-right: 1px solid #bfc9d4;
            margin-right: 15px;
        }
        .page-title h3 {
            margin-bottom: 0;
        }
        .page-header {
            display: flex;
            /* padding: 45px 0; */
        }
        .breadcrumb-one {
            display: inline-block;
            align-self: center;
        }
        .breadcrumb-one .breadcrumb {
            padding: 0;
            vertical-align: text-bottom;
            margin-bottom: 0;
            background: transparent;
        }
        .breadcrumb-one .breadcrumb-item {
            align-self: center;
        }
        .breadcrumb-one .breadcrumb-item a {
            color: #888ea8;
            vertical-align: text-bottom;
        }
        .breadcrumb-one .breadcrumb-item a svg {
            width: 20px;
            height: 20px;
            vertical-align: sub;
        }
        .breadcrumb-one .breadcrumb-item.active a {
            color: #009688;
        }
        .breadcrumb-one .breadcrumb-item span {
            vertical-align: text-bottom;
        }
        .breadcrumb-one .breadcrumb-item.active {
            color: #009688;
            font-weight: 600;
        }
        .breadcrumb-one .breadcrumb-item+.breadcrumb-item {
            padding: 0px;
        }
        .breadcrumb-one .breadcrumb-item+.breadcrumb-item::before {
            color: #515365;
            font-size: 0;
            content: url('data:image/svg+xml, <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 24 24" fill="none" stroke="%23555" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>');
            vertical-align: text-top;
            padding: 0 6px;
        }


        @media(max-width: 575px) {
            .page-header {
                display: block;
            }
            .page-title {
                margin-bottom: 20px;
                border: none;
                padding-right: 0;
                margin-right: 0;
            }
        }


        /*
            Just for demo purpose ---- Remove it.
        */
        /*<starter kit design>*/

        .widget-one {

        }
        .widget-one h6 {
            font-size: 20px;
            font-weight: 600;
            letter-spacing: 0px;
            margin-bottom: 22px;
        }
        .widget-one p {
            font-size: 15px;
            margin-bottom: 0;
        }

        /*</starter kit design>*/

      </style>
      <?php break; ?>

    <?php case ('bootstrap_basic_table'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/forms/theme-checkbox-radio.css')); ?>">
      <link href="<?php echo e(asset('assets/css/tables/table-basic.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('alternative_pagination'): ?>
      
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/datatables.css')); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/dt-global_style.css')); ?>">
      <?php break; ?>

    <?php case ('basic-light'): ?>
      
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/datatables-light.css')); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/dt-global_style-light.css')); ?>">
      <?php break; ?>

    <?php case ('basic'): ?>
      
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/datatables.css')); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/dt-global_style.css')); ?>">
      <?php break; ?>

    <?php case ('custom'): ?>
      
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/datatables.css')); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/forms/theme-checkbox-radio.css')); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/dt-global_style.css')); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/custom_dt_custom.css')); ?>">
      <?php break; ?>

    <?php case ('html5'): ?>
      
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/datatables.css')); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/custom_dt_html5.css')); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/dt-global_style.css')); ?>">
      <?php break; ?>

    <?php case ('live_dom_ordering'): ?>
      
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/datatables.css')); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/dt-global_style.css')); ?>">
      <?php break; ?>

    <?php case ('miscellaneous'): ?>
      
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/datatables.css')); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/custom_dt_miscellaneous.css')); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/forms/theme-checkbox-radio.css')); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/dt-global_style.css')); ?>">
      <?php break; ?>

    <?php case ('multi-column_ordering'): ?>
      
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/datatables.css')); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/forms/theme-checkbox-radio.css')); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/dt-global_style.css')); ?>">
      <?php break; ?>

    <?php case ('multiple_tables'): ?>
      
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/datatables.css')); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/dt-global_style.css')); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/custom_dt_multiple_tables.css')); ?>">
      <?php break; ?>

    <?php case ('ordering_sorting'): ?>
      
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/datatables.css')); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/dt-global_style.css')); ?>">
      <?php break; ?>

    <?php case ('range_search'): ?>
      
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/datatables.css')); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/table/datatable/dt-global_style.css')); ?>">
      <style>
          .table-responsive > .table {
              background: transparent;
          }
      </style>
      <?php break; ?>

    <?php case ('account_settings'): ?>
      
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/dropify/dropify.min.css')); ?>">
      <link href="<?php echo e(asset('assets/css/users/account-setting.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('profile'): ?>
      
      <link href="<?php echo e(asset('assets/css/users/user-profile.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('widgets'): ?>
      
      <link href="<?php echo e(asset('plugins/apex/apexcharts.css')); ?>" rel="stylesheet" type="text/css">
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/widgets/modules-widgets.css')); ?>">
      <?php break; ?>

    <?php case ('basic'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('bootstrap_select'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/bootstrap-select/bootstrap-select.min.css')); ?>">
      <?php break; ?>

    <?php case ('touchspin'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')); ?>">
      <style>
          #demo_vertical::-ms-clear, #demo_vertical2::-ms-clear { display: none; }
          input#demo_vertical { border-top-right-radius: 5px; border-bottom-right-radius: 5px; }
          input#demo_vertical2 { border-top-right-radius: 5px; border-bottom-right-radius: 5px; }
      </style>
      <?php break; ?>

    <?php case ('checkbox_radio'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/forms/theme-checkbox-radio.css')); ?>">
      <?php break; ?>

    <?php case ('clipboard'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/forms/custom-clipboard.css')); ?>">
      <?php break; ?>
      
    <?php case ('date_range_picker'): ?>
      
      <link href="<?php echo e(asset('plugins/flatpickr/flatpickr.css')); ?>" rel="stylesheet" type="text/css">
      <link href="<?php echo e(asset('plugins/noUiSlider/nouislider.min.css')); ?>" rel="stylesheet" type="text/css">
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('plugins/flatpickr/custom-flatpickr.css')); ?>" rel="stylesheet" type="text/css">
      <link href="<?php echo e(asset('plugins/noUiSlider/custom-nouiSlider.css')); ?>" rel="stylesheet" type="text/css">
      <link href="<?php echo e(asset('plugins/bootstrap-range-Slider/bootstrap-slider.css')); ?>" rel="stylesheet" type="text/css">
      <?php break; ?>
    
    <?php case ('file_upload'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('plugins/file-upload/file-upload-with-preview.min.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('input_group'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/forms/theme-checkbox-radio.css')); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/forms/switches.css')); ?>">
      <?php break; ?>

    <?php case ('input_mask'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('layouts'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('markdown'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="<?php echo e(asset('plugins/editors/markdown/simplemde.min.css')); ?>">
      <?php break; ?>

    <?php case ('maxlength'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>

    <?php case ('quill'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/editors/quill/quill.snow.css')); ?>">
      <?php break; ?>


    <?php case ('select2'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/select2/select2.min.css')); ?>">
      <?php break; ?>

    <?php case ('switches'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/forms/switches.css')); ?>">
      <?php break; ?>

    <?php case ('typeahead'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('plugins/autocomplete/autocomplete.css')); ?>" rel="stylesheet" type="text/css" />
      <style>
          .text-muted { color: #009688 !important; font-size: 12px; }
          .form-group label, label { font-size: 14px; font-weight: 600; color: #888ea8; }
      </style>
      <?php break; ?>

    <?php case ('validation'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <?php break; ?>
    
    <?php case ('wizards'): ?>
      
      <link href="<?php echo e(asset('assets/css/scrollspyNav.css')); ?>" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/jquery-step/jquery.steps.css')); ?>">
      <style>
          #formValidate .wizard > .content {min-height: 25em;}
          #example-vertical.wizard > .content {min-height: 24.5em;}
      </style>
      <?php break; ?>

    <?php default: ?>
        <script>console.log('No custom Styles available.')</script>
<?php endswitch; ?>
<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES --><?php /**PATH D:\xampp\htdocs\project\coding\pariwisata2\resources\views/dashboard/inc/styles.blade.php ENDPATH**/ ?>