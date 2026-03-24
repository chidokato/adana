@extends('admin.layout.main')

@section('css')
<style>
    .btn-equal-height { height: calc(1.5em + .75rem + 2px); }
</style>
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Menu</h1>
    <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">
        <i class="fas fa-plus mr-1"></i> Thêm menu
    </a>
</div>

@include('admin.alert')

<div class="">
    <form method="GET" action="{{ route('admin.menus.index') }}">
        <div class="form-row align-items-end">
            <div class="form-group col-md-3">
                <input type="text" class="form-control" id="q" name="q" value="{{ request('q') }}" placeholder="Nhập tên hoặc vị trí">
            </div>
            <div class="form-group col-sm-auto">
                <button type="button" class="btn btn-outline-secondary btn-equal-height" onclick="window.location='{{ route('admin.menus.index') }}'">Đặt lại</button>
            </div>
            <div class="form-group col-sm-auto">
                <button type="submit" class="btn btn-primary btn-equal-height">Tìm kiếm</button>
            </div>
        </div>
    </form>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách menu</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên menu</th>
                        <th>Vị trí</th>
                        <th>Mô tả</th>
                        <th class="text-center" style="width: 200px;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menus as $menu)
                        <tr>
                            <td>{{ $menu->id }}</td>
                            <td>{{ $menu->name }}</td>
                            <td>{{ $menu->location }}</td>
                            <td>{{ $menu->description }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.menus.items.index', $menu) }}" class="btn btn-sm btn-info">Menu item</a>
                                <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-sm btn-warning">Sửa</a>
                                <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa menu này?')">
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
            {{ $menus->links() }}
        </div>
    </div>
</div>
@endsection

