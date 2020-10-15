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
                        <a href="#dashboard" data-active="{{ ($category_name === 'Master') ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ ($category_name === 'Master') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg> 
                                <span>Data Master</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ ($category_name === 'Master') ? 'show' : '' }}" id="dashboard" data-parent="#accordionExample">
                           
                            @if(Auth::user()->level == 1)
                            <li class="{{ ($page_name === 'Kabupaten') ? 'active' : '' }}">
                                <a href="{{ url('dashboard/kabupaten') }}"> Kabupaten </a>
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
                        <a href="#dashboard" data-active="{{ ($category_name === 'Objek') ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ ($category_name === 'Objek') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg> 
                                <span>Objek</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ ($category_name === 'Objek') ? 'show' : '' }}" id="dashboard" data-parent="#accordionExample">
                           
                            @if(Auth::user()->level == 1 || Auth::user()->level == 2 || Auth::user()->level == 7)
                            <li class="{{ ($page_name === 'Objek Wisata') ? 'active' : '' }}">
                                <a href="{{ url('dashboard/objek-wisata') }}"> Objek Wisata </a>
                            </li>
                            @endif
                           
                        </ul>
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