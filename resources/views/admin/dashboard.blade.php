@extends('admin.layout.main')

@section('title', 'Dashboard')
@section('page_title', 'Tong quan quan tri')
@section('breadcrumb', 'Dashboard')

@section('content')
<div class="row">
    @foreach ($stats as $item)
        <div class="col-md-6 col-xl-3">
            <div class="card card-animate border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-uppercase fw-medium text-muted mb-2">{{ $item['label'] }}</p>
                            <h3 class="mb-1">{{ number_format($item['count']) }}</h3>
                            <a href="{{ $item['route'] }}" class="link-primary text-decoration-none">Mo danh sach</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title rounded-circle fs-3 bg-{{ $item['color'] }}-subtle text-{{ $item['color'] }}">
                                <i class="{{ $item['icon'] }}"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="row mt-1">
    <div class="col-xl-7">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h4 class="card-title mb-0">Loi tat quan tri</h4>
            </div>
            <div class="card-body px-4 pb-4">
                <div class="row g-3">
                    @foreach ($quickLinks as $link)
                        <div class="col-md-6">
                            <a href="{{ $link['route'] }}" class="admin-shortcut-card">
                                <span class="admin-shortcut-icon"><i class="{{ $link['icon'] }}"></i></span>
                                <span class="admin-shortcut-text">{{ $link['label'] }}</span>
                                <i class="ri-arrow-right-up-line"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-5">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h4 class="card-title mb-0">Tom tat noi dung</h4>
            </div>
            <div class="card-body px-4 pb-4">
                @foreach ($contentSummary as $summary)
                    <div class="d-flex align-items-center justify-content-between py-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <div>
                            <h6 class="mb-1">{{ $summary['label'] }}</h6>
                            <p class="text-muted mb-0 small">So luong ban ghi hien co</p>
                        </div>
                        <span class="badge bg-light text-dark fs-6">{{ number_format($summary['count']) }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
