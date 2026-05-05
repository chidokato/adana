@extends('admin.layout.main')

@section('title', 'Menu')
@section('page_title', 'Menu')
@section('breadcrumb', 'Menu')

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Quan ly menu',
        'heroSubtitle' => 'Danh sach menu dieu huong va vi tri hien thi.',
        'heroPrimaryRoute' => route('admin.menus.create'),
        'heroPrimaryLabel' => 'Them menu',
    ])

    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">Card Tables</h4>
        </div>

        <div class="card-body border border-dashed border-end-0 border-start-0">
            <form method="GET" action="{{ route('admin.menus.index') }}" class="mb-3">
                <div class="row g-2 align-items-center">
                    <div class="col-lg-6">
                        <input
                            type="text"
                            class="form-control"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Tim theo ten menu, vi tri hoac ID"
                        >
                    </div>
                    <div class="col-lg-auto">
                        <button type="submit" class="btn btn-primary">Tim kiem</button>
                    </div>
                    <div class="col-lg-auto">
                        <a href="{{ route('admin.menus.index') }}" class="btn btn-light">Dat lai</a>
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
                                    <input class="form-check-input" type="checkbox" value="" id="menuTableCheck" disabled>
                                    <label class="form-check-label" for="menuTableCheck"></label>
                                </div>
                            </th>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Location</th>
                            <th scope="col">Status</th>
                            <th scope="col" style="width: 150px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($menus as $menu)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="menuTableCheck{{ $menu->id }}">
                                        <label class="form-check-label" for="menuTableCheck{{ $menu->id }}"></label>
                                    </div>
                                </td>
                                <td><a href="{{ route('admin.menus.edit', $menu) }}" class="fw-medium">#MN{{ str_pad((string) $menu->id, 4, '0', STR_PAD_LEFT) }}</a></td>
                                <td>
                                    <div class="fw-semibold">{{ $menu->name }}</div>
                                    <div class="text-muted small">{{ $menu->description ?: '-' }}</div>
                                </td>
                                <td>{{ optional($menu->updated_at ?? $menu->created_at)->format('d M, Y') ?? '-' }}</td>
                                <td>{{ $menu->location ?: '-' }}</td>
                                <td><span class="badge bg-success">Paid</span></td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center gap-3">
                                        <a href="{{ route('admin.menus.items.index', $menu) }}" class="text-primary" title="View">
                                            <i class="ri-eye-fill fs-16"></i>
                                        </a>
                                        <a href="{{ route('admin.menus.edit', $menu) }}" class="text-primary" title="Sua">
                                            <i class="ri-pencil-fill fs-16"></i>
                                        </a>
                                        <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="d-inline" onsubmit="return confirm('Ban co chac muon xoa menu nay?')">
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
            {{ $menus->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
