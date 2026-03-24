@extends('admin.layout.main')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Sửa danh mục</h1>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Quay lại
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Tên danh mục</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="type">Loại danh mục</label>
                    <select class="form-control" id="type" name="type" required>
                        <option value="product" {{ old('type', $category->type) === 'product' ? 'selected' : '' }}>Danh mục sản phẩm</option>
                        <option value="news" {{ old('type', $category->type) === 'news' ? 'selected' : '' }}>Danh mục tin tức</option>
                    </select>
                    @error('type')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="parent_id">Danh mục cha</label>
                    <select class="form-control" id="parent_id" name="parent_id">
                        <option value="">-- Không --</option>
                        @foreach($parents as $parent)
                            <option value="{{ $parent->id }}"
                                    data-type="{{ $parent->type }}"
                                    style="{{ old('type', $category->type) === $parent->type ? '' : 'display:none' }}"
                                    {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Trạng thái</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" {{ old('status', (string)$category->status) == '1' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="status">Bật</label>
                    </div>
                    @error('status')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    function filterParentOptions() {
        var type = $('#type').val();
        $('#parent_id option').each(function() {
            var optType = $(this).data('type');
            if (!optType) return;
            $(this).toggle(optType === type);
        });
        if ($('#parent_id option:selected').data('type') && $('#parent_id option:selected').data('type') !== type) {
            $('#parent_id').val('');
        }
    }
    $(document).ready(function() {
        filterParentOptions();
        $('#type').on('change', filterParentOptions);
    });
</script>
@endsection
