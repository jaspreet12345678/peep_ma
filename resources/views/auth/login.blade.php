@extends('layouts.guest')

@section('title', 'Login Page-PeeP')

@push('styles')
@endpush

@section('content')
<div class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                <div class="auth-wrapper auth-cover">
                    <div class="auth-inner row m-0">
                        <!-- Brand logo -->
                        <a class="brand-logo" href="#">
                            <img src="{{ asset('assets/images/logo/new-logo-peep.png') }}" alt="PEEP" class="logo_default" height="50">
                        </a>
                        <!-- /Brand logo -->
                        <!-- Left Text -->
                        <div id="main-div" class="d-none d-lg-block col-lg-8 align-items-center p-5">
                            <div class="title">
                                <div class="w-100 d-lg-block align-items-center justify-content-center px-5">
                                    <h1>{{ __('messages.login_page_heading1') }} </br>{{ __('messages.login_page_heading2') }}</h1>
                                </div>
                                <br><br>
                                <div class="w-100 d-lg-block align-items-center justify-content-center px-5">
                                    <h3>{{ __('messages.login_page_heading3') }} </br>{{ __('messages.login_page_heading4') }} </br>{{ __('messages.login_page_heading5') }}<h3>
                                </div>
                            </div>
                        </div>
                        <!-- /Left Text -->
                        <!-- Login -->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                @if (session('error'))
                                    <div id="session-error-message" class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <form class="auth-login-form mt-2" method="POST" action="{{ route('login.perform') }}">
                                    @csrf
                                    <div class="mb-1">
                                        <label class="form-label" for="login-email">{{ __('messages.email') }}</label>
                                        <input class="form-control @error('email') is-invalid @enderror" id="login-email" type="text" name="email" aria-describedby="login-email" autofocus tabindex="1" />
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="password">{{ __('messages.login_password') }}</label>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="login-password" type="password" name="password" aria-describedby="login-password" tabindex="2" />
                                            <span class="input-group-text cursor-pointer" data-toggle-password><i data-feather="eye"></i></span>
                                        </div>
                                        @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-warning w-100" tabindex="4">{{ __('messages.login_in') }}</button>
                                </form>
                            </div>
                        </div>
                        <!-- /Login -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/custom/login.js') }}"></script>
<script>
    $(document).ready(function() {
        // Check if the session error message exists
        if ($('#session-error-message').length) {
            // Display the error message for 3 seconds and then fade out
            $('#session-error-message').delay(3000).fadeOut();
        }
    });
</script>
@endpush
