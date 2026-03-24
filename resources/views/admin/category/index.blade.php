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
    <h1 class="h3 mb-0 text-gray-800">Danh mục</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
        <i class="fas fa-plus mr-1"></i> Thêm danh mục
    </a>
</div>

@include('admin.alert')

<div class="">
    <form method="GET" action="{{ route('admin.categories.index') }}">
        <div class="form-row align-items-end">
            <div class="form-group col-md-3">
                <input type="text" class="form-control" id="q" name="q" value="{{ request('q') }}" placeholder="Nhập tên hoặc ID">
            </div>
            <div class="form-group col-md-2">
                <select class="form-control" id="type" name="type">
                    <option value="">-- Tất cả loại --</option>
                    <option value="product" {{ request('type') === 'product' ? 'selected' : '' }}>Danh mục sản phẩm</option>
                    <option value="news" {{ request('type') === 'news' ? 'selected' : '' }}>Danh mục tin tức</option>
                </select>
            </div>
            <div class="form-group col-sm-auto">
                <button type="button" class="btn btn-outline-secondary btn-equal-height" onclick="window.location='{{ route('admin.categories.index') }}'">Đặt lại</button>
            </div>
            <div class="form-group col-sm-auto">
                <button type="submit" class="btn btn-primary btn-equal-height">Tìm kiếm</button>
            </div>
        </div>
    </form>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách danh mục</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="categoryTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Loại</th>
                    <th>Slug</th>
                    <th class="text-center" style="width: 120px;">Trạng thái</th>
                    <th class="text-center" style="width: 140px;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($isFiltered) && $isFiltered)
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->type === 'news' ? 'Tin tức' : 'Sản phẩm' }}</td>
                            <td>{{ $category->slug }}</td>
                            <td class="text-center">
                                <div class="custom-control custom-switch d-inline-block">
                                    <input type="checkbox"
                                           class="custom-control-input js-toggle-category-status"
                                           id="categoryStatus{{ $category->id }}"
                                           data-url="{{ route('admin.categories.toggleStatus', $category) }}"
                                           {{ $category->status ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="categoryStatus{{ $category->id }}"></label>
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-warning">Sửa</a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa danh mục này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    @foreach($categories as $category)
                        @include('admin.category.row', ['category' => $category, 'level' => 0])
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    @if(!empty($isFiltered) && $isFiltered)
        <div class="d-flex justify-content-end">
            {{ $categories->links() }}
        </div>
    @endif
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#categoryTable tbody tr').filter(function () {
            return $(this).find('td').filter(function () {
                return $(this).text().trim() !== '';
            }).length === 0;
        }).remove();

        $(document).on('change', '.js-toggle-category-status', function () {
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
