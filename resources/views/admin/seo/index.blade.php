@extends('admin.layout.main')

@section('title', 'SEO')
@section('page_title', 'SEO')
@section('breadcrumb', 'SEO')

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Quan ly SEO',
        'heroSubtitle' => 'Danh sach cau hinh URL, title va description cua website.',
        'heroPrimaryRoute' => route('admin.seo.create'),
        'heroPrimaryLabel' => 'Them SEO',
    ])

    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">Card Tables</h4>
        </div>

        <div class="card-body border border-dashed border-end-0 border-start-0">
            <form method="GET" action="{{ route('admin.seo.index') }}" class="mb-3">
                <div class="row g-2 align-items-center">
                    <div class="col-lg-6">
                        <input
                            type="text"
                            class="form-control"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Tim theo URL, title hoac ID"
                        >
                    </div>
                    <div class="col-lg-auto">
                        <button type="submit" class="btn btn-primary">Tim kiem</button>
                    </div>
                    <div class="col-lg-auto">
                        <a href="{{ route('admin.seo.index') }}" class="btn btn-light">Dat lai</a>
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
                                    <input class="form-check-input" type="checkbox" value="" id="seoTableCheck" disabled>
                                    <label class="form-check-label" for="seoTableCheck"></label>
                                </div>
                            </th>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">URL</th>
                            <th scope="col">Status</th>
                            <th scope="col" style="width: 150px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="seoTableCheck{{ $item->id }}">
                                        <label class="form-check-label" for="seoTableCheck{{ $item->id }}"></label>
                                    </div>
                                </td>
                                <td><a href="{{ route('admin.seo.edit', $item) }}" class="fw-medium">#SE{{ str_pad((string) $item->id, 4, '0', STR_PAD_LEFT) }}</a></td>
                                <td>
                                    <div class="fw-semibold">{{ $item->title ?: 'Khong co title' }}</div>
                                    <div class="text-muted small">{{ \Illuminate\Support\Str::limit($item->description, 60) ?: '-' }}</div>
                                </td>
                                <td>{{ optional($item->updated_at ?? $item->created_at)->format('d M, Y') ?? '-' }}</td>
                                <td>{{ $item->url }}</td>
                                <td><span class="badge bg-success">Paid</span></td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center gap-3">
                                        <a href="{{ route('admin.seo.edit', $item) }}" class="text-primary" title="View">
                                            <i class="ri-eye-fill fs-16"></i>
                                        </a>
                                        <a href="{{ route('admin.seo.edit', $item) }}" class="text-primary" title="Sua">
                                            <i class="ri-pencil-fill fs-16"></i>
                                        </a>
                                        <form action="{{ route('admin.seo.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Ban co chac muon xoa cau hinh nay?')">
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
