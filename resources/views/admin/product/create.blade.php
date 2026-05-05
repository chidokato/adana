@extends('admin.layout.main')

@section('title', 'Them san pham')
@section('page_title', 'Them san pham')
@section('breadcrumb', 'Them san pham')

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Them san pham',
        'heroSubtitle' => 'Tao san pham moi va cap nhat day du thong tin hien thi.',
        'heroPrimaryForm' => 'product-form',
        'heroPrimaryType' => 'submit',
        'heroPrimaryLabel' => 'Luu san pham',
        'heroSecondaryRoute' => route('admin.products.index'),
        'heroSecondaryLabel' => 'Quay lai',
    ])

    <form id="product-form" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.product.form')
    </form>
@endsection
