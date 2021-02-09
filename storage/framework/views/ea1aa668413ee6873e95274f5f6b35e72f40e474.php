<?php if($page_name != 'coming_soon' && $page_name != 'contact_us' && $page_name != 'error404' && $page_name != 'error500' && $page_name != 'error503' && $page_name != 'faq' && $page_name != 'helpdesk' && $page_name != 'maintenence' && $page_name != 'privacy' && $page_name != 'auth_boxed' && $page_name != 'auth_default'): ?>

    <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme">
            
        <nav id="sidebar">
            <div class="shadow-bottom"></div>

            <ul class="list-unstyled menu-categories" id="accordionExample">
                
                <?php if($page_name != 'alt_menu' && $page_name != 'blank_page' && $page_name != 'boxed' && $page_name != 'breadcrumb' ): ?>

                    <li class="menu <?php echo e(($category_name === 'dashboard') ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/dashboard')); ?>" data-active="<?php echo e(($category_name === 'dashboard') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(($category_name === 'dashboard') ? 'true' : 'false'); ?>" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu <?php echo e(($category_name === 'Master') ? 'active' : ''); ?>">
                        <a href="#Master" data-active="<?php echo e(($category_name === 'Master') ? 'true' : 'false'); ?>" data-toggle="collapse" aria-expanded="<?php echo e(($category_name === 'Master') ? 'true' : 'false'); ?>" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>
                                <span>Data Master</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled <?php echo e(($category_name === 'Master') ? 'show' : ''); ?>" id="Master" data-parent="#accordionExample">
                           
                            <?php if(Auth::user()->level == 1): ?>
                            <li class="<?php echo e(($page_name === 'Kabupaten') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/kabupaten')); ?>"> Kabupaten </a>
                            </li>
                            <li class="<?php echo e(($page_name === 'Kecamatan') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/kecamatan')); ?>"> Kecamatan </a>
                            </li>
                            <li class="<?php echo e(($page_name === 'Pengguna') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/pengguna')); ?>"> Pengguna </a>
                            </li>
                            <li class="<?php echo e(($page_name === 'Kategori Ekraf') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/kategori-ekraf')); ?>"> Kategori Ekraf </a>
                            </li>
                            <?php endif; ?>
                            <?php if(Auth::user()->level == 1): ?>
                            <li class="<?php echo e(($page_name === 'Link Terkait') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/link-terkait')); ?>"> Link Terkait </a>
                            </li>
                            <?php endif; ?>
                            <?php if(Auth::user()->level == 1 || Auth::user()->level == 5): ?>
                            <li class="<?php echo e(($page_name === 'Iklan') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/iklan')); ?>"> Iklan </a>
                            </li>
                            <?php endif; ?>


                        </ul>
                    </li>

                    <li class="menu <?php echo e(($category_name === 'Destinasi') ? 'active' : ''); ?>">
                        <a href="#Destinasi" data-active="<?php echo e(($category_name === 'Destinasi') ? 'true' : 'false'); ?>" data-toggle="collapse" aria-expanded="<?php echo e(($category_name === 'Destinasi') ? 'true' : 'false'); ?>" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>
                                <span>Destinasi</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled <?php echo e(($category_name === 'Destinasi') ? 'show' : ''); ?>" id="Destinasi" data-parent="#accordionExample">
                           
                            <?php if(Auth::user()->level == 1 || Auth::user()->level == 2 || Auth::user()->level == 7): ?>
                            <li class="<?php echo e(($page_name === 'Objek Wisata') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/objek-wisata')); ?>"> Objek Wisata </a>
                            </li>
                            <?php endif; ?>
                            
                            <?php if(Auth::user()->level == 1 || Auth::user()->level == 5): ?>
                            <li class="<?php echo e(($page_name === 'Kunjungan') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/kunjungan')); ?>"> Data Kunjungan </a>
                            </li>
                            <?php endif; ?>
                            
                            <?php if(Auth::user()->level == 1 || Auth::user()->level == 3 || Auth::user()->level == 7): ?>
                            <li class="<?php echo e(($page_name === 'Ekraf') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/ekraf')); ?>"> Ekraf </a>
                            </li>
                            <?php endif; ?>

                            <?php if(Auth::user()->level == 1 || Auth::user()->level == 4 || Auth::user()->level == 7): ?>
                            <li class="<?php echo e(($page_name === 'Restaurant') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/restaurant')); ?>"> Restaurant </a>
                            </li>
                            <?php endif; ?>

                            <?php if(Auth::user()->level == 1 || Auth::user()->level == 4 || Auth::user()->level == 7): ?>
                            <li class="<?php echo e(($page_name === 'Tempat Ibadah') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/tempat-ibadah')); ?>"> Tempat Ibadah </a>
                            </li>
                            <?php endif; ?>

                            <?php if(Auth::user()->level == 1 || Auth::user()->level == 4 || Auth::user()->level == 7): ?>
                            <li class="<?php echo e(($page_name === 'Cindramata') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/cindramata')); ?>"> Cindramata </a>
                            </li>
                            <?php endif; ?>

                            <?php if(Auth::user()->level == 1 || Auth::user()->level == 4 || Auth::user()->level == 7): ?>
                            <li class="<?php echo e(($page_name === 'Event') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/event')); ?>"> Event </a>
                            </li>
                            <?php endif; ?>

                            <?php if(Auth::user()->level == 1 || Auth::user()->level == 2 || Auth::user()->level == 7): ?>
                            <li class="<?php echo e(($page_name === 'Hotel') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/hotel')); ?>"> Hotel</a>
                            </li>
                            <?php endif; ?>

                            <?php if(Auth::user()->level == 1 || Auth::user()->level == 4 || Auth::user()->level == 7): ?>
                            <li class=" <?php echo e(($page_name === 'Sadar Wisata') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('/dashboard/sadar-wisata')); ?>" data-active="<?php echo e(($category_name === 'Sadar Wisata') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(($category_name === 'Sadar Wisata') ? 'true' : 'false'); ?>" class="dropdown-toggle">
                                    <div class="">
                                        <span>Sadar Wisata</span>
                                    </div>
                                </a>
                            </li>

                            <li class=" <?php echo e(($page_name === 'Desa Wisata') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('/dashboard/desa-wisata')); ?>" data-active="<?php echo e(($category_name === 'Desa Wisata') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(($category_name === 'Desa Wisata') ? 'true' : 'false'); ?>" class="dropdown-toggle">
                                    <div class="">
                                        <span>Desa Wisata</span>
                                    </div>
                                </a>
                            </li>

                            <li class=" <?php echo e(($page_name === 'Pemandu') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('/dashboard/pemandu-wisata')); ?>" data-active="<?php echo e(($category_name === 'Pemandu') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(($category_name === 'Pemandu') ? 'true' : 'false'); ?>" class="dropdown-toggle">
                                    <div class="">
                                        <span>Pemandu Wisata</span>
                                    </div>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php if(Auth::user()->level == 1 || Auth::user()->level == 5): ?>
                            
                            <li class=" <?php echo e(($page_name === 'Travel') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('/dashboard/travel')); ?>" data-active="<?php echo e(($category_name === 'Travel') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(($category_name === 'Travel') ? 'true' : 'false'); ?>" class="dropdown-toggle">
                                    <div class="">
                                        <span>Travel</span>
                                    </div>
                                </a>
                            </li>
                            <?php endif; ?>

                            <?php if(Auth::user()->level == 1 || Auth::user()->level == 3 || Auth::user()->level == 7): ?>
                            <li class=" <?php echo e(($page_name === 'Kuliner') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('/dashboard/kuliner')); ?>" data-active="<?php echo e(($category_name === 'Kuliner') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(($category_name === 'Kuliner') ? 'true' : 'false'); ?>" class="dropdown-toggle">
                                    <div class="">
                                        <span>Kuliner</span>
                                    </div>
                                </a>
                            </li>
                            <?php endif; ?>
                           
                        </ul>
                    </li>
                    
                    <li class="menu <?php echo e(($category_name === 'Objek') ? 'active' : ''); ?>">
                        <a href="#Objek" data-active="<?php echo e(($category_name === 'Objek') ? 'true' : 'false'); ?>" data-toggle="collapse" aria-expanded="<?php echo e(($category_name === 'Objek') ? 'true' : 'false'); ?>" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>
                                <span>Sumber Daya Pariwisata</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled <?php echo e(($category_name === 'Objek') ? 'show' : ''); ?>" id="Objek" data-parent="#accordionExample">
                            
                            <?php if(Auth::user()->level == 1 || Auth::user()->level == 2 || Auth::user()->level == 7): ?>
                            <li class="<?php echo e(($page_name === 'Hotel') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/hotel')); ?>"> Hotel</a>
                            </li>
                            <?php endif; ?>
                            
                            <?php if(Auth::user()->level == 1 || Auth::user()->level == 4 || Auth::user()->level == 7): ?>
                            <li class="<?php echo e(($page_name === 'Restaurant') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/restaurant')); ?>"> Restaurant </a>
                            </li>
                            <?php endif; ?>
                            
                            <?php if(Auth::user()->level == 1 || Auth::user()->level == 4 || Auth::user()->level == 7): ?>
                            <li class="<?php echo e(($page_name === 'Tempat Ibadah') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/tempat-ibadah')); ?>"> Tempat Ibadah </a>
                            </li>
                            <?php endif; ?>
                            
                            <?php if(Auth::user()->level == 1 || Auth::user()->level == 4 || Auth::user()->level == 7): ?>
                            
                            <li class=" <?php echo e(($page_name === 'Desa Wisata') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('/dashboard/desa-wisata')); ?>" data-active="<?php echo e(($category_name === 'Desa Wisata') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(($category_name === 'Desa Wisata') ? 'true' : 'false'); ?>" class="dropdown-toggle">
                                    <div class="">
                                        <span>Desa Wisata</span>
                                    </div>
                                </a>
                            </li>
                            
                            <li class=" <?php echo e(($page_name === 'Sadar Wisata') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('/dashboard/sadar-wisata')); ?>" data-active="<?php echo e(($category_name === 'Sadar Wisata') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(($category_name === 'Sadar Wisata') ? 'true' : 'false'); ?>" class="dropdown-toggle">
                                    <div class="">
                                        <span>Sadar Wisata</span>
                                    </div>
                                </a>
                            </li>

                            <li class=" <?php echo e(($page_name === 'Pemandu') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('/dashboard/pemandu-wisata')); ?>" data-active="<?php echo e(($category_name === 'Pemandu') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(($category_name === 'Pemandu') ? 'true' : 'false'); ?>" class="dropdown-toggle">
                                    <div class="">
                                        <span>Pemandu Wisata</span>
                                    </div>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php if(Auth::user()->level == 1 || Auth::user()->level == 5): ?>
                            
                            <li class=" <?php echo e(($page_name === 'Travel') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('/dashboard/travel')); ?>" data-active="<?php echo e(($category_name === 'Travel') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(($category_name === 'Travel') ? 'true' : 'false'); ?>" class="dropdown-toggle">
                                    <div class="">
                                        <span>Travel</span>
                                    </div>
                                </a>
                            </li>
                            <?php endif; ?>
                            
                            <!--<?php if(Auth::user()->level == 1 || Auth::user()->level == 3 || Auth::user()->level == 7): ?>-->
                            <!--<li class="<?php echo e(($page_name === 'Ekraf') ? 'active' : ''); ?>">-->
                            <!--    <a href="<?php echo e(url('dashboard/ekraf')); ?>"> Ekraf </a>-->
                            <!--</li>-->
                            <!--<?php endif; ?>-->
                            
                            <!--<?php if(Auth::user()->level == 1 || Auth::user()->level == 4 || Auth::user()->level == 7): ?>-->
                            <!--<li class="<?php echo e(($page_name === 'Cindramata') ? 'active' : ''); ?>">-->
                            <!--    <a href="<?php echo e(url('dashboard/cindramata')); ?>"> Cindramata </a>-->
                            <!--</li>-->
                            <!--<?php endif; ?>-->

                            <!--<?php if(Auth::user()->level == 1 || Auth::user()->level == 4 || Auth::user()->level == 7): ?>-->
                            <!--<li class="<?php echo e(($page_name === 'Event') ? 'active' : ''); ?>">-->
                            <!--    <a href="<?php echo e(url('dashboard/event')); ?>"> Event </a>-->
                            <!--</li>-->
                            <!--<?php endif; ?>-->
                            
                            <!--<?php if(Auth::user()->level == 1 || Auth::user()->level == 3 || Auth::user()->level == 7): ?>-->
                            <!--<li class=" <?php echo e(($page_name === 'Kuliner') ? 'active' : ''); ?>">-->
                            <!--    <a href="<?php echo e(url('/dashboard/kuliner')); ?>" data-active="<?php echo e(($category_name === 'Kuliner') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(($category_name === 'Kuliner') ? 'true' : 'false'); ?>" class="dropdown-toggle">-->
                            <!--        <div class="">-->
                            <!--            <span>Kuliner</span>-->
                            <!--        </div>-->
                            <!--    </a>-->
                            <!--</li>-->
                            <!--<?php endif; ?>-->
                           
                        </ul>
                    </li>
                    
                    <li class="menu <?php echo e(($category_name === 'Ekraf') ? 'active' : ''); ?>">
                        <a href="#Ekraf" data-active="<?php echo e(($category_name === 'Ekraf') ? 'true' : 'false'); ?>" data-toggle="collapse" aria-expanded="<?php echo e(($category_name === 'Ekraf') ? 'true' : 'false'); ?>" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>
                                <span>Ekraf</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled <?php echo e(($category_name === 'Ekraf') ? 'show' : ''); ?>" id="Ekraf" data-parent="#accordionExample">
                            
                            <?php if(Auth::user()->level == 1 || Auth::user()->level == 3 || Auth::user()->level == 7): ?>
                            <li class="<?php echo e(($page_name === 'Ekraf') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/ekraf')); ?>"> Pelaku Ekraf </a>
                            </li>
                            <?php endif; ?>
                            
                            <?php if(Auth::user()->level == 1 || Auth::user()->level == 4 || Auth::user()->level == 7): ?>
                            <li class="<?php echo e(($page_name === 'Cindramata') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/cindramata')); ?>"> Cindramata </a>
                            </li>
                            <?php endif; ?>

                            <!--<?php if(Auth::user()->level == 1 || Auth::user()->level == 4 || Auth::user()->level == 7): ?>-->
                            <!--<li class="<?php echo e(($page_name === 'Event') ? 'active' : ''); ?>">-->
                            <!--    <a href="<?php echo e(url('dashboard/event')); ?>"> Event </a>-->
                            <!--</li>-->
                            <!--<?php endif; ?>-->
                            
                            <?php if(Auth::user()->level == 1 || Auth::user()->level == 3 || Auth::user()->level == 7): ?>
                            <li class=" <?php echo e(($page_name === 'Kuliner') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('/dashboard/kuliner')); ?>" data-active="<?php echo e(($category_name === 'Kuliner') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(($category_name === 'Kuliner') ? 'true' : 'false'); ?>" class="dropdown-toggle">
                                    <div class="">
                                        <span>Kuliner</span>
                                    </div>
                                </a>
                            </li>
                            <?php endif; ?>
                           
                        </ul>
                    </li>
                    
                    <li class="menu <?php echo e(($category_name === 'Pemasaran') ? 'active' : ''); ?>">
                        <a href="#Pemasaran" data-active="<?php echo e(($category_name === 'Pemasaran') ? 'true' : 'false'); ?>" data-toggle="collapse" aria-expanded="<?php echo e(($category_name === 'Pemasaran') ? 'true' : 'false'); ?>" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>
                                <span>Pemasaran</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled <?php echo e(($category_name === 'Pemasaran') ? 'show' : ''); ?>" id="Pemasaran" data-parent="#accordionExample">

                            <?php if(Auth::user()->level == 1 || Auth::user()->level == 4 || Auth::user()->level == 7): ?>
                            <li class="<?php echo e(($page_name === 'Event') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/event')); ?>"> Event </a>
                            </li>
                            <?php endif; ?>
                            
                            <!--<?php if(Auth::user()->level == 1 || Auth::user()->level == 3 || Auth::user()->level == 7): ?>-->
                            <!--<li class=" <?php echo e(($page_name === 'Kuliner') ? 'active' : ''); ?>">-->
                            <!--    <a href="<?php echo e(url('/dashboard/kuliner')); ?>" data-active="<?php echo e(($category_name === 'Kuliner') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(($category_name === 'Kuliner') ? 'true' : 'false'); ?>" class="dropdown-toggle">-->
                            <!--        <div class="">-->
                            <!--            <span>Kuliner</span>-->
                            <!--        </div>-->
                            <!--    </a>-->
                            <!--</li>-->
                            <!--<?php endif; ?>-->
                           
                        </ul>
                    </li>
                   
                    <?php if(Auth::user()->level == 1): ?>
                    <li class="menu <?php echo e(($category_name === 'Berita') ? 'active' : ''); ?>">
                        <a href="#Berita" data-active="<?php echo e(($category_name === 'Berita') ? 'true' : 'false'); ?>" data-toggle="collapse" aria-expanded="<?php echo e(($category_name === 'Berita') ? 'true' : 'false'); ?>" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cast"><path d="M2 16.1A5 5 0 0 1 5.9 20M2 12.05A9 9 0 0 1 9.95 20M2 8V6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-6"></path><line x1="2" y1="20" x2="2.01" y2="20"></line></svg>
                                <span>Berita</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled <?php echo e(($category_name === 'Berita') ? 'show' : ''); ?>" id="Berita" data-parent="#accordionExample">
                           
                            <li class="<?php echo e(($page_name === 'Kategori Berita') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/kategori-berita')); ?>"> Kategori Berita </a>
                            </li>

                            <li class="<?php echo e(($page_name === 'Label') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/label')); ?>"> Label Berita </a>
                            </li>

                            <li class="<?php echo e(($page_name === 'Berita') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/berita')); ?>"> Berita </a>
                            </li>
                           
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if(Auth::user()->level == 1): ?>
                    <li class="menu <?php echo e(($category_name === 'Review') ? 'active' : ''); ?>">
                        <a href="#Review" data-active="<?php echo e(($category_name === 'Review') ? 'true' : 'false'); ?>" data-toggle="collapse" aria-expanded="<?php echo e(($category_name === 'Review') ? 'true' : 'false'); ?>" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                <span>Review</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled <?php echo e(($category_name === 'Review') ? 'show' : ''); ?>" id="Review" data-parent="#accordionExample">
                           
                            <li class="<?php echo e(($page_name === 'Objek Wisata') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/review/objek-wisata')); ?>"> Objek Wisata </a>
                            </li>

                            <li class="<?php echo e(($page_name === 'Objek Wisata') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/review/objek-wisata')); ?>"> Hotel </a>
                            </li>
                            <li class="<?php echo e(($page_name === 'Objek Wisata') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('dashboard/review/objek-wisata')); ?>"> Restaurant </a>
                            </li>
                           
                        </ul>
                    </li>
                    <?php endif; ?>
                    
                    <!--<?php if(Auth::user()->level == 1 || Auth::user()->level == 5): ?>-->
                    <!--<li class="menu <?php echo e(($page_name === 'Kunjungan') ? 'active' : ''); ?>">-->
                    <!--    <a href="<?php echo e(url('/dashboard/kunjungan')); ?>" data-active="<?php echo e(($category_name === 'Kunjungan') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(($category_name === 'Kunjungan') ? 'true' : 'false'); ?>" class="dropdown-toggle">-->
                    <!--        <div class="">-->
                    <!--            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>-->
                    <!--            <span>Kunjungan</span>-->
                    <!--        </div>-->
                    <!--    </a>-->
                    <!--</li>-->
                    <!--<?php endif; ?>-->
                    
                    <?php if(Auth::user()->level == 1): ?>
                    <li class="menu <?php echo e(($category_name === 'Pertanyaan') ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/dashboard/pertanyaan')); ?>" data-active="<?php echo e(($category_name === 'Pertanyaan') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(($category_name === 'Pertanyaan') ? 'true' : 'false'); ?>" class="dropdown-toggle">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                                <span>Pertanyaan</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu <?php echo e(($category_name === 'Pengaturan') ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/dashboard/pengaturan')); ?>" data-active="<?php echo e(($category_name === 'Pengaturan') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(($category_name === 'Pengaturan') ? 'true' : 'false'); ?>" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                                <span>Pengaturan</span>
                            </div>
                        </a>
                    </li>
                    <?php endif; ?>

                    <li class="menu <?php echo e(($category_name === 'dashboard') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-toggle">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                <span>Logout</span>
                            </div>
                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                    </li>

                    
                    

                    
                
                <?php endif; ?>
                
            </ul>
            
        </nav>

    </div>
    <!--  END SIDEBAR  -->

<?php endif; ?><?php /**PATH D:\xampp\htdocs\project\coding\pariwisata2\resources\views/dashboard/inc/sidebar.blade.php ENDPATH**/ ?>