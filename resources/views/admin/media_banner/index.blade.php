@extends('admin.layout.main')

@section('css')
<style>
    .btn-equal-height { height: calc(1.5em + .75rem + 2px); }
</style>
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Slider & Banner</h1>
    <a href="{{ route('admin.media-banners.create') }}" class="btn btn-primary">
        <i class="fas fa-plus mr-1"></i> Thêm mới
    </a>
</div>

@include('admin.alert')

<div class="">
    <form method="GET" action="{{ route('admin.media-banners.index') }}">
        <div class="form-row align-items-end">
            <div class="form-group col-md-3">
                <select class="form-control" id="type" name="type">
                    <option value="">-- Tất cả --</option>
                    <option value="slider" {{ request('type') === 'slider' ? 'selected' : '' }}>Slider</option>
                    <option value="banner" {{ request('type') === 'banner' ? 'selected' : '' }}>Banner</option>
                </select>
            </div>
            <div class="form-group col-sm-auto">
                <button type="button" class="btn btn-outline-secondary btn-equal-height" onclick="window.location='{{ route('admin.media-banners.index') }}'">Đặt lại</button>
            </div>
            <div class="form-group col-sm-auto">
                <button type="submit" class="btn btn-primary btn-equal-height">Tìm kiếm</button>
            </div>
        </div>
    </form>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Loại</th>
                        <th>Tiêu đề</th>
                        <th>Link</th>
                        <th>Vị trí</th>
                        <th>Trạng thái</th>
                        <th class="text-center" style="width: 140px;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                @if($item->image)
                                    <img src="{{ asset($item->image) }}" alt="img" style="width: 80px; height: 50px; object-fit: cover;">
                                @endif
                            </td>
                            <td>{{ $item->type === 'slider' ? 'Slider' : 'Banner' }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->link }}</td>
                            <td>{{ $item->position }}</td>
                            <td>
                                <span class="badge {{ $item->status ? 'badge-success' : 'badge-secondary' }}">
                                    {{ $item->status ? 'Hiển thị' : 'Ẩn' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.media-banners.edit', $item) }}" class="btn btn-sm btn-warning">Sửa</a>
                                <form action="{{ route('admin.media-banners.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa mục này?')">
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
            {{ $items->links() }}
        </div>
    </div>
</div>
@endsection

