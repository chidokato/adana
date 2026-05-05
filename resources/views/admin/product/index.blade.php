@extends('admin.layout.main')

@section('title', 'San pham')
@section('page_title', 'San pham')
@section('breadcrumb', 'San pham')

@section('content')
    @php
        $selectedCategoryId = (string) request('category_id');
        $categoryTree = $categories->whereNull('parent_id')->values();

        $renderCategoryOptions = function ($items, $level = 0) use (&$renderCategoryOptions, $selectedCategoryId) {
            $html = '';

            foreach ($items as $item) {
                $prefix = $level > 0 ? str_repeat('-- ', $level) : '';
                $selected = $selectedCategoryId === (string) $item->id ? ' selected' : '';
                $html .= '<option value="' . e($item->id) . '"' . $selected . '>' . e($prefix . $item->name) . '</option>';

                if ($item->children->isNotEmpty()) {
                    $html .= $renderCategoryOptions($item->children, $level + 1);
                }
            }

            return $html;
        };
    @endphp

    @include('admin.partials.list-hero', [
        'heroTitle' => 'Quan ly san pham',
        'heroSubtitle' => 'Danh sach san pham, gia ban va trang thai hien thi.',
        'heroPrimaryRoute' => route('admin.products.create'),
        'heroPrimaryLabel' => 'Them san pham',
    ])

    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">Card Tables</h4>
        </div>

        <div class="card-body border border-dashed border-end-0 border-start-0">
            <form method="GET" action="{{ route('admin.products.index') }}" class="mb-3">
                <div class="row g-2 align-items-center">
                    <div class="col-lg-5">
                        <input
                            type="text"
                            class="form-control"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Tim theo ten, ma san pham hoac ID"
                        >
                    </div>
                    <div class="col-lg-3">
                        <select class="form-select" name="category_id">
                            <option value="">Tat ca danh muc</option>
                            {!! $renderCategoryOptions($categoryTree) !!}
                        </select>
                    </div>
                    <div class="col-lg-auto">
                        <button type="submit" class="btn btn-primary">Tim kiem</button>
                    </div>
                    <div class="col-lg-auto">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-light">Dat lai</a>
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
                                    <input class="form-check-input" type="checkbox" value="" id="cardtableCheck" disabled>
                                    <label class="form-check-label" for="cardtableCheck"></label>
                                </div>
                            </th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Category</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col" style="width: 150px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $item)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="cardtableCheck{{ $item->id }}">
                                        <label class="form-check-label" for="cardtableCheck{{ $item->id }}"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $item->title }}</div>
                                    <div class="text-muted small">{{ $item->slug }}</div>
                                </td>
                                <td>{{ optional($item->updated_at ?? $item->created_at)->format('d M, Y') ?? '-' }}</td>
                                <td>{{ optional($item->category)->name ?: '-' }}</td>
                                <td>{{ $item->price !== null ? '$' . number_format((float) $item->price, 2) : '-' }}</td>
                                <td>
                                    <span class="badge {{ $item->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $item->status ? 'Paid' : 'Refund' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center gap-3">
                                        <a href="{{ route('admin.products.edit', $item) }}" class="text-primary" title="View">
                                            <i class="ri-eye-fill fs-16"></i>
                                        </a>
                                        <a href="{{ route('admin.products.edit', $item) }}" class="text-primary" title="Sua">
                                            <i class="ri-pencil-fill fs-16"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Ban co chac muon xoa san pham nay?')">
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
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
