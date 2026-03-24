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
    <h1 class="h3 mb-0 text-gray-800">Tin tức</h1>
    <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
        <i class="fas fa-plus mr-1"></i> Thêm tin tức
    </a>
</div>

@include('admin.alert')

<div class="">
    <form method="GET" action="{{ route('admin.news.index') }}">
        <div class="form-row align-items-end">
            <div class="form-group col-md-2">
                <input type="text" class="form-control" id="q" name="q" value="{{ request('q') }}" placeholder="Nhập tên hoặc ID">
            </div>
            <div class="form-group col-md-2">
                <select class="form-control" id="category_id" name="category_id">
                    <option value="">-- Tất cả danh mục --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ (string)request('category_id') === (string)$cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-sm-auto">
                <button type="button" class="btn btn-outline-secondary btn-equal-height" onclick="window.location='{{ route('admin.news.index') }}'">Đặt lại</button>
            </div>
            <div class="form-group col-sm-auto">
                <button type="submit" class="btn btn-primary btn-equal-height">Tìm kiếm</button>
            </div>
        </div>
        
    </form>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách tin tức</h6>
    </div>
    <div class="">
        <div class="table-responsive">
            <table class="table table-bordered" id="newsTable" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Slug</th>
                        <th>Danh mục</th>
                        <th>Trạng thái</th>
                        <th class="text-center" style="width: 140px;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($news as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                @if($item->thumbnail)
                                    <img src="{{ asset($item->thumbnail) }}" alt="thumb" style="width: 60px; height: 40px; object-fit: cover;">
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->slug ?? '-' }}</td>
                            <td>{{ $item->category?->name ?? '-' }}</td>
                            <td>
                                <span class="badge {{ $item->status ? 'badge-success' : 'badge-secondary' }}">
                                    {{ $item->status ? 'Hiển thị' : 'Ẩn' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-warning">Sửa</a>
                                <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa tin tức này?')">
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
            {{ $news->links() }}
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection
