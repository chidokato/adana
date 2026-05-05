@extends('admin.layout.main')

@section('title', 'Them tin tuc')
@section('page_title', 'Them tin tuc')
@section('breadcrumb', 'Them tin tuc')

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Them tin tuc',
        'heroSubtitle' => 'Tao bai viet moi voi hinh anh, noi dung va danh muc.',
        'heroPrimaryForm' => 'news-form',
        'heroPrimaryType' => 'submit',
        'heroPrimaryLabel' => 'Luu tin tuc',
        'heroSecondaryRoute' => route('admin.news.index'),
        'heroSecondaryLabel' => 'Quay lai',
    ])

    <form id="news-form" method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.news.form')
    </form>
@endsection
