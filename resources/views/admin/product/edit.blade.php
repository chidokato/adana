@extends('admin.layout.main')

@section('title', 'Cap nhat san pham')
@section('page_title', 'Cap nhat san pham')
@section('breadcrumb', 'Cap nhat san pham')

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Cap nhat san pham',
        'heroSubtitle' => 'Chinh sua noi dung, hinh anh va trang thai san pham.',
        'heroPrimaryForm' => 'product-form',
        'heroPrimaryType' => 'submit',
        'heroPrimaryLabel' => 'Cap nhat san pham',
        'heroSecondaryRoute' => route('admin.products.index'),
        'heroSecondaryLabel' => 'Quay lai',
    ])

    <form id="product-form" method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.product.form', ['product' => $product])
    </form>
@endsection
