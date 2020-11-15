@if ($page_name != 'coming_soon' && $page_name != 'contact_us' && $page_name != 'error404' && $page_name != 'error500' && $page_name != 'error503' && $page_name != 'faq' && $page_name != 'helpdesk' && $page_name != 'maintenence' && $page_name != 'privacy' && $page_name != 'auth_boxed' && $page_name != 'auth_default')

    <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme">
            
        <nav id="sidebar">
            <div class="shadow-bottom"></div>

            <ul class="list-unstyled menu-categories" id="accordionExample">
                
                @if ($page_name != 'alt_menu' && $page_name != 'blank_page' && $page_name != 'boxed' && $page_name != 'breadcrumb' )

                    <li class="menu {{ ($category_name === 'dashboard') ? 'active' : '' }}">
                        <a href="{{ url('/dashboard') }}" data-active="{{ ($category_name === 'dashboard') ? 'true' : 'false' }}" aria-expanded="{{ ($category_name === 'dashboard') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu {{ ($category_name === 'Master') ? 'active' : '' }}">
                        <a href="#Master" data-active="{{ ($category_name === 'Master') ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ ($category_name === 'Master') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>
                                <span>Data Master</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ ($category_name === 'Master') ? 'show' : '' }}" id="Master" data-parent="#accordionExample">
                           
                            @if(Auth::user()->level == 1)
                            <li class="{{ ($page_name === 'Kabupaten') ? 'active' : '' }}">
                                <a href="{{ url('dashboard/kabupaten') }}"> Kabupaten </a>
                            </li>
                            <li class="{{ ($page_name === 'Kecamatan') ? 'active' : '' }}">
                                <a href="{{ url('dashboard/kecamatan') }}"> Kecamatan </a>
                            </li>
                            <li class="{{ ($page_name === 'Pengguna') ? 'active' : '' }}">
                                <a href="{{ url('dashboard/pengguna') }}"> Pengguna </a>
                            </li>
                            <li class="{{ ($page_name === 'Kategori Ekraf') ? 'active' : '' }}">
                                <a href="{{ url('dashboard/kategori-ekraf') }}"> Kategori Ekraf </a>
                            </li>
                            @endif
                            @if(Auth::user()->level == 1 || Auth::user()->level == 3 || Auth::user()->level == 7)
                            <li class="{{ ($page_name === 'Ekraf') ? 'active' : '' }}">
                                <a href="{{ url('dashboard/ekraf') }}"> Ekraf </a>
                            </li>
                            @endif
                        </ul>
                    </li>

                    <li class="menu {{ ($category_name === 'Objek') ? 'active' : '' }}">
                        <a href="#Objek" data-active="{{ ($category_name === 'Objek') ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ ($category_name === 'Objek') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                <span>Objek</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ ($category_name === 'Objek') ? 'show' : '' }}" id="Objek" data-parent="#accordionExample">
                           
                            @if(Auth::user()->level == 1 || Auth::user()->level == 2 || Auth::user()->level == 7)
                            <li class="{{ ($page_name === 'Objek Wisata') ? 'active' : '' }}">
                                <a href="{{ url('dashboard/objek-wisata') }}"> Objek Wisata </a>
                            </li>
                            @endif

                            @if(Auth::user()->level == 1 || Auth::user()->level == 4 || Auth::user()->level == 7)
                            <li class="{{ ($page_name === 'Restaurant') ? 'active' : '' }}">
                                <a href="{{ url('dashboard/restaurant') }}"> Restaurant </a>
                            </li>
                            @endif

                            @if(Auth::user()->level == 1 || Auth::user()->level == 4 || Auth::user()->level == 7)
                            <li class="{{ ($page_name === 'Tempat Ibadah') ? 'active' : '' }}">
                                <a href="{{ url('dashboard/tempat-ibadah') }}"> Tempat Ibadah </a>
                            </li>
                            @endif

                            @if(Auth::user()->level == 1 || Auth::user()->level == 4 || Auth::user()->level == 7)
                            <li class="{{ ($page_name === 'Cindramata') ? 'active' : '' }}">
                                <a href="{{ url('dashboard/cindramata') }}"> Cindramata </a>
                            </li>
                            @endif

                            @if(Auth::user()->level == 1 || Auth::user()->level == 4 || Auth::user()->level == 7)
                            <li class="{{ ($page_name === 'Event') ? 'active' : '' }}">
                                <a href="{{ url('dashboard/event') }}"> Event </a>
                            </li>
                            @endif

                            @if(Auth::user()->level == 1 || Auth::user()->level == 2 || Auth::user()->level == 7)
                            <li class="{{ ($page_name === 'Hotel') ? 'active' : '' }}">
                                <a href="{{ url('dashboard/hotel') }}"> Hotel</a>
                            </li>
                            @endif
                           
                        </ul>
                    </li>
                    
                
                    <li class="menu {{ ($category_name === 'Berita') ? 'active' : '' }}">
                        <a href="#Berita" data-active="{{ ($category_name === 'Berita') ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ ($category_name === 'Berita') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cast"><path d="M2 16.1A5 5 0 0 1 5.9 20M2 12.05A9 9 0 0 1 9.95 20M2 8V6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-6"></path><line x1="2" y1="20" x2="2.01" y2="20"></line></svg>
                                <span>Berita</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ ($category_name === 'Berita') ? 'show' : '' }}" id="Berita" data-parent="#accordionExample">
                           
                            <li class="{{ ($page_name === 'Kategori Berita') ? 'active' : '' }}">
                                <a href="{{ url('dashboard/kategori-berita') }}"> Kategori Berita </a>
                            </li>

                            <li class="{{ ($page_name === 'Label') ? 'active' : '' }}">
                                <a href="{{ url('dashboard/label') }}"> Label Berita </a>
                            </li>

                            <li class="{{ ($page_name === 'Berita') ? 'active' : '' }}">
                                <a href="{{ url('dashboard/berita') }}"> Berita </a>
                            </li>
                           
                        </ul>
                    </li>

                    <li class="menu {{ ($category_name === 'Pengaturan') ? 'active' : '' }}">
                        <a href="{{ url('/dashboard/pengaturan') }}" data-active="{{ ($category_name === 'Pengaturan') ? 'true' : 'false' }}" aria-expanded="{{ ($category_name === 'Pengaturan') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Pengaturan</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu {{ ($category_name === 'dashboard') ? 'active' : '' }}">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-toggle">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                <span>Logout</span>
                            </div>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>

                    
                    

                    
                
                @endif
                
            </ul>
            
        </nav>

    </div>
    <!--  END SIDEBAR  -->

@endif