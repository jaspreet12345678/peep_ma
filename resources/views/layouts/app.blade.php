<!DOCTYPE html>
<html lang="fr">

<head>
    @include('layouts.includes.head')
</head>

<body>
    <div id="main">
        @guest
            @yield('content')
        @endguest

        @auth
            @include('layouts.includes.navbar')
            @include('layouts.includes.menu')
            <main class="main-content border-radius-lg">
                <div class="app-content content ">
                    <div class="content-overlay"></div>
                    <div class="header-navbar-shadow"></div>
                    <div class="content-wrapper container-xxl p-0 mt-3">
                        <div class="content-header row">
                        </div>
                        <div class="content-body">
                            <div class="card-datatable table-responsive pt-0">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            @include('layouts.includes.footer')
        @endauth
    </div>

   @include('layouts.includes.scripts')
   @stack('scripts')
</body>

</html>

