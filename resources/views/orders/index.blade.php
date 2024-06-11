@extends('layouts.app')
@section('title','PEEP - Assurances')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/pages/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/pages/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/pages/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/custom/users.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    div#modals-slide-in {
        position: fixed;
        z-index: 10600;
        right: 0;
        top: 0;
        opacity: 1;
    }
</style>
@endpush

@section('content')
<section id="input-group-basic">
    <div class="row">
        <!-- Basic -->
        <div class="col-md-12">
            <div class="card p-1">
                <div id="success-message" class="alert alert-success" style="display:none;">
                </div>
                {{-- <div class="row mt-1 justify-content-between" id="search-role"> --}}
                    <div class="col-md-4 d-flex">

                    </div>
                {{-- </div> --}}
                <div class="card-datatable table-responsive pt-0 mt-1">
                    <table class="dt-column-search datatables-basic table" id="order_table">
                        @csrf
                        <thead>
                            <tr>
                                <th>{{ __('messages.order_parents') }}</th>
                                <th>{{ __('messages.order_tel') }}</th>
                                <th>{{ __('messages.order_email') }}</th>
                                <th>{{ __('messages.order_num_de_commande') }}</th>
                                <th>{{ __('messages.order_total') }}</th>
                                <th>{{ __('messages.order_status') }}</th>
                                <th>{{ __('messages.order_utilisateur') }}</th>
                                <th>{{ __('messages.order_mode') }}</th>
                                <th>{{ __('messages.order_cash_2023') }}</th>
                                <th>{{ __('messages.order_date') }}</th>
                                <th>{{ __('messages.order_Action') }}</th>
                            </tr>
                        </thead>
                    </table>
                    <table id="tempTable" style="display: none;">
                        <thead>
                            <tr>
                                <th>{{ __('messages.order_parents') }}</th>
                                <th>{{ __('messages.order_tel') }}</th>
                                <th>{{ __('messages.order_email') }}</th>
                                <th>{{ __('messages.order_num_de_commande') }}</th>
                                <th>{{ __('messages.order_total') }}</th>
                                <th>{{ __('messages.order_status') }}</th>
                                <th>{{ __('messages.order_utilisateur') }}</th>
                                <th>{{ __('messages.order_mode') }}</th>
                                <th>{{ __('messages.order_cash_2023') }}</th>
                                <th>{{ __('messages.order_date') }}</th>
                                <th>{{ __('messages.order_Action') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-slide-in fade" id="modals-slide-in" style="overflow: scroll;">
                    <button type="button" id="side-close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="sidebar-sm sssss">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('orders.modals.updateStatusModal')
@endsection

@push('scripts')
<script src="{{ asset('assets/js/custom/orders.js') }}"></script>
<script src="{{ asset('/assets/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('/assets/DataTables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/assets/DataTables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/assets/DataTables/buttons.flash.min.js') }}"></script>
<script src="{{ asset('/assets/DataTables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/assets/DataTables/select2.min.js') }}"></script>
<script src="{{ asset('/assets/DataTables/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('/assets/DataTables/buttons.print.min.js') }}"></script>
<script src="{{ asset('/assets/DataTables/pdfmake.min.js') }}"></script>
<script src="{{ asset('/assets/DataTables/vfs_fonts.js') }}"></script>
<script src="{{ asset('/assets/DataTables/jszip.min.js') }}"></script>
@endpush
