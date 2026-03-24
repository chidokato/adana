@extends('admin.layout.main')

@section('css')
<style>
    .custom-switch .custom-control-label::before { left: -2.25rem; }
    .custom-switch .custom-control-label::after { left: calc(-2.25rem + 2px); }
    .btn-equal-height { height: calc(1.5em + .75rem + 2px); }
</style>
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Người dùng (admin)</h1>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus mr-1"></i> Thêm người dùng
    </a>
</div>

@include('admin.alert')

<div class="">
    <form method="GET" action="{{ route('admin.users.index') }}">
        <div class="form-row align-items-end">
            <div class="form-group col-md-3">
                <input type="text" class="form-control" id="q" name="q" value="{{ request('q') }}" placeholder="Nhập tên, email hoặc ID">
            </div>
            <div class="form-group col-sm-auto">
                <button type="button" class="btn btn-outline-secondary btn-equal-height" onclick="window.location='{{ route('admin.users.index') }}'">Đặt lại</button>
            </div>
            <div class="form-group col-sm-auto">
                <button type="submit" class="btn btn-primary btn-equal-height">Tìm kiếm</button>
            </div>
        </div>
    </form>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách người dùng</h6>
    </div>
    <div class="">
        <div class="table-responsive">
            <table class="table table-bordered" id="userTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th class="text-center" style="width: 120px;">Trạng thái</th>
                        <th class="text-center" style="width: 140px;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center">
                                <div class="custom-control custom-switch d-inline-block">
                                    <input type="checkbox"
                                           class="custom-control-input js-toggle-user-status"
                                           id="userStatus{{ $user->id }}"
                                           data-url="{{ route('admin.users.toggleStatus', $user) }}"
                                           {{ $user->status ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="userStatus{{ $user->id }}"></label>
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">Sửa</a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa người dùng này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $(document).on('change', '.js-toggle-user-status', function () {
            var $toggle = $(this);
            var url = $toggle.data('url');
            var prev = !$toggle.prop('checked');

            $.ajax({
                url: url,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')
                }
            }).done(function () {
                if (typeof showToast === 'function') {
                    showToast('success', 'Đã cập nhật trạng thái.');
                }
            }).fail(function () {
                $toggle.prop('checked', prev);
                if (typeof showToast === 'function') {
                    showToast('error', 'Không thể cập nhật trạng thái.');
                }
            });
        });
    });
</script>
@endsection
