@extends('admin.layout.main')

@section('title', 'Danh muc')
@section('page_title', 'Danh muc')
@section('breadcrumb', 'Danh muc')

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Quan ly danh muc',
        'heroSubtitle' => 'Cay danh muc cho san pham va tin tuc tren website.',
        'heroPrimaryRoute' => route('admin.categories.create'),
        'heroPrimaryLabel' => 'Them danh muc',
    ])

    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">Card Tables</h4>
        </div>

        <div class="card-body border border-dashed border-end-0 border-start-0">
            <form method="GET" action="{{ route('admin.categories.index') }}" class="mb-3">
                <div class="row g-2 align-items-center">
                    <div class="col-lg-5">
                        <input
                            type="text"
                            class="form-control"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Tim theo ten danh muc hoac ID"
                        >
                    </div>
                    <div class="col-lg-3">
                        <select class="form-select" name="type">
                            <option value="">Tat ca loai</option>
                            <option value="product" {{ request('type') === 'product' ? 'selected' : '' }}>San pham</option>
                            <option value="news" {{ request('type') === 'news' ? 'selected' : '' }}>Tin tuc</option>
                        </select>
                    </div>
                    <div class="col-lg-auto">
                        <button type="submit" class="btn btn-primary">Tim kiem</button>
                    </div>
                    <div class="col-lg-auto">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-light">Dat lai</a>
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
                                    <input class="form-check-input" type="checkbox" value="" id="categoryTableCheck" disabled>
                                    <label class="form-check-label" for="categoryTableCheck"></label>
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
                        @if ($isFiltered)
                            @forelse ($categories as $category)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="categoryTableCheck{{ $category->id }}">
                                            <label class="form-check-label" for="categoryTableCheck{{ $category->id }}"></label>
                                        </div>
                                    </td>
                                    <td><a href="{{ route('admin.categories.edit', $category) }}" class="fw-medium">#CT{{ str_pad((string) $category->id, 4, '0', STR_PAD_LEFT) }}</a></td>
                                    <td>
                                        <div class="fw-semibold">{{ $category->name }}</div>
                                        <div class="text-muted small">{{ $category->slug }}</div>
                                    </td>
                                    <td>{{ optional($category->updated_at ?? $category->created_at)->format('d M, Y') ?? '-' }}</td>
                                    <td>{{ $category->type === 'news' ? 'Tin tuc' : 'San pham' }}</td>
                                    <td>
                                        <span class="badge {{ $category->status ? 'bg-success' : 'bg-danger' }}">
                                            {{ $category->status ? 'Paid' : 'Refund' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-3">
                                            <a href="{{ route('admin.categories.edit', $category) }}" class="text-primary" title="View">
                                                <i class="ri-eye-fill fs-16"></i>
                                            </a>
                                            <a href="{{ route('admin.categories.edit', $category) }}" class="text-primary" title="Sua">
                                                <i class="ri-pencil-fill fs-16"></i>
                                            </a>
                                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Ban co chac muon xoa category nay?')">
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
                        @else
                            @foreach ($categories as $category)
                                @include('admin.category.product-like-row', ['category' => $category, 'level' => 0])
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-body">
            @if ($isFiltered)
                {{ $categories->links('pagination::bootstrap-4') }}
            @endif
        </div>
    </div>
@endsection
