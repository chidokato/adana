@extends('frontend.layout.main')

@section('content')
@php
    $galleryImages = collect([$product->thumbnail])
        ->merge($product->images->pluck('path'))
        ->filter()
        ->unique()
        ->values();
    $galleryImages = $galleryImages->isNotEmpty() ? $galleryImages : collect(['data/no_image.jpg']);
    $productPrice = $product->price !== null ? number_format((float) $product->price, 0, ',', '.') . ' đ' : 'Liên hệ';
    $description = trim(strip_tags($product->description ?: ''));
    $content = $product->content ?: $product->description;
    $sidebarMenuItems = collect($footerMenuItems ?? [])->flatMap(function ($item) {
        $children = collect($item->children ?? []);
        return $children->isNotEmpty() ? $children : collect([$item]);
    })->take(12)->map(function ($item) use ($product) {
        return [
            'label' => $item->label,
            'url' => $item->resolvedUrl(),
            'target' => $item->target ?: '_self',
            'active' => optional($product->category)->slug && $item->resolvedUrl() === $product->category->frontend_url,
        ];
    });
    $sidebarRecentProducts = collect($latestProducts ?? [])->map(function ($latestProduct) {
        return [
            'url' => $latestProduct->frontend_url,
            'image' => $latestProduct->thumbnail ? asset($latestProduct->thumbnail) : asset('data/no_image.jpg'),
            'title' => $latestProduct->title,
            'meta' => [
                ['text' => optional($latestProduct->category)->name ?? 'Sản phẩm'],
                ['text' => $latestProduct->price !== null ? number_format((float) $latestProduct->price, 0, ',', '.') . ' đ' : 'Liên hệ', 'class' => 'font-weight-600'],
            ],
        ];
    });
    $sidebarRecentNews = collect($latestNews ?? [])->map(function ($latestNewsItem) {
        return [
            'url' => route('frontend.news.show', $latestNewsItem->slug),
            'image' => $latestNewsItem->thumbnail ? asset($latestNewsItem->thumbnail) : asset('data/no_image.jpg'),
            'title' => \Illuminate\Support\Str::limit($latestNewsItem->title, 60),
            'meta' => [
                ['text' => optional($latestNewsItem->created_at)->format('d/m/Y')],
                ['text' => optional($latestNewsItem->category)->name ?? 'Tin tức', 'class' => 'text-highlight uppercase text-underline'],
            ],
        ];
    });
@endphp

<section class="background-light">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">Trang chủ</a></li>
            <li><img src="{{ asset('site/assets/icons/right.svg') }}" alt="right"></li>
            <li><a href="{{ route('frontend.products') }}">Sản phẩm</a></li>
            <li><img src="{{ asset('site/assets/icons/right.svg') }}" alt="right"></li>
            <li><span>{{ $product->title }}</span></li>
        </ul>
    </div>
</section>

