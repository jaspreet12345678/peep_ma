<!-- Modal for Editing User -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" role="dialog" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">{{ __('messages.user_edit_user') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                    @csrf
                    @method('post')
                    <input type="hidden" class="form-control" id="editUserId" name="id" >
                    <div class="mb-1">
                        <label class="col-form-label" for="editUserName">{{ __('messages.user_nom_et_prénom') }}</label>
                        <input type="text" class="form-control" id="editUserName" name="name">
                    </div>
                    <div class="mb-1">
                        <label class="col-form-label" for="editUserEmail">{{ __('messages.user_email') }}</label>
                        <input type="email" class="form-control" id="editUserEmail" name="email">
                    </div>
                    <div class="mb-1">
                        <label class="col-form-label" for="editUserPassword">{{ __('messages.user_password') }}</label>
                        <input type="password" id="editUserPassword" class="form-control" name="password" placeholder="">
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="editUserEcole">Ecoles</label>
                        <select id="editUserEcole" class="form-select text-capitalize mb-md-0" name="ecole">
                            <option value="">{{ __('messages.user_please_select_the_establishment_your_child_attends') }}</option>
                            @foreach($ecoles as $ecole)
                                <option value="{{ $ecole->id }}">{{ $ecole->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="editUserRole" class="form-label">{{ __('messages.user_role') }}</label>
                        <select  id="editUserRole" class="form-select text-capitalize mb-md-0" name="role">
                            <option value="">{{ __('messages.user_select_role') }}</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-1 d-flex justify-content-between">
                        <div>
                            <label class="col-form-label" for="mode">{{ __('messages.user_status') }}</label>
                            <label class="switch">
                                <input type="checkbox" id="mode" name="mode" value="1" {{ 1 == 1 ? 'checked' : '' }}>
                                <span class="slider round"></span>
                            </label>
                            <span id="statusText"></span> <!-- Display status text here -->
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('messages.user_edit_button') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
