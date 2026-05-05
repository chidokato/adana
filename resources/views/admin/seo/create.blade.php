@extends('admin.layout.main')

@section('title', 'Them SEO')
@section('page_title', 'Them SEO')
@section('breadcrumb', 'Them SEO')

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Them cau hinh SEO',
        'heroSubtitle' => 'Tao title va description cho tung duong dan hien thi.',
        'heroPrimaryForm' => 'seo-form',
        'heroPrimaryType' => 'submit',
        'heroPrimaryLabel' => 'Luu SEO',
        'heroSecondaryRoute' => route('admin.seo.index'),
        'heroSecondaryLabel' => 'Quay lai',
    ])

    <form id="seo-form" method="POST" action="{{ route('admin.seo.store') }}">
        @csrf
        @include('admin.seo.form', ['seo' => null])
    </form>
@endsection
