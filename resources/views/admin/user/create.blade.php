@extends('admin.layout.main')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thêm người dùng</h1>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Quay lại
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Tên</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="password_confirmation">Nhập lại mật khẩu</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Trạng thái</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" {{ old('status', '1') == '1' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="status">Bật</label>
                    </div>
                    @error('status')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>
</div>
@endsection
