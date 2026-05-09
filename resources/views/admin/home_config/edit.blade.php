@extends('admin.layout.main')

@section('title', 'Cap nhat cau hinh trang chu')
@section('page_title', 'Cap nhat cau hinh trang chu')
@section('breadcrumb', 'Cap nhat cau hinh trang chu')

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Cap nhat cau hinh trang chu',
        'heroSubtitle' => 'Chinh sua noi dung, hinh anh va thong tin section tren trang chu.',
        'heroPrimaryForm' => 'home-config-form',
        'heroPrimaryType' => 'submit',
        'heroPrimaryLabel' => 'Luu cau hinh',
        'heroSecondaryRoute' => route('admin.home-configs.index'),
        'heroSecondaryLabel' => 'Quay lai',
    ])

    <form id="home-config-form" method="POST" action="{{ route('admin.home-configs.update', $item) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.home_config.form')
    </form>
@endsection
