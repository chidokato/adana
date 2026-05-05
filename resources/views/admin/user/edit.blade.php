@extends('admin.layout.main')

@section('title', 'Cap nhat tai khoan')
@section('page_title', 'Cap nhat tai khoan')
@section('breadcrumb', 'Cap nhat tai khoan')

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Cap nhat tai khoan',
        'heroSubtitle' => 'Chinh sua thong tin dang nhap, quyen va trang thai tai khoan.',
        'heroPrimaryForm' => 'user-form',
        'heroPrimaryType' => 'submit',
        'heroPrimaryLabel' => 'Cap nhat tai khoan',
        'heroSecondaryRoute' => route('admin.users.index'),
        'heroSecondaryLabel' => 'Quay lai',
    ])

    <form id="user-form" method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xl-9">
                <div class="card border">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Ten</label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Mat khau moi</label>
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-0">
                                <label for="password_confirmation" class="form-label">Nhap lai mat khau</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card border">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="role" class="form-label">Quyen</label>
                            <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required>
                                @foreach($roles as $value => $label)
                                    <option value="{{ $value }}" {{ old('role', $user->role) === $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="custom-control custom-switch">
                            <input class="custom-control-input" type="checkbox" id="status" name="status" value="1" {{ old('status', $user->status) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="status">Kich hoat tai khoan</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
