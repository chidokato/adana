@extends('admin.layout.main')

@section('title', 'Cap nhat slider va banner')
@section('page_title', 'Cap nhat slider va banner')
@section('breadcrumb', 'Cap nhat slider va banner')

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Cap nhat slider va banner',
        'heroSubtitle' => 'Chinh sua hinh anh, link va thu tu hien thi media.',
        'heroPrimaryForm' => 'media-banner-form',
        'heroPrimaryType' => 'submit',
        'heroPrimaryLabel' => 'Cap nhat media',
        'heroSecondaryRoute' => route('admin.media-banners.index'),
        'heroSecondaryLabel' => 'Quay lai',
    ])

    <form id="media-banner-form" method="POST" action="{{ route('admin.media-banners.update', $item) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.media_banner.form', ['item' => $item])
    </form>
@endsection
