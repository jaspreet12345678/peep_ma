
<div class="card">
    <div class="card-body overflow-auto" style="height: 100vh;">
        <h4 class="fw-bolder border-bottom pb-50 mb-1">{{ __('messages.parent_Details') }}</h4>
        <div class="info-container">
            <ul class="list-unstyled">
                <li class="mb-75">
                    <span class="fw-bolder me-25">{{ __('messages.parent_nom') }}:</span>
                    <span>{{ $parent->nom }}</span>
                </li>
                <li class="mb-75">
                    <span class="fw-bolder me-25">{{ __('messages.parent_prenom') }}:</span>
                    <span>{{ $parent->prenom }}</span>
                </li>
                <li class="mb-75">
                    <span class="fw-bolder me-25">{{ __('messages.parent_email') }}:</span>
                    <span>{{ $parent->email }}</span>
                </li>
                <li class="mb-75">
                    <span class="fw-bolder me-25">{{ __('messages.parent_role') }}:</span>
                    <span>{{ $parent->role }}</span>
                </li>
                <li class="mb-75">
                    <span class="fw-bolder me-25">{{ __('messages.parent_tel') }}:</span>
                    <span>{{ $parent->telephone }}</span>
                </li>
                <li class="mb-75">
                    <span class="fw-bolder me-25">{{ __('messages.parent_password') }}:</span>
                    <span>{{ $parent->password }}</span>
                </li>
            </ul>
        </div>

        @foreach ($parent->enfants as $index => $enfant)
            <h4 class="fw-bolder border-bottom pb-50 mb-1">{{ __('messages.parent_enfant') }} {{ $index + 1 }}</h4>
            <div class="info-container">
                <ul class="list-unstyled">
                    <li class="mb-75">
                        <span class="fw-bolder me-25">{{ __('messages.parent_Nom_Prenom') }}</span>
                        <span>{{ $enfant->nom }} {{ $enfant->prenom }}</span>
                    </li>
                    <li class="mb-75">
                        <span class="fw-bolder me-25">{{ __('messages.parent_Daten') }}:</span>
                        <span>{{ $enfant->created_at->format('Y-m-d') }}</span>
                    </li>
                    <li class="mb-75">
                        <span class="fw-bolder me-25">{{ __('messages.parent_Ecole') }}:</span>
                        <span>{{ $enfant->ecole->name }}</span>
                    </li>
                    <li class="mb-75">
                        <span class="fw-bolder me-25">{{ __('messages.parent_Class') }}:</span>
                        <span>{{ $enfant->class->name }}</span>
                    </li>
                </ul>
            </div>
        @endforeach
    </div>
</div>
