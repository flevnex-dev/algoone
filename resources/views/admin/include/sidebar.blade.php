<aside class="page-sidebar">
    <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
    <div class="main-sidebar" id="main-sidebar">
        <ul class="sidebar-menu" id="simple-bar">
            <li class="pin-title sidebar-main-title">
                <div><h5 class="sidebar-title f-w-700">Pinned</h5></div>
            </li>

            <li class="sidebar-main-title">
                <div><h5 class="lan-1 f-w-700 sidebar-title">General</h5></div>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link " href="{{ route('admin.dashboard') }}">
                    <svg class="stroke-icon"><use href="{{ url('/assets') }}/svg/iconly-sprite.svg#Home-dashboard"></use></svg>
                    <h6 class="f-w-600">Dashboard</h6>
                </a>
            </li>

            <li class="sidebar-main-title">
                <div><h5 class="lan-11 f-w-700 sidebar-title">Site Management</h5></div>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link" href="{{ route('admin.topbars.index') }}">
                    <svg class="stroke-icon"><use href="{{ url('/assets') }}/svg/iconly-sprite.svg#Star"></use></svg>
                    <h6 class="f-w-600">Topbars</h6>
                </a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link" href="{{ route('admin.hero.index') }}">
                    <svg class="stroke-icon"><use href="{{ url('/assets') }}/svg/iconly-sprite.svg#Home"></use></svg>
                    <h6 class="f-w-600">Hero Section</h6>
                </a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link" href="{{ route('admin.signals.index') }}">
                    <svg class="stroke-icon"><use href="{{ url('/assets') }}/svg/iconly-sprite.svg#Activity"></use></svg>
                    <h6 class="f-w-600">Signals Section</h6>
                </a>
            </li>
             <li class="sidebar-list">
                <a class="sidebar-link" href="{{ route('admin.how-it-works.index') }}">
                    <svg class="stroke-icon"><use href="{{ url('/assets') }}/svg/iconly-sprite.svg#Info-Circle"></use></svg>
                    <h6 class="f-w-600">How It Works</h6>
                </a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link" href="{{ route('admin.results.index') }}">
                    <svg class="stroke-icon"><use href="{{ url('/assets') }}/svg/iconly-sprite.svg#Graph"></use></svg>
                    <h6 class="f-w-600">Results Section</h6>
                </a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link" href="{{ route('admin.why-choose.index') }}">
                    <svg class="stroke-icon"><use href="{{ url('/assets') }}/svg/iconly-sprite.svg#Star"></use></svg>
                    <h6 class="f-w-600">Why Choose Us</h6>
                </a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link" href="{{ route('admin.cta.index') }}">
                    <svg class="stroke-icon"><use href="{{ url('/assets') }}/svg/iconly-sprite.svg#Tick-square"></use></svg>
                    <h6 class="f-w-600">CTA Section</h6>
                </a>
            </li>

            <li class="sidebar-main-title">
                <div>
                    <h5 class="lan-11 f-w-700 sidebar-title">Global Settings</h5>
                </div>
            </li>

            <li class="sidebar-list">
                <a class="sidebar-link" href="{{ route('admin.site-settings.index') }}">
                    <svg class="stroke-icon"><use href="{{ url('/assets') }}/svg/iconly-sprite.svg#Setting"></use></svg>
                    <h6 class="f-w-600">Site Settings</h6>
                </a>
            </li>

            
            
            
        </ul>
    </div>
    <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
</aside>
