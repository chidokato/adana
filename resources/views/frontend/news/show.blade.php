@extends('frontend.layout.main')

@section('content')
@php
    $sidebarMenuItems = collect($footerMenuItems ?? [])->flatMap(function ($item) {
        $children = collect($item->children ?? []);
        return $children->isNotEmpty() ? $children : collect([$item]);
    })->take(12)->map(function ($item) {
        return [
            'label' => $item->label,
            'url' => $item->resolvedUrl(),
            'target' => $item->target ?: '_self',
            'active' => false,
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
    $plainContent = trim(strip_tags($news->content ?: ''));
    $lead = $news->description ?: \Illuminate\Support\Str::limit($plainContent, 220);
    $quote = \Illuminate\Support\Str::limit($lead ?: $news->title, 150);
@endphp

<section class="blog-details-banner">
    <img class="overlay-image" src="{{ asset('site/assets/images/blog/overlay-blogdetails.png') }}" alt="blog-details-banner">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <ul class="breadcrumb">
                <li>
                    <a class="text-white" href="{{ url('/') }}">Home</a>
                </li>
                <li>
                    <img src="{{ asset('site/assets/icons/right.svg') }}" alt="chevron-right">
                </li>
                <li>
                    <span class="text-muted">{{ $news->title }}</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="image flex">
        <img src="{{ $news->thumbnail ? asset($news->thumbnail) : asset('data/no_image.jpg') }}" alt="{{ $news->title }}">
    </div>

    <div class="content">
        <div class="container">
            <h1 class="mb-20 text-white letter-spacing-1">{{ $news->title }}</h1>
            <ul class="flex items-center flex-wrap gap-20">
                <li><a class="text-white" href="javascript:void(0)">by Admin</a></li>
                <li><a class="text-white" href="javascript:void(0)">{{ optional($news->created_at)->format('d/m/Y') }}</a></li>
                <li><a class="uppercase text-underline text-highlight" href="javascript:void(0)">{{ optional($news->category)->name ?? 'NEWS' }}</a></li>
            </ul>
        </div>
    </div>
</section>

<section>
    <div class="tf-spacing"></div>

    <div class="container innerpage-container">
        <div class="innerpage__content md-mb-30">
            <img class="post--img radius-20 flex mb-40" src="{{ $news->thumbnail ? asset($news->thumbnail) : asset('data/no_image.jpg') }}" alt="{{ $news->title }}">

            @if(!empty($lead))
                <p class="h7 text-secondary mb-28 line-height-28">{{ $lead }}</p>
            @endif

            <div class="quote mb-28">
                <div class="content">
                    <p class="h4 mb-14 capitalize">"{{ $quote }}"</p>
                    <p class="h7 flex items-center gap-8">
                        <img src="{{ asset('site/assets/icons/line.svg') }}" alt="quote">
                        {{ $siteSetting->company_name ?? 'ADANA Group' }}
                    </p>
                </div>
                <img class="icon-quote" src="{{ asset('site/assets/icons/quote.svg') }}" alt="quote">
            </div>

            <div class="text-secondary h7 line-height-28 mb-40">
                {!! $news->content ?: '<p>Nội dung bài viết đang được cập nhật.</p>' !!}
            </div>

            <div class="flex justify-between mb-40 gap-16 md-flex-col">
                <ul class="blog-detail-tags flex gap-12">
                    <li>
                        <p>Tag:</p>
                    </li>
                    <li>
                        <a href="javascript:void(0)">{{ optional($news->category)->name ?? 'Tin tức' }}</a>
                    </li>
                </ul>

                <ul class="blog-detail-social flex gap-12">
                    <li>
                        <p>Share this post:</p>
                    </li>
                    <li>
                        <a href="{{ $siteSetting->facebook ?? '#' }}">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_13439_102340)">
                                    <path d="M6.25 11.25L8.75 8.75L11.25 11.25L13.75 8.75" stroke="#1C1C1C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.24382 16.4932C7.81923 17.405 9.67248 17.7127 11.458 17.359C13.2436 17.0053 14.8396 16.0143 15.9484 14.5708C17.0573 13.1273 17.6033 11.3298 17.4847 9.51341C17.3662 7.69704 16.5911 5.98577 15.304 4.69866C14.0169 3.41156 12.3056 2.63646 10.4892 2.51789C8.67284 2.39932 6.87533 2.94537 5.43182 4.05422C3.98831 5.16308 2.99733 6.75906 2.64363 8.54461C2.28993 10.3302 2.59766 12.1834 3.50944 13.7588L2.5321 16.6768C2.49538 16.7869 2.49005 16.9051 2.51671 17.0181C2.54337 17.131 2.60097 17.2344 2.68306 17.3165C2.76514 17.3985 2.86847 17.4561 2.98145 17.4828C3.09443 17.5095 3.2126 17.5041 3.32273 17.4674L6.24382 16.4932Z" stroke="#1C1C1C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_13439_102340">
                                        <rect width="20" height="20" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ $siteSetting->twitter ?? '#' }}">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_13439_102345)">
                                    <path d="M3.75 3.125H7.5L16.25 16.875H12.5L3.75 3.125Z" stroke="#1C1C1C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.89687 11.2129L3.75 16.8746" stroke="#1C1C1C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.2484 3.125L11.1016 8.78672" stroke="#1C1C1C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_13439_102345">
                                        <rect width="20" height="20" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ $siteSetting->instagram ?? '#' }}">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_13439_102351)">
                                    <path d="M10 13.125C11.7259 13.125 13.125 11.7259 13.125 10C13.125 8.27411 11.7259 6.875 10 6.875C8.27411 6.875 6.875 8.27411 6.875 10C6.875 11.7259 8.27411 13.125 10 13.125Z" stroke="#1C1C1C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.75 2.5H6.25C4.17893 2.5 2.5 4.17893 2.5 6.25V13.75C2.5 15.8211 4.17893 17.5 6.25 17.5H13.75C15.8211 17.5 17.5 15.8211 17.5 13.75V6.25C17.5 4.17893 15.8211 2.5 13.75 2.5Z" stroke="#1C1C1C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14.0625 6.71875C14.494 6.71875 14.8438 6.36897 14.8438 5.9375C14.8438 5.50603 14.494 5.15625 14.0625 5.15625C13.631 5.15625 13.2812 5.50603 13.2812 5.9375C13.2812 6.36897 13.631 6.71875 14.0625 6.71875Z" fill="#1C1C1C"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_13439_102351">
                                        <rect width="20" height="20" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

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
</section>
@endsection
