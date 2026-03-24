@extends('admin.layout.main')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thêm menu</h1>
    <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left mr-1"></i> Quay lại
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.menus.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Tên menu</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="location">Vị trí (ví dụ: header, footer, sidebar)</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}">
                @error('location')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Mô tả</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}">
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>
</div>
@endsection

