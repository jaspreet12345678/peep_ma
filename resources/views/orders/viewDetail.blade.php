<div class="card">
    <div class="card-body overflow-auto" style="height: 100vh;">
        <div class="user-avatar-section">
            <div class="d-flex align-items-center flex-column">
                <div class="user-info text-center">
                    <h4>{{ $order->code }}</h4>
                    <span class="badge bg-light-secondary">{{ __('messages.order_vior_commande_num') }}</span>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-around my-2 pt-75">
            <div class="d-flex align-items-start me-2">
                <div class="ms-30">
                    <h4 class="mb-0">{{ intval($order->total_amount) }} {{ __('messages.order_vior_dhs') }}</h4>
                    <small>{{ __('messages.order_total') }}</small>
                </div>
            </div>
            <div class="d-flex align-items-start me-2">
                <div class="ms-30">
                    <h4 class="mb-0">{{ $order->mode }}</h4>
                    <small>{{ __('messages.order_mode') }}</small>
                </div>
            </div>
            <div class="d-flex align-items-start">
                <div class="ms-40">
                    <h4 class="mb-0">{{ $order->created_at }}</h4>
                    <small>{{ __('messages.order_date') }}</small>
                </div>
            </div>
        </div>
        <h4 class="fw-bolder border-bottom pb-50 mb-1">{{ __('messages.order_vior_details_parent') }}</h4>
        <div class="info-container">
            <ul class="list-unstyled">
                <li class="mb-75">
                    <span class="fw-bolder me-25">{{ __('messages.order_vior_nom') }}:</span>
                    <span>{{ $order->parent_nom }}</span>
                </li>
                <li class="mb-75">
                    <span class="fw-bolder me-25">{{ __('messages.order_vior_prenom') }}:</span>
                    <span>{{ $order->parent_prenom }}</span>
                </li>
                <li class="mb-75">
                    <span class="fw-bolder me-25">{{ __('messages.order_email') }}:</span>
                    <span>{{ $order->parent_email }}</span>
                </li>
                {{-- <li class="mb-75">
                    <span class="fw-bolder me-25">Role:</span>
                    <span>{{ $order->parent_role }}</span>
                </li> --}}
                <li class="mb-75">
                    <span class="fw-bolder me-25">{{ __('messages.order_vior_telephone') }}:</span>
                    <span>{{ $order->parent_telephone }}</span>
                </li>
            </ul>
        </div>
        @foreach ($order->enfants as $enfant)
            <h4 class="fw-bolder border-bottom pb-50 mb-1">{{ __('messages.order_vior_enfant') }} {{ $loop->iteration }}</h4>
            <div class="info-container">
                <ul class="list-unstyled">
                    <li class="mb-75">
                        <span class="fw-bolder me-25">{{ __('messages.order_vior_nom_prenom') }}:</span>
                        <span>{{ $enfant->nom }} {{ $enfant->prenom }}</span>
                    </li>
                    <li class="mb-75">
                        <span class="fw-bolder me-25">{{ __('messages.order_vior_assurance_scolaire') }}:</span>
                        <span>{{ $enfant->school_insurance }} {{ __('messages.order_vior_dhs') }}</span>
                    </li>
                    <li class="mb-75">
                        <span class="fw-bolder me-25">{{ __('messages.order_vior_assurance_frais_de_scolarité') }} :</span>
                        <span>{{ $enfant->tution_fee_insurance }} {{ __('messages.order_vior_dhs') }}</span>
                    </li>
                </ul>
            </div>
        @endforeach
        <div class="d-flex justify-content-around my-2 pt-75">
            <div class="d-flex align-items-start me-2">
                <div class="ms-50">
                    <h4 class="mb-0">{{ $order->adhesion ?? 0 }}</h4>
                    <small>{{ __('messages.order_vior_adhesion') }}</small>
                </div>
            </div>
            <div class="d-flex align-items-start">
                <div class="ms-50">
                    <h4 class="mb-0">{{ $order->contribution ?? 0 }}</h4>
                    <small>{{ __('messages.order_vior_contribution') }}</small>
                </div>
            </div>
        </div>
            <h4 class="fw-bolder border-bottom pb-50 mb-1">{{ __('messages.order_vior_date_status') }} {{ $orderHistory->created_at ?? '' }}</h4>
            <div class="info-container">
                <ul class="list-unstyled">
                    <li class="mb-75">
                        <span class="fw-bolder me-25">{{ __('messages.order_status') }}:</span>
                        <span>{{ $orderHistory->status ?? 0 }}</span>
                    </li>
                    <li class="mb-75">
                        <span class="fw-bolder me-25">{{ __('messages.order_vior_commentaire') }}:</span>
                        <span>{{ $orderHistory->comment ?? '' }}</span>
                    </li>
                </ul>
            </div>
    </div>
</div>
