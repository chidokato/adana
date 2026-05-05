@extends('admin.layout.main')

@section('title', 'Them menu')
@section('page_title', 'Them menu')
@section('breadcrumb', 'Them menu')

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Them menu',
        'heroSubtitle' => 'Tao menu dieu huong moi va gan vi tri hien thi.',
        'heroPrimaryForm' => 'menu-form',
        'heroPrimaryType' => 'submit',
        'heroPrimaryLabel' => 'Luu menu',
        'heroSecondaryRoute' => route('admin.menus.index'),
        'heroSecondaryLabel' => 'Quay lai',
    ])

    <form id="menu-form" method="POST" action="{{ route('admin.menus.store') }}">
        @csrf
        <div class="row">
            <div class="col-xl-9">
                <div class="card border">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Ten menu</label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-0">
                            <label for="description" class="form-label">Mo ta</label>
                            <input type="text" id="description" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}">
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card border">
                    <div class="card-body">
                        <div class="mb-0">
                            <label for="location" class="form-label">Vi tri</label>
                            <input type="text" id="location" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}" placeholder="header, footer, sidebar">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
