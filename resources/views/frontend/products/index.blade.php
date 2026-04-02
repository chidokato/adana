@extends('frontend.layout.main')

@section('content')
@php
    $startItem = $products->firstItem() ?? 0;
    $endItem = $products->lastItem() ?? 0;
    $totalItems = $products->total();
    $sidebarMenuItems = collect($footerMenuItems ?? [])->flatMap(function ($item) {
        $children = collect($item->children ?? []);
        return $children->isNotEmpty() ? $children : collect([$item]);
    })->take(12);
@endphp

<section class="background-light mb-32">
    <div class="container">
        <ul class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">Home</a>
            </li>
            <li>
                <img src="{{ asset('site/assets/icons/right.svg') }}" alt="chevron-right">
            </li>
            <li>
                <span>Listing</span>
            </li>
        </ul>
    </div>
</section>

<section class="pb-100">
    <div class="container">
        <h2>Listing Sidebar Right</h2>
    </div>
    <div class="tf-spacing-style3"></div>

    <div class="container listing-sidebar-right">
        <div class="listing-sidebar-right__content md-mb-30 flat-tabs" data-custom="true">
            <div class="row mb-24">
                <div class="col-xxl-5 col-6 flex items-center">
                    <div class="flex items-center gap-16 md-justify-between md-w-full">
                        <p class="md-hidden">Showing {{ $startItem }} - {{ $endItem }} of {{ $totalItems }} Listings</p>
                    </div>
                </div>

                <div class="col-md-2 col-4 xl2-hidden">
                    <div class="flex items-center py-12 justify-center listing-tabs menu-tab">
                        <span class="item-menu active">
                            <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="3" cy="6" r="2.5" stroke="#9FA1A4"/>
                                <circle cx="11" cy="6" r="2.5" stroke="#9FA1A4"/>
                                <circle cx="19" cy="6" r="2.5" stroke="#9FA1A4"/>
                                <circle cx="3" cy="14" r="2.5" stroke="#9FA1A4"/>
                                <circle cx="11" cy="14" r="2.5" stroke="#9FA1A4"/>
                                <circle cx="19" cy="14" r="2.5" stroke="#9FA1A4"/>
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="col-xxl-5 col-6">
                    <div class="flex items-center h-full gap-8 justify-end">
                        <p class="md-hidden">Sort Vehicles by</p>
                        <div class="core-dropdown">
                            <button class="core-dropdown__button" type="button" id="coreDropdownBtn">
                                <span class="core-dropdown__selected">Lowest Price</span>
                                <img src="{{ asset('site/assets/icons/chevron-down-primary.svg') }}" alt="chevron" class="core-dropdown__icon">
                            </button>
                            <div class="core-dropdown__menu" id="coreDropdownMenu">
                                <ul class="core-dropdown__list">
                                    <li class="core-dropdown__item"><a href="#" class="core-dropdown__option active" data-value="lowest-price">Lowest Price</a></li>
                                    <li class="core-dropdown__item"><a href="#" class="core-dropdown__option" data-value="highest-price">Highest Price</a></li>
                                    <li class="core-dropdown__item"><a href="#" class="core-dropdown__option" data-value="newest-listed">Newest Listed</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-tab">
                <div class="content-inner active">
                    <div class="grid grid-cols-3 lg-grid-cols-2 sm-grid-cols-1 gap-x-30 gap-y-41 mb-28">
                        @forelse($products as $product)
                            <div class="card-box card-box-style-1 wow fadeIn" data-wow-delay="{{ number_format(min(($loop->iteration * 0.1), 0.9), 1) }}s">
                                <div class="top">
                                    <p class="{{ $loop->iteration % 3 === 1 ? 'bg-primary-2 text-white highlight' : ($loop->iteration % 3 === 2 ? 'bg-green text-white highlight' : '') }}">
                                        {{ $loop->iteration % 3 === 1 ? 'Special' : ($loop->iteration % 3 === 2 ? 'Great Price' : '') }}
                                    </p>

                                    <p class="heart">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_13399_19510)">
                                                <path d="M8 14C8 14 1.5 10.5 1.5 6.375C1.5 5.47989 1.85558 4.62145 2.48851 3.98851C3.12145 3.35558 3.97989 3 4.875 3C6.28688 3 7.49625 3.76937 8 5C8.50375 3.76937 9.71312 3 11.125 3C12.0201 3 12.8785 3.35558 13.5115 3.98851C14.1444 4.62145 14.5 5.47989 14.5 6.375C14.5 10.5 8 14 8 14Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                                            </g>
                                        </svg>
                                    </p>
                                </div>
                                <div class="image">
                                    <a href="{{ route('frontend.products.show', $product->slug) }}">
                                        <img class="card--img" src="{{ $product->thumbnail ? asset($product->thumbnail) : asset('data/no_image.jpg') }}" alt="{{ $product->title }}">
                                    </a>
                                </div>
                                <div class="content border-light border-top-none">
                                    <div class="bottom">
                                        <p class="category uppercase text-white">
                                            <a href="{{ route('frontend.products.show', $product->slug) }}" class="text-white uppercase text-xs">
                                                {{ optional($product->category)->name ?? 'Product' }}
                                            </a>
                                        </p>

                                        <div class="flex items-center gap-8">
                                            <p class="category uppercase text-white">
                                                <img src="{{ asset('site/assets/icons/picture.svg') }}" alt="picture">
                                                8
                                            </p>
                                            <p class="category uppercase text-white">
                                                <img src="{{ asset('site/assets/icons/play.svg') }}" alt="play">
                                                1
                                            </p>
                                        </div>
                                    </div>
                                    <p class="h6 card-box__title mb-8">
                                        <a href="{{ route('frontend.products.show', $product->slug) }}">{{ $product->title }}</a>
                                    </p>

                                    <ul class="tag mb-10">
                                        <li>
                                            <img src="{{ asset('site/assets/icons/icon-gauge.svg') }}" alt="fuel">
                                            <span>{{ $product->product_code ?: '32500 miles' }}</span>
                                        </li>
                                        <li>
                                            <img src="{{ asset('site/assets/icons/calendar.svg') }}" alt="fuel">
                                            <span>{{ optional($product->created_at)->format('Y') ?: '2022' }}</span>
                                        </li>
                                        <li>
                                            <img src="{{ asset('site/assets/icons/gaspump.svg') }}" alt="fuel">
                                            <span>{{ optional($product->category)->name ?: 'EV' }}</span>
                                        </li>
                                        <li>
                                            <img src="{{ asset('site/assets/icons/manual.svg') }}" alt="fuel">
                                            <span>Manual</span>
                                        </li>
                                    </ul>

                                    <p class="card-box__price mb-15">
                                        {{ $product->price !== null ? number_format((float) $product->price, 0, ',', '.') . ' đ' : 'Liên hệ' }}
                                    </p>

                                    <div class="divider mb-15"></div>

                                    <div class="flex justify-between">
                                        <p class="compare-details btn btn-small">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_13399_19575)">
                                                    <path d="M10 17.5C14.1421 17.5 17.5 14.1421 17.5 10C17.5 5.85786 14.1421 2.5 10 2.5C5.85786 2.5 2.5 5.85786 2.5 10C2.5 14.1421 5.85786 17.5 10 17.5Z" stroke="#1C1C1C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M6.875 10H13.125" stroke="#1C1C1C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M10 6.875V13.125" stroke="#1C1C1C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </g>
                                            </svg>
                                            Compare
                                        </p>

                                        <a href="{{ route('frontend.products.show', $product->slug) }}" class="view-details">
                                            View details
                                            <img class="ml-4" src="{{ asset('site/assets/icons/CaretCircleRight.svg') }}" alt="CaretCircleRight.svg">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card-box card-box-style-1">
                                <div class="content border-light">
                                    <p class="h6 card-box__title mb-4">No products found</p>
                                    <p class="text-secondary clamp-1 clamp mb-8">Please try another keyword or browse all categories.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    @if($products->hasPages())
                        <ul class="pagination justify-center">
                            @if($products->onFirstPage())
                                <li><span class="pagination__link active">1</span></li>
                            @endif
                            @foreach($products->getUrlRange(max(1, $products->currentPage() - 1), min($products->lastPage(), $products->currentPage() + 1)) as $page => $url)
                                <li>
                                    <a href="{{ $url }}" class="pagination__link {{ $page === $products->currentPage() ? 'active' : '' }}">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endforeach
                            @if($products->hasMorePages())
                                <li>
                                    <a href="{{ $products->nextPageUrl() }}" class="pagination__link">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14.1925 10.4423L7.94254 16.6923C7.88447 16.7504 7.81553 16.7964 7.73966 16.8278C7.66379 16.8593 7.58247 16.8755 7.50035 16.8755C7.41823 16.8755 7.33691 16.8593 7.26104 16.8278C7.18517 16.7964 7.11623 16.7504 7.05816 16.6923C7.00009 16.6342 6.95403 16.5653 6.9226 16.4894C6.89117 16.4135 6.875 16.3322 6.875 16.2501C6.875 16.168 6.89117 16.0867 6.9226 16.0108C6.95403 15.9349 7.00009 15.866 7.05816 15.8079L12.8668 10.0001L7.05816 4.19229C6.94088 4.07502 6.875 3.91596 6.875 3.7501C6.875 3.58425 6.94088 3.42519 7.05816 3.30792C7.17544 3.19064 7.3345 3.12476 7.50035 3.12476C7.6662 3.12476 7.82526 3.19064 7.94254 3.30792L14.1925 9.55791C14.2506 9.61596 14.2967 9.68489 14.3282 9.76077C14.3597 9.83664 14.3758 9.91797 14.3758 10.0001C14.3758 10.0822 14.3597 10.1636 14.3282 10.2394C14.2967 10.3153 14.2506 10.3842 14.1925 10.4423Z" fill="#9FA1A4"/>
                                        </svg>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        <div class="listing-sidebar-right__filter">
            <div class="filter-sidebar-popup filter-sidebar-desktop md-hidden">
                <div class="sidebar-widget mb-24">
                    <h4 class="mb-18">Danh mục sản phẩm</h4>
                    <ul class="widget-links">
                        @forelse($sidebarMenuItems as $item)
                            <li>
                                <a href="{{ $item->resolvedUrl() }}" target="{{ $item->target ?: '_self' }}">
                                    {{ $item->label }}
                                </a>
                            </li>
                        @empty
                            <li><a href="{{ route('frontend.products') }}">Sản phẩm</a></li>
                        @endforelse
                    </ul>
                </div>

                <div class="sidebar-widget mb-24">
                    <h4 class="mb-18">Sản phẩm mới nhất</h4>
                    <div class="flex flex-col gap-16">
                        @forelse(($latestProducts ?? collect()) as $latestProduct)
                            <a href="{{ route('frontend.products.show', $latestProduct->slug) }}" class="post-style-3">
                                <img class="post-style-3__img" src="{{ $latestProduct->thumbnail ? asset($latestProduct->thumbnail) : asset('data/no_image.jpg') }}" alt="{{ $latestProduct->title }}">
                                <div class="post-style-3__content">
                                    <p class="text-xs text-secondary mb-4">{{ optional($latestProduct->category)->name ?? 'Sản phẩm' }}</p>
                                    <p class="h7 mb-4">{{ $latestProduct->title }}</p>
                                    <span class="text-sm font-weight-600">
                                        {{ $latestProduct->price !== null ? number_format((float) $latestProduct->price, 0, ',', '.') . ' đ' : 'Liên hệ' }}
                                    </span>
                                </div>
                            </a>
                        @empty
                            <p class="text-secondary">Chưa có sản phẩm mới.</p>
                        @endforelse
                    </div>
                </div>

                <div class="sidebar-widget">
                    <h4 class="mb-18">Tin tức mới nhất</h4>
                    <div class="flex flex-col gap-16">
                        @forelse(($latestNews ?? collect()) as $latestNewsItem)
                            <a href="{{ route('frontend.news.show', $latestNewsItem->slug) }}" class="post-style-3">
                                <img class="post-style-3__img" src="{{ $latestNewsItem->thumbnail ? asset($latestNewsItem->thumbnail) : asset('data/no_image.jpg') }}" alt="{{ $latestNewsItem->title }}">
                                <div class="post-style-3__content">
                                    <p class="text-xs text-secondary mb-4">{{ optional($latestNewsItem->created_at)->format('d/m/Y') }}</p>
                                    <p class="h7 mb-4">{{ $latestNewsItem->title }}</p>
                                    <span class="text-sm">{{ optional($latestNewsItem->category)->name ?? 'Tin tức' }}</span>
                                </div>
                            </a>
                        @empty
                            <p class="text-secondary">Chưa có tin tức mới.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
