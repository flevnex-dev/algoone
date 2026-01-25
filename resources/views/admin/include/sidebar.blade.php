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
                    <svg class="stroke-icon"><use href="{{ url('/admin/assets') }}/svg/iconly-sprite.svg#Home-dashboard"></use></svg>
                    <h6 class="f-w-600">Dashboard</h6>
                </a>
            </li>

            <li class="sidebar-main-title">
                <div><h5 class="lan-11 f-w-700 sidebar-title">Site Management</h5></div>
            </li>
            <li class="sidebar-list"> <i class="fa-solid fa-thumbtack"></i><a class="sidebar-link" href="javascript:void(0)">
                <svg class="stroke-icon">
                  <use href="{{ url('/admin/assets') }}/svg/iconly-sprite.svg#Home"></use>
                </svg>
                <h6 class="f-w-600">Home</h6><i class="iconly-Arrow-Right-2 icli"></i></a>
              <ul class="sidebar-submenu">
                <li class="">
                    <a class="" href="{{ route('admin.topbars.index') }}">Topbars</a>
                </li>
                <li class="">
                    <a class="" href="{{ route('admin.hero.index') }}">Hero Section</a>
                </li>
                <li class="">
                    <a class="" href="{{ route('admin.signals.index') }}">Signals Section</a>
                </li>
                 <li class="">
                    <a class="" href="{{ route('admin.how-it-works.index') }}">How It Works</a>
                </li>
                <li class="">
                    <a class="" href="{{ route('admin.results.index') }}">Results Section</a>
                </li>
                <li class="">
                    <a class="" href="{{ route('admin.why-choose.index') }}">Why Choose Us</a>
                </li>
                <li class="">
                    <a class="" href="{{ route('admin.cta.index') }}">CTA Section</a>
                </li>
                 <li class="">
                    <a class="" href="{{ route('admin.referral.index') }}">Referral Section</a>
                </li>
              </ul>
            </li>
            <li class="sidebar-list"> <i class="fa-solid fa-thumbtack"></i><a class="sidebar-link" href="javascript:void(0)">
                <svg class="stroke-icon">
                  <use href="{{ url('/admin/assets') }}/svg/iconly-sprite.svg#Home"></use>
                </svg>
                <h6 class="f-w-600">Past Performance</h6><i class="iconly-Arrow-Right-2 icli"></i></a>
              <ul class="sidebar-submenu">
                <li class="">
                    <a class="" href="{{ route('admin.past-performance.index') }}">Past Performance Sections</a>
                </li>
                <li class="">
                    <a class="" href="{{ route('admin.trading-weeks.index') }}">Trading Weeks</a>
                </li>
                <li class="">
                    <a class="" href="{{ route('admin.week-performance.index') }}">Week Performance Data</a>
                </li>
              </ul>
            </li>
            <li class="sidebar-list"> <i class="fa-solid fa-thumbtack"></i><a class="sidebar-link" href="javascript:void(0)">
                <svg class="stroke-icon">
                  <use href="{{ url('/admin/assets') }}/svg/iconly-sprite.svg#Home"></use>
                </svg>
                <h6 class="f-w-600">Official Myfxbooks</h6><i class="iconly-Arrow-Right-2 icli"></i></a>
              <ul class="sidebar-submenu">
                <li class="">
                    <a class="" href="{{ route('admin.official-myfxbooks.index') }}">Official Myfxbooks Sections</a>
                </li>
                <li class="">
                    <a class="" href="{{ route('admin.myfxbook-accounts.index') }}">Myfxbook Accounts</a>
                </li>
              </ul>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link" href="{{ route('admin.progress-guidelines.index') }}">
                    <svg class="stroke-icon"><use href="{{ url('/admin/assets') }}/svg/iconly-sprite.svg#Setting"></use></svg>
                    <h6 class="f-w-600">Progress Guidelines</h6>
                </a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link" href="{{ route('admin.masterclass.index') }}">
                    <svg class="stroke-icon"><use href="{{ url('/admin/assets') }}/svg/iconly-sprite.svg#Setting"></use></svg>
                    <h6 class="f-w-600">Masterclass</h6>
                </a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link" href="{{ route('admin.buy-funding.index') }}">
                    <svg class="stroke-icon"><use href="{{ url('/admin/assets') }}/svg/iconly-sprite.svg#Setting"></use></svg>
                    <h6 class="f-w-600">Buy Funding</h6>
                </a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link" href="{{ route('admin.privacy-policy.index') }}">
                    <svg class="stroke-icon"><use href="{{ url('/admin/assets') }}/svg/iconly-sprite.svg#Setting"></use></svg>
                    <h6 class="f-w-600">Privacy Policy</h6>
                </a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link" href="{{ route('admin.terms-conditions.index') }}">
                    <svg class="stroke-icon"><use href="{{ url('/admin/assets') }}/svg/iconly-sprite.svg#Setting"></use></svg>
                    <h6 class="f-w-600">Terms & Conditions</h6>
                </a>
            </li>
            <li class="sidebar-list"> <i class="fa-solid fa-thumbtack"></i><a class="sidebar-link" href="javascript:void(0)">
                <svg class="stroke-icon">
                  <use href="{{ url('/admin/assets') }}/svg/iconly-sprite.svg#Home"></use>
                </svg>
                <h6 class="f-w-600">Payouts</h6><i class="iconly-Arrow-Right-2 icli"></i></a>
              <ul class="sidebar-submenu">
                <li class="">
                    <a class="" href="{{ route('admin.payouts.index') }}">Manage Payouts</a>
                </li>
                <li class="">
                    <a class="" href="{{ route('admin.live-results.index') }}">Live Results</a>
                </li>
              </ul>
            </li>

            <li class="sidebar-main-title">
                <div>
                    <h5 class="lan-11 f-w-700 sidebar-title">Global Settings</h5>
                </div>
            </li>

            <li class="sidebar-list">
                <a class="sidebar-link" href="{{ route('admin.site-settings.index') }}">
                    <svg class="stroke-icon"><use href="{{ url('/admin/assets') }}/svg/iconly-sprite.svg#Setting"></use></svg>
                    <h6 class="f-w-600">Site Settings</h6>
                </a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link" href="{{ route('admin.email-configuration.index') }}">
                    <svg class="stroke-icon"><use href="{{ url('/admin/assets') }}/svg/iconly-sprite.svg#Setting"></use></svg>
                    <h6 class="f-w-600">Email Configuration</h6>
                </a>
            </li>

            
            
            
        </ul>
    </div>
    <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
</aside>
