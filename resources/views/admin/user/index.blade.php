@extends('admin.layout.main')

@section('title', 'Tai khoan')
@section('page_title', 'Tai khoan')
@section('breadcrumb', 'Tai khoan')

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Quan ly tai khoan',
        'heroSubtitle' => 'Danh sach tai khoan quan tri, quyen va trang thai hoat dong.',
        'heroPrimaryRoute' => route('admin.users.create'),
        'heroPrimaryLabel' => 'Them tai khoan',
    ])

    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">Card Tables</h4>
        </div>

        <div class="card-body border border-dashed border-end-0 border-start-0">
            <form method="GET" action="{{ route('admin.users.index') }}" class="mb-3">
                <div class="row g-2 align-items-center">
                    <div class="col-lg-5">
                        <input
                            type="text"
                            class="form-control"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Tim theo ten, email hoac ID"
                        >
                    </div>
                    <div class="col-lg-3">
                        <select class="form-select" name="role">
                            <option value="">Tat ca quyen</option>
                            @foreach ($roles as $value => $label)
                                <option value="{{ $value }}" {{ request('role') === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-auto">
                        <button type="submit" class="btn btn-primary">Tim kiem</button>
                    </div>
                    <div class="col-lg-auto">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-light">Dat lai</a>
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
                                    <input class="form-check-input" type="checkbox" value="" id="userTableCheck" disabled>
                                    <label class="form-check-label" for="userTableCheck"></label>
                                </div>
                            </th>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status</th>
                            <th scope="col" style="width: 150px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="userTableCheck{{ $user->id }}">
                                        <label class="form-check-label" for="userTableCheck{{ $user->id }}"></label>
                                    </div>
                                </td>
                                <td><a href="{{ route('admin.users.edit', $user) }}" class="fw-medium">#US{{ str_pad((string) $user->id, 4, '0', STR_PAD_LEFT) }}</a></td>
                                <td>
                                    <div class="fw-semibold">{{ $user->name }}</div>
                                    <div class="text-muted small">{{ $user->email }}</div>
                                </td>
                                <td>{{ optional($user->updated_at ?? $user->created_at)->format('d M, Y') ?? '-' }}</td>
                                <td>{{ $user->role_label }}</td>
                                <td>
                                    <span class="badge {{ $user->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $user->status ? 'Paid' : 'Refund' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center gap-3">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="text-primary" title="View">
                                            <i class="ri-eye-fill fs-16"></i>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $user) }}" class="text-primary" title="Sua">
                                            <i class="ri-pencil-fill fs-16"></i>
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Ban co chac muon xoa nguoi dung nay?')">
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
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
