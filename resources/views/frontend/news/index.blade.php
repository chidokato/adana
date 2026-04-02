@extends('frontend.layout.main')

@section('content')
@php
    $keyword = request('q');
    $currentUrl = isset($currentNewsCategory)
        ? route('frontend.news.category', $currentNewsCategory->slug)
        : route('frontend.news');
    $recentPosts = $homeNews->take(4);
@endphp

<!-- breadcrumb -->
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
                <span>News</span>
            </li>
        </ul>
    </div>
</section>
<!-- breadcrumb -->

<section class="pb-100">
    <div class="container">
        <h2>Blog List</h2>
    </div>
    <div class="tf-spacing-style3"></div>

    <div class="container innerpage-container">
        <div class="innerpage__content md-mb-30">
            @if($newsList->count())
                <div class="grid grid-cols-1 gap-y-39 gap-x-30 mb-40">
                    @foreach($newsList as $news)
                        <div class="post-style-7 overflow-hidden">
                            <div class="image">
                                <img class="post--img flex" src="{{ $news->thumbnail ? asset($news->thumbnail) : asset('data/no_image.jpg') }}" alt="{{ $news->title }}">
                            </div>
                            <div class="content">
                                <div class="flex gap-12 justify-start mb-16">
                                    <span class="text-sm">by Admin</span>
                                    <span class="text-sm">{{ optional($news->created_at)->format('M. d, Y') }}</span>
                                    <span class="text-sm text-highlight uppercase text-underline">{{ optional($news->category)->name ?? 'NEWS' }}</span>
                                </div>
                                <a href="{{ route('frontend.news.show', $news->slug) }}" class="title h4 mb-20">
                                    {{ $news->title }}
                                </a>
                                <p class="clamp clamp-3 text-secondary mb-20">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($news->description ?: $news->content ?: 'Article content is being updated.'), 180) }}
                                </p>

                                <a href="{{ route('frontend.news.show', $news->slug) }}" class="read-more">Read More</a>
                            </div>
                        </div>

                        @if(!$loop->last)
                            <div class="divider"></div>
                        @endif
                    @endforeach
                </div>

                {{ $newsList->links() }}
            @else
                <div class="grid grid-cols-1 gap-y-39 gap-x-30 mb-40">
                    <div class="post-style-7 overflow-hidden">
                        <div class="content">
                            <a href="javascript:void(0)" class="title h4 mb-20">
                                No articles found
                            </a>
                            <p class="clamp clamp-3 text-secondary mb-20">
                                Please try another keyword or browse all categories.
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="innerpage__sidebar">
            <form action="{{ $currentUrl }}" method="get" class="widget-search w-full mb-34">
                <input class="input-normal" type="text" name="q" id="search-header" value="{{ $keyword }}" placeholder="Search products..." />
                <button type="submit" class="widget-search-btn">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_13399_10504)">
                            <path d="M10.5 18C14.6421 18 18 14.6421 18 10.5C18 6.35786 14.6421 3 10.5 3C6.35786 3 3 6.35786 3 10.5C3 14.6421 6.35786 18 10.5 18Z" stroke="#1C1C1C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M15.8047 15.8047L21.0012 21.0012" stroke="#1C1C1C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_13399_10504">
                                <rect width="24" height="24" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                </button>
            </form>

            <p class="h4 mb-16">
                Categories
            </p>

            <ul class="widget-categories mb-32">
                <li>
                    <a href="{{ route('frontend.news') }}" class="{{ !isset($currentNewsCategory) ? 'active' : '' }}">
                        <span class="label">All News</span>
                        <span>({{ $totalNewsCount ?? $newsList->total() }})</span>
                    </a>
                </li>
                @foreach(($newsCategories ?? collect()) as $category)
                    <li>
                        <a href="{{ route('frontend.news.category', $category->slug) }}" class="{{ isset($currentNewsCategory) && $currentNewsCategory->id === $category->id ? 'active' : '' }}">
                            <span class="label">{{ $category->name }}</span>
                            <span>({{ $newsCategoryCounts[$category->id] ?? 0 }})</span>
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="divider mb-32 w-full"></div>

            <p class="h4 mb-16 capitalize">
                Recent posts
            </p>

            <div class="mb-32">
                @foreach($recentPosts as $recent)
                    <a href="{{ route('frontend.news.show', $recent->slug) }}" class="recent-post overflow-hidden mb-16">
                        <div class="image">
                            <img class="post--img flex" src="{{ $recent->thumbnail ? asset($recent->thumbnail) : asset('data/no_image.jpg') }}" alt="{{ $recent->title }}">
                        </div>
                        <div class="content">
                            <div class="flex gap-12 md-gap-6 justify-start mb-6">
                                <span class="text-xs">by Admin</span>
                                <span class="text-xs">{{ optional($recent->created_at)->format('M. d, Y') }}</span>
                                <span class="text-xs text-highlight uppercase text-underline">{{ optional($recent->category)->name ?? 'NEWS' }}</span>
                            </div>
                            <p class="title h7">
                                {{ \Illuminate\Support\Str::limit($recent->title, 60) }}
                            </p>
                        </div>
                    </a>
                    @if(!$loop->last)
                        <div class="divider mb-16 w-full"></div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
