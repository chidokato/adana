@extends('admin.layout.main')

@section('title', 'Slider & banner')
@section('page_title', 'Slider & banner')
@section('breadcrumb', 'Slider & banner')

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Quan ly slider va banner',
        'heroSubtitle' => 'Danh sach hinh anh truyen thong va vi tri hien thi.',
        'heroPrimaryRoute' => route('admin.media-banners.create'),
        'heroPrimaryLabel' => 'Them moi',
    ])

    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">Card Tables</h4>
        </div>

        <div class="card-body border border-dashed border-end-0 border-start-0">
            <form method="GET" action="{{ route('admin.media-banners.index') }}" class="mb-3">
                <div class="row g-2 align-items-center">
                    <div class="col-lg-4">
                        <select class="form-select" name="type">
                            <option value="">Tat ca loai</option>
                            <option value="slider" {{ request('type') === 'slider' ? 'selected' : '' }}>Slider</option>
                            <option value="banner" {{ request('type') === 'banner' ? 'selected' : '' }}>Banner</option>
                        </select>
                    </div>
                    <div class="col-lg-auto">
                        <button type="submit" class="btn btn-primary">Tim kiem</button>
                    </div>
                    <div class="col-lg-auto">
                        <a href="{{ route('admin.media-banners.index') }}" class="btn btn-light">Dat lai</a>
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
                                    <input class="form-check-input" type="checkbox" value="" id="mediaTableCheck" disabled>
                                    <label class="form-check-label" for="mediaTableCheck"></label>
                                </div>
                            </th>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Type</th>
                            <th scope="col">Status</th>
                            <th scope="col" style="width: 150px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="mediaTableCheck{{ $item->id }}">
                                        <label class="form-check-label" for="mediaTableCheck{{ $item->id }}"></label>
                                    </div>
                                </td>
                                <td><a href="{{ route('admin.media-banners.edit', $item) }}" class="fw-medium">#MB{{ str_pad((string) $item->id, 4, '0', STR_PAD_LEFT) }}</a></td>
                                <td>
                                    <div class="fw-semibold">{{ $item->title ?: 'Khong co tieu de' }}</div>
                                    <div class="text-muted small">{{ $item->link ?: '-' }}</div>
                                </td>
                                <td>{{ optional($item->updated_at ?? $item->created_at)->format('d M, Y') ?? '-' }}</td>
                                <td>{{ $item->type === 'slider' ? 'Slider' : 'Banner' }}</td>
                                <td>
                                    <span class="badge {{ $item->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $item->status ? 'Paid' : 'Refund' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center gap-3">
                                        <a href="{{ route('admin.media-banners.edit', $item) }}" class="text-primary" title="View">
                                            <i class="ri-eye-fill fs-16"></i>
                                        </a>
                                        <a href="{{ route('admin.media-banners.edit', $item) }}" class="text-primary" title="Sua">
                                            <i class="ri-pencil-fill fs-16"></i>
                                        </a>
                                        <form action="{{ route('admin.media-banners.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Ban co chac muon xoa muc nay?')">
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
                                <td colspan="7" class="text-center text-muted py-4">No data found.</td>
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
