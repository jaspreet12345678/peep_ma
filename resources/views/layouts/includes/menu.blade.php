@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/custom/menu.css') }}">
@endpush

<div class="horizontal-layout horizontal-menu  navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="">
    <div class="horizontal-menu-wrapper">
        <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-shadow menu-border container-xxl" role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
            <div class="shadow-bottom"></div>
            <!-- Horizontal menu content-->
            <div class="navbar-container main-menu-content" data-menu="menu-container">
                <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">

                    <li class="{{ request()->is('dashboard*') ? 'active' : '' }}" data-menu="">
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('/dashboard') }}" data-bs-toggle="" data-i18n="Email">
                            <i data-feather="home"></i>
                            <span data-i18n="Dashboards">{{ __('messages.dashboard') }}</span>
                        </a>
                    </li>

                    <li class="{{ request()->is('assurances*') ? 'active' : '' }}" data-menu="">
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('/assurances') }}" data-bs-toggle="" data-i18n="Calendar">
                            <i data-feather="calendar"></i>
                            <span data-i18n="Assurances">{{ __('messages.orders') }}</span>
                        </a>
                    </li>

                    <li class="{{ request()->is('parents*') ? 'active' : '' }}" data-menu="">
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('/parents') }}" data-bs-toggle="" data-i18n="Email">
                            <i data-feather="users"></i>
                            <span data-i18n="Parents">{{ __('messages.parents') }}</span>
                        </a>
                    </li>

                    <li class="{{ request()->is('enfants*') ? 'active' : '' }}" data-menu="">
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('/enfants') }}" data-bs-toggle="" data-i18n="Calendar">
                            <i data-feather="users"></i>
                            <span data-i18n="Enfants">{{ __('messages.children') }}</span>
                        </a>
                    </li>

                    <li class="{{ request()->is('users*') ? 'active' : '' }}" data-menu="">
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('/users') }}" data-bs-toggle="" data-i18n="Calendar">
                            <i data-feather="users"></i>
                            <span data-i18n="users">{{ __('messages.users') }}</span>
                        </a>
                    </li>

                    <li class="{{ request()->is('adhesions*') ? 'active' : '' }}" data-menu="">
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('/adhesions') }}" data-bs-toggle="" data-i18n="Calendar">
                            <i data-feather="shopping-cart"></i>
                            <span data-i18n="adhesions">{{ __('messages.invite') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- END: Main Menu-->

</div>

@push('scripts')
<script src="{{ asset('assets/js/custom/menu.js') }}"></script>
@endpush
