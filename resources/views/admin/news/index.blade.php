@extends('admin.layout.main')

@section('title', 'Tin tuc')
@section('page_title', 'Tin tuc')
@section('breadcrumb', 'Tin tuc')

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
        'heroTitle' => 'Quan ly tin tuc',
        'heroSubtitle' => 'Danh sach bai viet, danh muc va trang thai hien thi.',
        'heroPrimaryRoute' => route('admin.news.create'),
        'heroPrimaryLabel' => 'Them tin tuc',
    ])

    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">Card Tables</h4>
        </div>

        <div class="card-body border border-dashed border-end-0 border-start-0">
            <form method="GET" action="{{ route('admin.news.index') }}" class="mb-3">
                <div class="row g-2 align-items-center">
                    <div class="col-lg-5">
                        <input
                            type="text"
                            class="form-control"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Tim theo tieu de hoac ID"
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
                        <a href="{{ route('admin.news.index') }}" class="btn btn-light">Dat lai</a>
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
                                    <input class="form-check-input" type="checkbox" value="" id="newsTableCheck" disabled>
                                    <label class="form-check-label" for="newsTableCheck"></label>
                                </div>
                            </th>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Category</th>
                            <th scope="col">Status</th>
                            <th scope="col" style="width: 150px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($news as $item)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="newsTableCheck{{ $item->id }}">
                                        <label class="form-check-label" for="newsTableCheck{{ $item->id }}"></label>
                                    </div>
                                </td>
                                <td><a href="{{ route('admin.news.edit', $item) }}" class="fw-medium">#NW{{ str_pad((string) $item->id, 4, '0', STR_PAD_LEFT) }}</a></td>
                                <td>
                                    <div class="fw-semibold">{{ $item->title }}</div>
                                    <div class="text-muted small">{{ $item->slug }}</div>
                                </td>
                                <td>{{ optional($item->updated_at ?? $item->created_at)->format('d M, Y') ?? '-' }}</td>
                                <td>{{ optional($item->category)->name ?: '-' }}</td>
                                <td>
                                    <span class="badge {{ $item->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $item->status ? 'Paid' : 'Refund' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center gap-3">
                                        <a href="{{ route('admin.news.edit', $item) }}" class="text-primary" title="View">
                                            <i class="ri-eye-fill fs-16"></i>
                                        </a>
                                        <a href="{{ route('admin.news.edit', $item) }}" class="text-primary" title="Sua">
                                            <i class="ri-pencil-fill fs-16"></i>
                                        </a>
                                        <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Ban co chac muon xoa tin tuc nay?')">
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
            {{ $news->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
