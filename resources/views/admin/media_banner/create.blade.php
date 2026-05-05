@extends('admin.layout.main')

@section('title', 'Them slider va banner')
@section('page_title', 'Them slider va banner')
@section('breadcrumb', 'Them slider va banner')

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Them slider va banner',
        'heroSubtitle' => 'Tao hinh anh media moi cho khu vuc slider hoac banner.',
        'heroPrimaryForm' => 'media-banner-form',
        'heroPrimaryType' => 'submit',
        'heroPrimaryLabel' => 'Luu media',
        'heroSecondaryRoute' => route('admin.media-banners.index'),
        'heroSecondaryLabel' => 'Quay lai',
    ])

    <form id="media-banner-form" method="POST" action="{{ route('admin.media-banners.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.media_banner.form', ['item' => null])
    </form>
@endsection
