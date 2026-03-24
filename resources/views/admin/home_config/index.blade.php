@extends('admin.layout.main')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cấu hình trang chủ</h1>
    <a href="{{ route('admin.home-configs.create') }}" class="btn btn-primary">
        <i class="fas fa-plus mr-1"></i> Thêm cấu hình
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form method="GET" class="mb-4">
            <div class="row align-items-end">
                <div class="col-md-4">
                    <label for="q">Tìm kiếm</label>
                    <input type="text" id="q" name="q" class="form-control" value="{{ request('q') }}" placeholder="Nhập key, tiêu đề hoặc ID">
                </div>
                <div class="col-md-4 mt-3 mt-md-0">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    <a href="{{ route('admin.home-configs.index') }}" class="btn btn-outline-secondary">Đặt lại</a>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Key</th>
                        <th>Tiêu đề</th>
                        <th>Ảnh</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><code>{{ $item->section_key }}</code></td>
                            <td>{{ $item->title }}</td>
                            <td>
                                @if($item->image)
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->section_key }}" style="width: 80px; height: 50px; object-fit: cover;">
                                @endif
                            </td>
                            <td style="white-space: nowrap;">
                                <a href="{{ route('admin.home-configs.edit', $item) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('admin.home-configs.destroy', $item) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Chưa có cấu hình nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $items->links() }}
    </div>
</div>
@endsection
