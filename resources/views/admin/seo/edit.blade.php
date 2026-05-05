@extends('admin.layout.main')

@section('title', 'Cap nhat SEO')
@section('page_title', 'Cap nhat SEO')
@section('breadcrumb', 'Cap nhat SEO')

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Cap nhat cau hinh SEO',
        'heroSubtitle' => 'Chinh sua title va description cho duong dan dang co.',
        'heroPrimaryForm' => 'seo-form',
        'heroPrimaryType' => 'submit',
        'heroPrimaryLabel' => 'Cap nhat SEO',
        'heroSecondaryRoute' => route('admin.seo.index'),
        'heroSecondaryLabel' => 'Quay lai',
    ])

    <form id="seo-form" method="POST" action="{{ route('admin.seo.update', $seo) }}">
        @csrf
        @method('PUT')
        @include('admin.seo.form', ['seo' => $seo])
    </form>
@endsection
