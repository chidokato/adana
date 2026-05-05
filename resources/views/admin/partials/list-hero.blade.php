@php
    $heroTitle = $heroTitle ?? 'Dashboard';
    $heroSubtitle = $heroSubtitle ?? null;
    $heroPrimaryRoute = $heroPrimaryRoute ?? null;
    $heroPrimaryLabel = $heroPrimaryLabel ?? null;
    $heroPrimaryForm = $heroPrimaryForm ?? null;
    $heroPrimaryType = $heroPrimaryType ?? ($heroPrimaryForm ? 'submit' : 'link');
    $heroSecondaryRoute = $heroSecondaryRoute ?? null;
    $heroSecondaryLabel = $heroSecondaryLabel ?? null;
@endphp

<div class="row mb-3 pb-1">
    <div class="col-12">
        <div class="d-flex align-items-lg-center justify-content-between flex-lg-row flex-column gap-3">
            <div class="flex-grow-1">
                <h4 class="fs-16 mb-1">{{ $heroTitle }}</h4>
                @if ($heroSubtitle)
                    <p class="text-muted mb-0">{{ $heroSubtitle }}</p>
                @endif
            </div>

            @if ($heroPrimaryLabel || $heroSecondaryLabel)
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    @if ($heroSecondaryRoute && $heroSecondaryLabel)
                        <a href="{{ $heroSecondaryRoute }}" class="btn btn-light material-shadow-none">
                            {{ $heroSecondaryLabel }}
                        </a>
                    @endif

                    @if ($heroPrimaryType === 'submit' && $heroPrimaryLabel)
                        <button type="submit" form="{{ $heroPrimaryForm }}" class="btn btn-soft-success material-shadow-none">
                            <i class="ri-save-3-line align-middle me-1"></i>{{ $heroPrimaryLabel }}
                        </button>
                    @elseif ($heroPrimaryRoute && $heroPrimaryLabel)
                        <a href="{{ $heroPrimaryRoute }}" class="btn btn-soft-success material-shadow-none">
                            <i class="ri-add-circle-line align-middle me-1"></i>{{ $heroPrimaryLabel }}
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
