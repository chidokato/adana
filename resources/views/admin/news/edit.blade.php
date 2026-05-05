@extends('admin.layout.main')

@section('title', 'Cap nhat tin tuc')
@section('page_title', 'Cap nhat tin tuc')
@section('breadcrumb', 'Cap nhat tin tuc')

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Cap nhat tin tuc',
        'heroSubtitle' => 'Chinh sua bai viet, thumbnail va trang thai hien thi.',
        'heroPrimaryForm' => 'news-form',
        'heroPrimaryType' => 'submit',
        'heroPrimaryLabel' => 'Cap nhat tin tuc',
        'heroSecondaryRoute' => route('admin.news.index'),
        'heroSecondaryLabel' => 'Quay lai',
    ])

    <form id="news-form" method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.news.form', ['news' => $news])
    </form>
@endsection
