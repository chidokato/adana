@extends('frontend.layout.main')

@section('content')
@php
    $keyword = request('q');
    $currentUrl = isset($currentNewsCategory)
        ? route('frontend.news.category', $currentNewsCategory->slug)
        : route('frontend.news');
    $recentPosts = $homeNews->take(4);
    $sidebarCategories = collect([
        [
            'label' => 'All News',
            'url' => route('frontend.news'),
            'count' => $totalNewsCount ?? $newsList->total(),
            'active' => !isset($currentNewsCategory),
        ],
    ])->merge(collect($newsCategories ?? [])->map(function ($category) use ($currentNewsCategory, $newsCategoryCounts) {
        return [
            'label' => $category->name,
            'url' => route('frontend.news.category', $category->slug),
            'count' => $newsCategoryCounts[$category->id] ?? 0,
            'active' => isset($currentNewsCategory) && $currentNewsCategory->id === $category->id,
        ];
    }));
    $sidebarRecentPosts = $recentPosts->map(function ($recent) {
        return [
            'url' => route('frontend.news.show', $recent->slug),
            'image' => $recent->thumbnail ? asset($recent->thumbnail) : asset('data/no_image.jpg'),
            'title' => \Illuminate\Support\Str::limit($recent->title, 60),
            'meta' => [
                ['text' => 'by Admin'],
                ['text' => optional($recent->created_at)->format('M. d, Y')],
                ['text' => optional($recent->category)->name ?? 'NEWS', 'class' => 'text-highlight uppercase text-underline'],
            ],
        ];
    });
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

        @include('frontend.partials.site-sidebar', [
            'sidebarSearchAction' => $currentUrl,
            'sidebarSearchName' => 'q',
            'sidebarSearchValue' => $keyword,
            'sidebarSearchPlaceholder' => 'Search products...',
            'sidebarCategoryTitle' => 'Categories',
            'sidebarCategories' => $sidebarCategories,
            'sidebarRecentTitle' => 'Recent posts',
            'sidebarRecentPosts' => $sidebarRecentPosts,
        ])
    </div>
</section>
@endsection