<section class="pb-100">
    <div class="tf-spacing-style4"></div>
    <div class="container">
        <div class="listing-details">
            <div class="listing-details--content">
                <div class="title-section mb-40">
                    <h2 class="capitalize">{{ $product->title }}</h2>
                </div>

                <div class="swiper swiper-listing-details-main">
                    <div class="swiper-wrapper">
                        @foreach($galleryImages as $image)
                            <div class="swiper-slide">
                                <div class="listing-details-item main-item relative">
                                    <img class="img-main" src="{{ asset($image) }}" alt="{{ $product->title }}">
                                    <div class="listing-details-item--content">
                                        <a class="listing-details-item--button" href="{{ route('frontend.contact') }}">
                                            <img src="{{ asset('site/assets/icons/ChatCircleDots.svg') }}" alt="chat">
                                            Yêu cầu báo giá
                                        </a>
                                        <a class="listing-details-item--button" href="{{ asset($image) }}" target="_blank">
                                            <img src="{{ asset('site/assets/icons/view-all-photo.svg') }}" alt="view">
                                            Xem ảnh lớn
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <p class="swiper-button navigation-prev swiper-listing-details-main-prev">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.9487 2.71258C14.2097 2.97026 14.2335 3.37348 14.0199 3.65762L13.9487 3.73903L7.60622 10L13.9487 16.261C14.2097 16.5186 14.2335 16.9219 14.0199 17.206L13.9487 17.2874C13.6877 17.5451 13.2792 17.5685 12.9913 17.3577L12.9088 17.2874L6.04609 10.5132C5.78505 10.2555 5.76132 9.85232 5.9749 9.56818L6.04609 9.48678L12.9088 2.71258C13.196 2.42914 13.6615 2.42914 13.9487 2.71258Z" fill="white"/>
                        </svg>
                    </p>
                    <p class="swiper-button navigation-next swiper-listing-details-main-next">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.0513 17.2874C5.79025 17.0297 5.76652 16.6265 5.98011 16.3424L6.0513 16.261L12.3938 10L6.0513 3.73903C5.79025 3.48135 5.76652 3.07813 5.98011 2.79399L6.0513 2.71258C6.31235 2.45491 6.72084 2.43148 7.00869 2.64231L7.09116 2.71258L13.9539 9.48678C14.215 9.74446 14.2387 10.1477 14.0251 10.4318L13.9539 10.5132L7.09116 17.2874C6.80401 17.5709 6.33845 17.5709 6.0513 17.2874Z" fill="white"/>
                        </svg>
                    </p>
                </div>

                <div class="swiper swiper-listing-details-thumbs pb-60 overflow-hidden">
                    <div class="swiper-wrapper">
                        @foreach($galleryImages as $image)
                            <div class="swiper-slide">
                                <div class="listing-details-thumb">
                                    <img src="{{ asset($image) }}" alt="{{ $product->title }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="product-detail-summary mb-40">
                    <p class="mb-0">
                        {{ $description ?: 'Thông tin mô tả ngắn của sản phẩm đang được cập nhật. Vui lòng xem nội dung chi tiết bên dưới hoặc liên hệ để được tư vấn nhanh.' }}
                    </p>
                </div>

                <div class="product-detail-content text-secondary mb-40">
                    {!! $content ?: '<p>Thông tin chi tiết sản phẩm đang được cập nhật.</p>' !!}
                </div>
            </div>

            <div class="listing-details--sidebar">
                <div class="listing-details--sidebar-box mb-40">
                    <p class="h5 mb-4 capitalize">Tổng quan sản phẩm</p>
                    <ul class="car-overview-list-style2">
                        <li class="grid-cols-2 grid">
                            <p class="flex items-center gap-8">
                                <img class="w-28 h-28" src="{{ asset('site/assets/icons/icon-gauge.svg') }}" alt="code">
                                <span class="h7 text-secondary">Mã:</span>
                            </p>
                            <span class="h7 font-weight-500 pl-28">{{ $product->product_code ?: 'Đang cập nhật' }}</span>
                        </li>
                        <li class="grid-cols-2 grid">
                            <p class="flex items-center gap-8">
                                <img class="w-28 h-28" src="{{ asset('site/assets/icons/calendar.svg') }}" alt="date">
                                <span class="h7 text-secondary">Ngày đăng:</span>
                            </p>
                            <span class="h7 font-weight-500 pl-28">{{ optional($product->created_at)->format('d/m/Y') ?: 'Đang cập nhật' }}</span>
                        </li>
                        <li class="grid-cols-2 grid">
                            <p class="flex items-center gap-8">
                                <img class="w-28 h-28" src="{{ asset('site/assets/icons/gaspump.svg') }}" alt="category">
                                <span class="h7 text-secondary">Danh mục:</span>
                            </p>
                            <span class="h7 font-weight-500 pl-28">{{ optional($product->category)->name ?: 'Đang cập nhật' }}</span>
                        </li>
                        <li class="grid-cols-2 grid">
                            <p class="flex items-center gap-8">
                                <img class="w-28 h-28" src="{{ asset('site/assets/icons/Barcode.svg') }}" alt="price">
                                <span class="h7 text-secondary">Giá:</span>
                            </p>
                            <span class="h7 font-weight-500 pl-28">{{ $productPrice }}</span>
                        </li>
                    </ul>
                </div>

                <div class="listing-details--sidebar-box mb-40">
                    <div class="listing-details--contact">
                        <div class="listing-details--contact-dealer mb-28">
                            <img src="{{ !empty($siteSetting->favicon) ? asset($siteSetting->favicon) : asset('site/assets/images/favicon.png') }}" alt="{{ $siteSetting->company_name ?? 'ADANA Group' }}">

                            <div class="content">
                                <a href="{{ route('frontend.about') }}" class="h4 mb-8 font-weight-600">{{ $siteSetting->company_name ?? 'ADANA Group' }}</a>
                                <div class="verify">
                                    <img src="{{ asset('site/assets/icons/SealCheck.svg') }}" alt="verified">
                                    <p class="text-highlight text-sm">Đơn vị cung cấp</p>
                                </div>
                            </div>
                        </div>

                        <ul class="contact-info mb-20">
                            <li>
                                <p class="icon"><img src="{{ asset('site/assets/icons/MapPin.svg') }}" alt="address"></p>
                                <div class="flex flex-col gap-4">
                                    <a href="{{ route('frontend.contact') }}">
                                        {{ $siteSetting->address ?? 'Địa chỉ đang cập nhật' }}
                                    </a>
                                </div>
                            </li>
                        </ul>

                        <ul class="contact-info mb-28">
                            <li class="items-center">
                                <p class="icon"><img src="{{ asset('site/assets/icons/PhoneCall.svg') }}" alt="phone"></p>
                                <div class="flex flex-col">
                                    @if(!empty($siteSetting->hotline))
                                        <a href="tel:{{ preg_replace('/\s+/', '', $siteSetting->hotline) }}">{{ $siteSetting->hotline }}</a>
                                    @endif
                                    @if(!empty($siteSetting->email))
                                        <a href="mailto:{{ $siteSetting->email }}">{{ $siteSetting->email }}</a>
                                    @endif
                                </div>
                            </li>
                        </ul>

                        <a href="tel:{{ preg_replace('/\s+/', '', $siteSetting->hotline ?? '') }}" class="btn btn-medium btn-primary-3 font-weight-600 mb-12 gap-5">
                            <img src="{{ asset('site/assets/icons/PhoneCall-2.svg') }}" alt="phone">
                            Gọi ngay
                        </a>

                        <a href="{{ route('frontend.contact') }}" class="btn btn-medium btn-primary-4 font-weight-600 gap-5">
                            <img src="{{ asset('site/assets/icons/ChatCircleDots.svg') }}" alt="chat">
                            Gửi yêu cầu tư vấn
                        </a>
                    </div>
                </div>

                <div class="listing-details--sidebar-box">
                    @include('frontend.partials.site-sidebar', [
                        'sidebarCategoryTitle' => 'Danh mục sản phẩm',
                        'sidebarCategories' => $sidebarMenuItems,
                        'sidebarRecentTitle' => 'Sản phẩm mới nhất',
                        'sidebarRecentPosts' => $sidebarRecentProducts,
                        'sidebarAdditionalRecentSections' => [
                            [
                                'title' => 'Tin tức mới nhất',
                                'posts' => $sidebarRecentNews,
                            ],
                        ],
                    ])
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
