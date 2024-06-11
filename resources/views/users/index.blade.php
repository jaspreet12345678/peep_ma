@extends('layouts.app')
@section('title','Peep-Users')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/pages/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/pages/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/pages/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/custom/users.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<section id="input-group-basic">
    <div class="row">
        <!-- Basic -->
        <div class="col-md-12">
            <div class="card p-1">
                <div id="success-message" class="alert alert-success" style="display:none;">
                </div>
                <div class="row mt-1 justify-content-between" id="search-role">
                    <div class="col-md-4 d-flex">
                        <div class="col-md-4  user_plan">
                            <label class="form-label" for="UserPlan">{{ __('messages.user_role') }}</label>
                            <select id="UserPlan" class="form-select text-capitalize mb-md-0">
                                <option value="">{{ __('messages.user_select_role') }}</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 user_plan ms-1">
                            <label class="form-label" for="userStatus">Status</label>
                            <select id="userStatus" class="form-select text-capitalize mb-md-0">
                                <option value="">{{ __('messages.user_select_status') }}</option>
                                <option value=1>{{ __('messages.user_status_active') }}</option>
                                <option value=2>{{ __('messages.user_status_inactive') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2" style="padding-top: 14px;">
                        <button type="button" id="addUserButton" class="btn btn-primary me-2 waves-effect waves-float waves-light cus_css" data-bs-toggle="modal" data-bs-target="#addUserModal">{{ __('messages.user_add_user') }}</button>
                    </div>
                </div>
                <div class="card-datatable table-responsive pt-0 mt-1">
                    <table class="dt-column-search datatables-basic table" id="users_table">
                        @csrf
                        <thead>
                            <tr>
                                <th>{{ __('messages.user_last_name_first_name') }}</th>
                                <th>{{ __('messages.user_email') }}</th>
                                <th>{{ __('messages.user_school') }}</th>
                                <th>{{ __('messages.user_role') }}</th>
                                <th>{{ __('messages.user_status') }}</th>
                                <th>{{ __('messages.user_created_at') }}</th>
                                <th>{{ __('messages.user_actions') }}</th>
                            </tr>
                        </thead>
                    </table>
                    <table id="tempTable" style="display: none;">
                        <thead>
                            <tr>
                                <th>{{ __('messages.user_last_name_first_name') }}</th>
                                <th>{{ __('messages.user_email') }}</th>
                                <th>{{ __('messages.user_school') }}</th>
                                <th>{{ __('messages.user_role') }}</th>
                                <th>{{ __('messages.user_status') }}</th>
                                <th>{{ __('messages.user_created_at') }}</th>
                                <th>{{ __('messages.user_actions') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@include('users.modals.addUserModal')
@include('users.modals.editUserModal')
@endsection

@push('scripts')
<script src="{{ asset('assets/js/custom/users.js') }}"></script>
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
