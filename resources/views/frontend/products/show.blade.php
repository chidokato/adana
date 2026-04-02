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
@endphp

<section class="background-light">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a></li>
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
                    <div class="flex items-center justify-end gap-12">
                        <a href="{{ route('frontend.contact') }}" class="btn btn-medium btn-line padding-button-medium gap-5 font-weight-600">
                            <img src="{{ asset('site/assets/icons/PhoneCall.svg') }}" alt="phone">
                            Liên hệ tư vấn
                        </a>

                        <a href="tel:{{ preg_replace('/\s+/', '', $siteSetting->hotline ?? '') }}" class="btn-icon-circle hover-fill-white">
                            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.4458 19.8335V22.1668C22.4458 22.7857 22.1999 23.3792 21.7623 23.8168C21.3248 24.2543 20.7313 24.5002 20.1124 24.5002C10.4516 24.5002 2.61243 16.6611 2.61243 7.00016C2.61243 6.38133 2.85826 5.78783 3.29582 5.35027C3.73338 4.91272 4.32686 4.66683 4.94576 4.66683H7.2791C7.82662 4.66626 8.35547 4.85824 8.77392 5.20916C9.19237 5.56008 9.47392 6.04751 9.56826 6.58683L9.9641 8.92016C10.0369 9.34054 9.99412 9.77279 9.84043 10.1712C9.68673 10.5695 9.42809 10.919 9.0916 11.1827L7.6416 12.3435C8.96897 15.2156 11.2906 17.5372 14.1624 18.8647L15.3233 17.4147C15.5869 17.0782 15.9364 16.8195 16.3348 16.6658C16.7331 16.5121 17.1654 16.4693 17.5858 16.5422L19.9191 16.938C20.4585 17.0323 20.9459 17.3139 21.2968 17.7323C21.6477 18.1508 21.8397 18.6796 21.8391 19.2272" stroke="#1C1C1C" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
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

                <p class="h4 mb-16">Description</p>
                <p class="text-secondary mb-40">
                    {{ $description ?: 'Thông tin mô tả ngắn của sản phẩm đang được cập nhật. Vui lòng xem nội dung chi tiết bên dưới hoặc liên hệ để được tư vấn nhanh.' }}
                </p>

                <div class="divider w-full mb-40"></div>

                <p class="h4 mb-16 capitalize">Get To Know this product</p>

                <div class="flat-tabs mb-40">
                    <div class="overflow-x-auto mb-16">
                        <ul class="menu-tab menu-tab-style4">
                            <li class="active"><span class="text-secondary font-weight-600">Thông tin cơ bản</span></li>
                        </ul>
                    </div>

                    <div class="content-tab">
                        <div class="content-inner active">
                            <ul class="grid grid-cols-3 xl-grid-cols-2 md-grid-cols-1 gap-8 gap-x-30">
                                <li class="flex items-center gap-8">
                                    <img src="{{ asset('site/assets/icons/check.svg') }}" alt="check">
                                    Mã sản phẩm: {{ $product->product_code ?: 'Đang cập nhật' }}
                                </li>
                                <li class="flex items-center gap-8">
                                    <img src="{{ asset('site/assets/icons/check.svg') }}" alt="check">
                                    Danh mục: {{ optional($product->category)->name ?: 'Đang cập nhật' }}
                                </li>
                                <li class="flex items-center gap-8">
                                    <img src="{{ asset('site/assets/icons/check.svg') }}" alt="check">
                                    Giá: {{ $productPrice }}
                                </li>
                                <li class="flex items-center gap-8">
                                    <img src="{{ asset('site/assets/icons/check.svg') }}" alt="check">
                                    Năm đăng: {{ optional($product->created_at)->format('Y') ?: 'Đang cập nhật' }}
                                </li>
                                <li class="flex items-center gap-8">
                                    <img src="{{ asset('site/assets/icons/check.svg') }}" alt="check">
                                    Doanh nghiệp cung cấp: {{ $siteSetting->company_name ?? 'ADANA Group' }}
                                </li>
                                <li class="flex items-center gap-8">
                                    <img src="{{ asset('site/assets/icons/check.svg') }}" alt="check">
                                    Hỗ trợ tư vấn: {{ $siteSetting->hotline ?? 'Đang cập nhật' }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="divider w-full mb-40"></div>

                <p class="h4 mb-16">Nội dung chi tiết</p>
                <div class="text-secondary mb-40">
                    {!! $content ?: '<p>Thông tin chi tiết sản phẩm đang được cập nhật.</p>' !!}
                </div>
            </div>

            <div class="listing-details--sidebar">
                <div class="listing-details--sidebar-box mb-40">
                    <p class="h5 mb-4 capitalize">Product Overview</p>
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
                                <img class="w-28 h-28" src="{{ asset('site/assets/icons/calendar.svg') }}" alt="year">
                                <span class="h7 text-secondary">Năm:</span>
                            </p>
                            <span class="h7 font-weight-500 pl-28">{{ optional($product->created_at)->format('Y') ?: 'Đang cập nhật' }}</span>
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
                                <img class="w-28 h-28" src="{{ asset('site/assets/icons/QrCode.svg') }}" alt="images">
                                <span class="h7 text-secondary">Số ảnh:</span>
                            </p>
                            <span class="h7 font-weight-500 pl-28">{{ $galleryImages->count() }}</span>
                        </li>
                        <li class="grid-cols-2 grid">
                            <p class="flex items-center gap-8">
                                <img class="w-28 h-28" src="{{ asset('site/assets/icons/MapPin.svg') }}" alt="address">
                                <span class="h7 text-secondary">Địa chỉ:</span>
                            </p>
                            <span class="h7 font-weight-500 pl-28">{{ $siteSetting->address ?? 'Đang cập nhật' }}</span>
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
                            <img src="{{ asset('site/assets/images/avatar/contact-avatar.png') }}" alt="dealer">

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
            </div>
        </div>
    </div>
</section>
@endsection
