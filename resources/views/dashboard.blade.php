@extends('layouts.app')
@section('title','Dashboard')

@push('styles')
<style>
        .horizontal-menu .header-navbar.navbar-horizontal ul#main-menu-navigation>li.active>a {
            background: linear-gradient(118deg, #0071BB, rgba(0, 113, 187, 1));
            box-shadow: 0px 0px 6px 1px rgba(0, 113, 187, 1);
        }
    </style>
@endpush

@section('content')
        <!-- BEGIN: Main Menu-->

@endsection

@push('scripts')

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
@endpush
