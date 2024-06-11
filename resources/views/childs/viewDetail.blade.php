<div class="card">
    <div class="card-body overflow-auto" style="height: 100vh;">
      <div class="user-avatar-section">
        <div class="d-flex align-items-center flex-column">
          <div class="user-info text-center">
            <h2>Details</h2>
            <!-- <span class="badge bg-light-secondary">Code</span> -->
          </div>
        </div>
      </div>
      <h4 class="fw-bolder border-bottom pb-50 mb-1">Details Parent</h4>
      <div class="info-container">
        <ul class="list-unstyled">
          <li class="mb-75">
            <span class="fw-bolder me-25">{{ __('messages.children_nom') }}:</span>
            <span>{{ $parentDetail->parent_nom }}</span>
          </li>
          <li class="mb-75">
            <span class="fw-bolder me-25">{{ __('messages.children_prenom') }}:</span>
            <span>{{ $parentDetail->parent_prenom }}</span>
          </li>
          <li class="mb-75">
            <span class="fw-bolder me-25">{{ __('messages.children_email') }}:</span>
            <span>{{ $parentDetail->parent_email }}</span>
          </li>
          <li class="mb-75">
            <span class="fw-bolder me-25">{{ __('messages.children_tel') }}:</span>
            <span>{{ $parentDetail->parent_telephone }}</span>
          </li>
        </ul>
      </div>
      @foreach ($childDetail as $index => $child)
        <h4 class="fw-bolder border-bottom pb-50 mb-1">{{ __('messages.children_enfant') }} {{ $index + 1 }}</h4>
        <div class="info-container">

          <ul class="list-unstyled">
            <li class="mb-75">
              <span class="fw-bolder me-25">{{ __('messages.children_enfant') }}:</span>
              <span>{{$child->nom. ' ' . $child->prenom}}</span>
            </li>

            <li class="mb-75">
              <span class="fw-bolder me-25">{{ __('messages.children_Assurance_Scolaire') }}:</span>
              <span>{{$child->assurance_scolaire}} Dhs</span>
            </li>
            <li class="mb-75">
              <span class="fw-bolder me-25">{{ __('messages.children_Assurance_frais_de_Scolarité') }}:</span>
              <span>{{$child->assurance_frais}} Dhs</span>
            </li>
          </ul>
        </div>
      @endforeach
      <div class="d-flex justify-content-around my-2 pt-75">

        <div class="d-flex align-items-start me-2">

          <div class="ms-50">
            <h4 class="mb-0">{{$parentDetail->adhesion}} </h4>
            <small>{{ __('messages.children_Adhesion') }}</small>
          </div>
        </div>
        <div class="d-flex align-items-start">

          <div class="ms-50">
            <h4 class="mb-0">{{$parentDetail->contribution ?? 0}}</h4>
            <small>{{ __('messages.children_Contribution') }}</small>
          </div>
        </div>
      </div>
    </div>
  </div>
