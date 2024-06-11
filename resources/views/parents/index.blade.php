@extends('layouts.app')
@section('title','PEEP - Parents')

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
                        <div class="col-md-8 ">
                            <label class="form-label" for="parentSchool">{{ __('messages.user_ecoles') }}</label>
                            <select id="parentSchool" class="form-select text-capitalize mb-md-0">
                                <option value="">{{ __('messages.user_please_select_the_establishment_your_child_attends') }}</option>
                                @foreach($ecoles as $school)
                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-datatable table-responsive pt-0 mt-1">
                    <table class="dt-column-search datatables-basic table" id="parent_table">
                        <thead>
                            <tr>
                                <th>{{ __('messages.parent_date_dernier_paiement') }}</th>
                                <th>{{ __('messages.parent_num_d_Adhésion') }}</th>
                                <th>{{ __('messages.parent_parents') }}</th>
                                <th>{{ __('messages.parent_tel') }}</th>
                                <th>{{ __('messages.parent_email') }}</th>
                                <th>{{ __('messages.parent_adherent') }}</th>
                                <th>{{ __('messages.parent_enfant_assuré') }}</th>
                                <th>{{ __('messages.parent_nb_enfants') }}</th>
                                <th>{{ __('messages.parent_role') }}</th>
                                <th>{{ __('messages.parent_ecole') }}</th>
                                <th>{{ __('messages.parent_classes') }}</th>
                                <th>{{ __('messages.parent_Action') }}</th>
                            </tr>
                        </thead>
                        <table id="tempTable" style="display: none;">
                            <thead>
                            <tr>
                                <th>{{ __('messages.parent_date_dernier_paiement') }}</th>
                                <th>{{ __('messages.parent_num_d_Adhésion') }}</th>
                                <th>{{ __('messages.parent_parents') }}</th>
                                <th>{{ __('messages.parent_tel') }}</th>
                                <th>{{ __('messages.parent_email') }}</th>
                                <th>{{ __('messages.parent_adherent') }}</th>
                                <th>{{ __('messages.parent_enfant_assuré') }}</th>
                                <th>{{ __('messages.parent_nb_enfants') }}</th>
                                <th>{{ __('messages.parent_role') }}</th>
                                <th>{{ __('messages.parent_ecole') }}</th>
                                <th>{{ __('messages.parent_classes') }}</th>
                                <th>{{ __('messages.parent_Action') }}</th>
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
<script src="{{ asset('assets/js/custom/parents.js') }}"></script>
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
