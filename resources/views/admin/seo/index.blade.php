@extends('admin.layout.main')

@section('css')
<style>
    .btn-equal-height { height: calc(1.5em + .75rem + 2px); }
</style>
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">SEO trang</h1>
    <a href="{{ route('admin.seo.create') }}" class="btn btn-primary">
        <i class="fas fa-plus mr-1"></i> Thêm SEO
    </a>
</div>

@include('admin.alert')

<div class="">
    <form method="GET" action="{{ route('admin.seo.index') }}">
        <div class="form-row align-items-end">
            <div class="form-group col-md-3">
                <input type="text" class="form-control" id="q" name="q" value="{{ request('q') }}" placeholder="Nhập URL, title hoặc ID">
            </div>
            <div class="form-group col-sm-auto">
                <button type="button" class="btn btn-outline-secondary btn-equal-height" onclick="window.location='{{ route('admin.seo.index') }}'">Đặt lại</button>
            </div>
            <div class="form-group col-sm-auto">
                <button type="submit" class="btn btn-primary btn-equal-height">Tìm kiếm</button>
            </div>
        </div>
    </form>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách SEO</h6>
    </div>
    <div class="">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>URL</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th class="text-center" style="width: 140px;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->url }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($item->description, 80) }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.seo.edit', $item) }}" class="btn btn-sm btn-warning">Sửa</a>
                                <form action="{{ route('admin.seo.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa cấu hình này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Chưa có cấu hình SEO.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            {{ $items->links() }}
        </div>
    </div>
</div>
@endsection
