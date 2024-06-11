@extends('layouts.app')
@section('title','PEEP - Enfants')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/pages/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/pages/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/pages/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/custom/users.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    div#modals-slide-in {
        position: fixed;
        z-index: 10800;
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
                <div class="row mt-1 justify-content-between" id="search_school">
                    <div class="col-md-4 d-flex">
                    </div>
                </div>
                <div class="card-datatable table-responsive pt-0 mt-1">
                    <table class="dt-column-search datatables-basic table" id="child_table">
                        <thead>
                            <tr>
                                <th>{{ __('messages.children_Enfants') }}</th>
                                <th>{{ __('messages.children_Ecole') }}</th>
                                <th>{{ __('messages.children_Classe') }}</th>
                                <th>{{ __('messages.children_Assurance_Scolaire') }}</th>
                                <th>{{ __('messages.children_Assurance_frais') }}</th>
                                <th>{{ __('messages.children_Attestation_Num') }}</th>
                                <th>{{ __('messages.children_Parents') }}</th>
                                <th>{{ __('messages.children_Tel_Parent') }}</th>
                                <th>{{ __('messages.children_Email_Parent') }}</th>
                                <th>{{ __('messages.children_Date_de_Naissance') }}</th>
                                <th>{{ __('messages.children_Actions') }}</th>
                            </tr>
                        </thead>
                        <table id="tempTable" style="display: none;">
                            <thead>
                            <tr>
                                <th>{{ __('messages.children_Enfants') }}</th>
                                <th>{{ __('messages.children_Ecole') }}</th>
                                <th>{{ __('messages.children_Classe') }}</th>
                                <th>{{ __('messages.children_Assurance_Scolaire') }}</th>
                                <th>{{ __('messages.children_Assurance_frais') }}</th>
                                <th>{{ __('messages.children_Attestation_Num') }}</th>
                                <th>{{ __('messages.children_Parents') }}</th>
                                <th>{{ __('messages.children_Tel_Parent') }}</th>
                                <th>{{ __('messages.children_Email_Parent') }}</th>
                                <th>{{ __('messages.children_Date_de_Naissance') }}</th>
                                <th>{{ __('messages.children_Actions') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-slide-in fade" id="modals-slide-in" style="overflow: scroll;">
                    <button type="button" id="side-close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="sidebar-sm sssss1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/custom/childs.js') }}"></script>
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
