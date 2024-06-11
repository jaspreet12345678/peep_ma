<!DOCTYPE html>
<html lang="fr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="apple-touch-icon" href="https://peep.ma/wp-content/uploads/2023/04/cropped-favicon-180x180.png">
<link rel="shortcut icon" type="image/x-icon" href="https://peep.ma/wp-content/uploads/2023/04/cropped-favicon-192x192.png">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
<title>
    @yield('title')
</title>

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-extended.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/colors.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/components.css') }}">
<!-- END: Theme CSS-->

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/core/menu/menu-types/vertical-menu.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/authentication.css') }}">
{{-- <!-- END: Page CSS--> --}}
<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN End Vendor JS-->
<link rel="stylesheet" href="{{ asset('assets/css/custom/login.css') }}">
</head>

<body>
    <div id="main">
        @yield('content')
    </div>
   @stack('scripts')
</body>
</html>

