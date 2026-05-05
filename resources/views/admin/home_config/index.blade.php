@extends('admin.layout.main')

@section('title', 'Cau hinh trang chu')
@section('page_title', 'Cau hinh trang chu')
@section('breadcrumb', 'Cau hinh trang chu')

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Quan ly cau hinh trang chu',
        'heroSubtitle' => 'Danh sach section hien thi tren trang chu website.',
        'heroPrimaryRoute' => route('admin.home-configs.create'),
        'heroPrimaryLabel' => 'Them cau hinh',
    ])

    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">Card Tables</h4>
        </div>

        <div class="card-body border border-dashed border-end-0 border-start-0">
            <form method="GET" action="{{ route('admin.home-configs.index') }}" class="mb-3">
                <div class="row g-2 align-items-center">
                    <div class="col-lg-6">
                        <input
                            type="text"
                            class="form-control"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Tim theo key, tieu de hoac ID"
                        >
                    </div>
                    <div class="col-lg-auto">
                        <button type="submit" class="btn btn-primary">Tim kiem</button>
                    </div>
                    <div class="col-lg-auto">
                        <a href="{{ route('admin.home-configs.index') }}" class="btn btn-light">Dat lai</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="live-preview px-3 pb-3">
            <div class="table-responsive table-card">
                <table class="table align-middle table-nowrap table-striped-columns mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 46px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="homeConfigTableCheck" disabled>
                                    <label class="form-check-label" for="homeConfigTableCheck"></label>
                                </div>
                            </th>
                            <th scope="col">Key</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Image</th>
                            <th scope="col" style="width: 150px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="homeConfigTableCheck{{ $item->id }}">
                                        <label class="form-check-label" for="homeConfigTableCheck{{ $item->id }}"></label>
                                    </div>
                                </td>
                                <td><a href="{{ route('admin.home-configs.edit', $item) }}" class="fw-medium">#HC{{ str_pad((string) $item->id, 4, '0', STR_PAD_LEFT) }}</a></td>
                                <td>
                                    <div class="fw-semibold">{{ $item->section_key }}</div>
                                    <div class="text-muted small">{{ $item->title ?: '-' }}</div>
                                </td>
                                <td>{{ optional($item->updated_at ?? $item->created_at)->format('d M, Y') ?? '-' }}</td>
                                <td>
                                    @if ($item->image)
                                        <img src="{{ asset($item->image) }}" alt="{{ $item->section_key }}" style="width: 72px; height: 44px; object-fit: cover;" class="rounded border">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center gap-3">
                                        <a href="{{ route('admin.home-configs.edit', $item) }}" class="text-primary" title="View">
                                            <i class="ri-eye-fill fs-16"></i>
                                        </a>
                                        <a href="{{ route('admin.home-configs.edit', $item) }}" class="text-primary" title="Sua">
                                            <i class="ri-pencil-fill fs-16"></i>
                                        </a>
                                        <form action="{{ route('admin.home-configs.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Ban co chac muon xoa?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link p-0 text-danger" title="Xoa">
                                                <i class="ri-delete-bin-5-fill fs-16"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No data found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-body">
            {{ $items->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
