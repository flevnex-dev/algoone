@php
    $setting = \App\Models\SiteSetting::first();
@endphp
<header class="page-header row">
    <div class="logo-wrapper d-flex align-items-center col-auto"><a href="{{ url('/admin/dashboard') }}"><img
                class="light-logo img-fluid" style="height: 50px;" src="{{ isset($setting) && $setting->logo ? asset($setting->logo) : asset('admin/assets/image/logo.png') }}"
                alt="logo">
                <img class="dark-logo img-fluid" 
                src="{{ isset($setting) && $setting->logo ? asset($setting->logo) : asset('admin/assets/image/logo.png') }}" alt="logo"></a><a
            class="close-btn toggle-sidebar" href="javascript:void(0)">
            <svg class="svg-color">
                <use href="{{ url('/admin/assets') }}/svg/iconly-sprite.svg#Category"></use>
            </svg></a></div>
    <div class="page-main-header col">
        <div class="header-left">
            {{--  <form class="form-inline search-full col" action="#" method="get">
                <div class="form-group w-100">
                    <div class="Typeahead Typeahead--twitterUsers">
                        <div class="u-posRelative">
                            <input class="demo-input Typeahead-input form-control-plaintext w-100"
                                type="text" placeholder="Search Admiro .." name="q" title=""
                                autofocus>
                            <div class="spinner-border Typeahead-spinner" role="status"><span
                                    class="sr-only">Loading...</span></div><i class="close-search"
                                data-feather="x"></i>
                        </div>
                        <div class="Typeahead-menu"></div>
                    </div>
                </div>
            </form>
            <div class="form-group-header d-lg-block d-none">
                <div class="Typeahead Typeahead--twitterUsers">
                    <div class="u-posRelative d-flex align-items-center">
                        <input class="demo-input py-0 Typeahead-input form-control-plaintext w-100"
                            type="text" placeholder="Type to Search..." name="q" title=""><i
                            class="search-bg iconly-Search icli"></i>
                    </div>
                </div>
            </div>  --}}
        </div>
        <div class="nav-right">
            <ul class="header-right">
                {{--  <li class="custom-dropdown">
                    <div class="translate_wrapper">
                        <div class="current_lang"><a class="lang" href="javascript:void(0)"><i
                                    class="flag-icon flag-icon-us"></i>
                                <h6 class="lang-txt f-w-700">ENG</h6>
                            </a></div>
                        <ul class="custom-menu profile-menu language-menu py-0 more_lang">
                            <li class="d-block"><a class="lang" href="#" data-value="English"><i
                                        class="flag-icon flag-icon-us"></i>
                                    <div class="lang-txt">English</div>
                                </a></li>
                            <li class="d-block"><a class="lang" href="#" data-value="fr"><i
                                        class="flag-icon flag-icon-fr"></i>
                                    <div class="lang-txt">Français</div>
                                </a></li>
                            <li class="d-block"><a class="lang" href="#" data-value="es"><i
                                        class="flag-icon flag-icon-es"></i>
                                    <div class="lang-txt">Español</div>
                                </a></li>
                        </ul>
                    </div>
                </li>  --}}
                {{--  <li class="search d-lg-none d-flex"> <a href="javascript:void(0)">
                        <svg>
                            <use href="{{ url('/admin/assets') }}/svg/iconly-sprite.svg#Search"></use>
                        </svg></a></li>  --}}
                <!-- <li> <a class="dark-mode" href="javascript:void(0)">
                    <svg>
                        <use href="{{ url('/admin/assets') }}/svg/iconly-sprite.svg#moondark"></use>
                    </svg></a></li> -->
            
                    <li class="profile-nav custom-dropdown">
                        <div class="user-wrap">
                            <div class="user-img">
                                <img src="{{ asset('admin/assets/images/profile.png') }}" alt="user">
                            </div>
                            <div class="user-content">
                                <h6>{{ Auth::user()->name ?? 'Guest' }}</h6>
                                <p class="mb-0">
                                    {{ Auth::user()->role ?? 'User' }} <i class="fa-solid fa-chevron-down"></i>
                                </p>
                            </div>
                        </div>
                        
                        <div class="custom-menu overflow-hidden">
                            <ul class="profile-body">
                                {{--  <li class="d-flex">
                                    <svg class="svg-color">
                                        <use href="{{ asset('admin/assets/svg/iconly-sprite.svg#Profile') }}"></use>
                                    </svg>
                                    <a class="ms-2" href="
                                    
                                    ">User Profile</a>
                                </li>  --}}
                                <li class="d-flex">
                                    <svg class="svg-color">
                                        <use href="{{ asset('admin/assets/svg/iconly-sprite.svg#Login') }}"></use>
                                    </svg>
                                    <form action="{{ route('logout') }}" method="POST" class="ms-2">
                                        @csrf
                                        <button type="submit" class="bg-transparent border-0 p-0 m-0">Log Out</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                        
            </ul>
        </div>
    </div>
</header>