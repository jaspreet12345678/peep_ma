<!-- BEGIN: Header-->
<div class="horizontal-layout horizontal-menu  navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="">
    <nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center" data-nav="brand-center">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a href="/dashboard" class="logo navbar-brand">
                        <img src="{{ asset('assets/images/logo/new-logo-peep.png') }}" alt="PEEP" class="logo_default" height="50">
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar-container d-flex content">
            <ul class="nav navbar-nav align-items-center ms-auto">
                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{-- <div class="user-nav d-sm-flex d-none">
                            <span class="user-name fw-bolder">{{ auth()->user()->name }}</span>
                            <span class="user-status">{{ auth()->user()->role->name }}</span>
                        </div> --}}
                        <span class="avatar">

                            <img class="round" src="{{ asset('assets/images/avatars/OIP.jpeg') }}" alt="avatar" height="40" width="40">
                            <span class="avatar-status-online"></span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                        <div class="text-center">
                            <span class="user-name fw-bolder">{{ auth()->user()->name }}</span>
                        </div>
                        <div class="text-center mt-1">
                            <span class="user-status">{{ auth()->user()->role->name }}</span>
                        </div>
                        <a class="dropdown-item" href="#" id="logout-link">
                            <i class="me-50" data-feather="power"></i> {{ __('messages.sign_out') }}
                        </a>
                        <form id="logout-form" action="/logout" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('logout-link').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        });
    });
</script>
