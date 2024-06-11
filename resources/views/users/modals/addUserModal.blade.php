<!-- Modal for Adding User -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">{{ __('messages.user_add_user') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addUserForm" >
                    @csrf
                    @method('post')
                    <div class="mb-1">
                        <label class="col-form-label" for="name">{{ __('messages.user_nom_et_prénom') }}</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="userName" name="name" >
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <label class="col-form-label" for="email">{{ __('messages.user_email') }}</label>
                        <input type="email" class="form-control" id="userEmail" name="email">
                    </div>
                    <div class="mb-1">
                        <label class="col-form-label" for="password">{{ __('messages.user_password') }}</label>
                        <input type="password" id="password" class="form-control" name="password" placeholder="">
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="ecole">{{ __('messages.user_school') }}</label>
                        <select type="text" id="ecole" class="form-select text-capitalize mb-md-0" name="ecole">
                            <option value="">{{ __('messages.user_please_select_the_establishment_your_child_attends') }}</option>
                            @foreach($ecoles as $ecole)
                                <option value="{{ $ecole->id }}">{{ $ecole->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="role">{{ __('messages.user_role') }}</label>
                        <select type="text" id="role" class="form-select text-capitalize mb-md-0" name="role">
                            <option value="">{{ __('messages.user_select_role') }}</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('messages.user_add_user') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
