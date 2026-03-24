@extends('admin.layout.main')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Menu items: {{ $menu->name }}</h1>
    <div>
        <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Quay lại
        </a>
        <a href="{{ route('admin.menus.items.create', $menu) }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Thêm menu item
        </a>
    </div>
</div>

@include('admin.alert')

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách menu item</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Label</th>
                        <th>URL</th>
                        <th>Target</th>
                        <th>Vị trí</th>
                        <th>Trạng thái</th>
                        <th class="text-center" style="width: 140px;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        @include('admin.menu_item.row', ['item' => $item, 'level' => 0, 'menu' => $menu])
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
