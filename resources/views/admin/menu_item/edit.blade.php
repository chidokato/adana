@extends('admin.layout.main')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Sửa menu item</h1>
    <a href="{{ route('admin.menus.items.index', $menu) }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left mr-1"></i> Quay lại
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.menus.items.update', [$menu, $item]) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="label">Tên hiển thị</label>
                <input type="text" class="form-control" id="label" name="label" value="{{ old('label', $item->label) }}" required>
                @error('label')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="url">Đường link</label>
                <input type="text" class="form-control" id="url" name="url" value="{{ old('url', $item->url) }}">
                @error('url')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="parent_id">Menu cha</label>
                    <select class="form-control" id="parent_id" name="parent_id">
                        <option value="">-- Không --</option>
                        @foreach($parents as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id', $item->parent_id) == $parent->id ? 'selected' : '' }}>
                                {{ $parent->label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="target">Target</label>
                    <select class="form-control" id="target" name="target">
                        <option value="_self" {{ old('target', $item->target) === '_self' ? 'selected' : '' }}>_self</option>
                        <option value="_blank" {{ old('target', $item->target) === '_blank' ? 'selected' : '' }}>_blank</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="position">Vị trí</label>
                    <input type="number" class="form-control" id="position" name="position" value="{{ old('position', $item->position) }}">
                </div>
                <div class="form-group col-md-6">
                    <label>Trạng thái</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" {{ old('status', (string)$item->status) == '1' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="status">Bật</label>
                    </div>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
    </div>
</div>
@endsection

