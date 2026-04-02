@extends('frontend.layout.main')

@section('content')
<section class="py-100">
    <div class="container">
        <h1 class="mb-20">{{ $product->title }}</h1>
        <div class="grid grid-cols-2 lg-grid-cols-1 gap-30">
            <div>
                <img src="{{ $product->thumbnail ? asset($product->thumbnail) : asset('data/no_image.jpg') }}" alt="{{ $product->title }}">
            </div>
            <div>
                <p><strong>Mã:</strong> {{ $product->product_code }}</p>
                <p><strong>Danh mục:</strong> {{ optional($product->category)->name }}</p>
                <p><strong>Giá:</strong> {{ number_format((float) $product->price, 0, ',', '.') }} đ</p>
                <div class="mt-3">{!! $product->content !!}</div>
            </div>
        </div>
    </div>
</section>
@endsection
