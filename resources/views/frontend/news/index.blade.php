@extends('frontend.layout.main')

@section('content')
@php
    $currentNewsCategory = $currentNewsCategory ?? null;
    $keyword = request('q');
    $currentUrl = isset($currentNewsCategory)
        ? $currentNewsCategory->frontend_url
        : route('frontend.news');

    $featuredNews = $newsList->first();
    $gridNews = $newsList->slice(1)->values();
    $recentPosts = $homeNews->take(4);

    $sidebarCategories = collect([
        [
            'label' => 'Tất cả tin tức',
            'url' => route('frontend.news'),
            'count' => $totalNewsCount ?? $newsList->total(),
            'active' => !isset($currentNewsCategory),
        ],
    ])->merge(collect($newsCategories ?? [])->map(function ($category) use ($currentNewsCategory, $newsCategoryCounts) {
        return [
            'label' => $category->name,
            'url' => $category->frontend_url,
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
                ['text' => 'Quản trị viên'],
                ['text' => optional($recent->created_at)->format('d/m/Y')],
                ['text' => optional($recent->category)->name ?? 'TIN TỨC', 'class' => 'text-highlight uppercase text-underline'],
            ],
        ];
    });

    $newsExcerpt = function ($news, $limit = 140) {
        return \Illuminate\Support\Str::limit(
            trim(strip_tags($news->description ?: $news->content ?: 'Nội dung bài viết đang được cập nhật.')),
            $limit
        );
    };

    $renderPaginationUrl = function ($page) use ($newsList) {
        return $newsList->appends(request()->query())->url($page);
    };
@endphp

<section class="background-light mb-32">
    <div class="container">
        <ul class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">Trang chủ</a>
            </li>
            <li>
                <img src="{{ asset('site/assets/icons/right.svg') }}" alt="chevron-right">
            </li>
            <li>
                <span>Tin tức</span>
            </li>
        </ul>
    </div>
</section>

<section class="pb-100">
    <div class="container">
        <h2>Danh sách tin tức</h2>
    </div>
    <div class="tf-spacing-style3"></div>

    <div class="container innerpage-container">
        <div class="innerpage__content md-mb-30">
            @if($featuredNews)
                <a href="{{ route('frontend.news.show', $featuredNews->slug) }}" class="post-style-2 overflow-hidden mb-40">
                    <img
                        class="post--img flex"
                        src="{{ $featuredNews->thumbnail ? asset($featuredNews->thumbnail) : asset('data/no_image.jpg') }}"
                        alt="{{ $featuredNews->title }}"
                    >
                    <div class="content">
                        <p class="h3 text-white mb-8 capitalize">
                            {{ $featuredNews->title }}
                        </p>
                        <div class="flex gap-12 justify-start mb-2">
                            <span class="text-white text-xs">Quản trị viên</span>
                            <span class="text-white text-xs">{{ optional($featuredNews->created_at)->format('d/m/Y') }}</span>
                            <span class="text-xs text-highlight uppercase text-underline">
                                {{ optional($featuredNews->category)->name ?? 'TIN TỨC' }}
                            </span>
                        </div>
                    </div>
                </a>

                @if($gridNews->isNotEmpty())
                    <div class="grid grid-cols-2 md-grid-cols-1 gap-y-40 gap-x-30 mb-40">
                        @foreach($gridNews as $news)
                            <a href="{{ route('frontend.news.show', $news->slug) }}" class="post-style-6 overflow-hidden">
                                <div class="image">
                                    <img
                                        class="post--img flex"
                                        src="{{ $news->thumbnail ? asset($news->thumbnail) : asset('data/no_image.jpg') }}"
                                        alt="{{ $news->title }}"
                                    >
                                </div>
                                <div class="content">
                                    <div class="flex gap-12 justify-start mb-12">
                                        <span class="text-sm">Quản trị viên</span>
                                        <span class="text-sm">{{ optional($news->created_at)->format('d/m/Y') }}</span>
                                        <span class="text-sm text-highlight uppercase text-underline">
                                            {{ optional($news->category)->name ?? 'TIN TỨC' }}
                                        </span>
                                    </div>
                                    <p class="h4 title mb-12">
                                        {{ $news->title }}
                                    </p>
                                    <p class="clamp clamp-2 text-secondary">
                                        {{ $newsExcerpt($news) }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif

                @if($newsList->lastPage() > 1)
                    <ul class="pagination">
                        @if($newsList->currentPage() > 1)
                            <li>
                                <a href="{{ $renderPaginationUrl($newsList->currentPage() - 1) }}" class="pagination__link" aria-label="Trang trước">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.80746 10.4423L12.0575 16.6923C12.1155 16.7504 12.1845 16.7964 12.2603 16.8278C12.3362 16.8593 12.4175 16.8755 12.4997 16.8755C12.5818 16.8755 12.6631 16.8593 12.739 16.8278C12.8148 16.7964 12.8838 16.7504 12.9418 16.6923C13 16.6342 13.046 16.5653 13.0774 16.4894C13.1088 16.4135 13.125 16.3322 13.125 16.2501C13.125 16.168 13.1088 16.0867 13.0774 16.0108C13.046 15.9349 13 15.866 12.9418 15.8079L7.13316 10.0001L12.9418 4.19229C13.0591 4.07502 13.125 3.91596 13.125 3.7501C13.125 3.58425 13.0591 3.42519 12.9418 3.30792C12.8246 3.19064 12.6655 3.12476 12.4997 3.12476C12.3338 3.12476 12.1747 3.19064 12.0575 3.30792L5.80746 9.55791C5.74938 9.61596 5.70333 9.68489 5.67184 9.76077C5.64036 9.83664 5.62415 9.91797 5.62415 10.0001C5.62415 10.0822 5.64036 10.1636 5.67184 10.2394C5.70333 10.3153 5.74938 10.3842 5.80746 10.4423Z" fill="#9FA1A4"/>
                                    </svg>
                                </a>
                            </li>
                        @endif

                        @for($page = 1; $page <= $newsList->lastPage(); $page++)
                            <li>
                                <a href="{{ $renderPaginationUrl($page) }}" class="pagination__link {{ $newsList->currentPage() === $page ? 'active' : '' }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endfor

                        @if($newsList->hasMorePages())
                            <li>
                                <a href="{{ $renderPaginationUrl($newsList->currentPage() + 1) }}" class="pagination__link" aria-label="Trang sau">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.1925 10.4423L7.94254 16.6923C7.88447 16.7504 7.81553 16.7964 7.73966 16.8278C7.66379 16.8593 7.58247 16.8755 7.50035 16.8755C7.41823 16.8755 7.33691 16.8593 7.26104 16.8278C7.18517 16.7964 7.11623 16.7504 7.05816 16.6923C7.00009 16.6342 6.95403 16.5653 6.9226 16.4894C6.89117 16.4135 6.875 16.3322 6.875 16.2501C6.875 16.168 6.89117 16.0867 6.9226 16.0108C6.95403 15.9349 7.00009 15.866 7.05816 15.8079L12.8668 10.0001L7.05816 4.19229C6.94088 4.07502 6.875 3.91596 6.875 3.7501C6.875 3.58425 6.94088 3.42519 7.05816 3.30792C7.17544 3.19064 7.3345 3.12476 7.50035 3.12476C7.6662 3.12476 7.82526 3.19064 7.94254 3.30792L14.1925 9.55791C14.2506 9.61596 14.2967 9.68489 14.3282 9.76077C14.3597 9.83664 14.3758 9.91797 14.3758 10.0001C14.3758 10.0822 14.3597 10.1636 14.3282 10.2394C14.2967 10.3153 14.2506 10.3842 14.1925 10.4423Z" fill="#9FA1A4"/>
                                    </svg>
                                </a>
                            </li>
                        @endif
                    </ul>
                @endif
            @else
                <div class="post-style-6 overflow-hidden">
                    <div class="content">
                        <div class="flex gap-12 justify-start mb-12">
                            <span class="text-sm text-highlight uppercase text-underline">Tin tức</span>
                        </div>
                        <p class="h4 title mb-12">Không tìm thấy bài viết</p>
                        <p class="clamp clamp-2 text-secondary">
                            Vui lòng thử từ khóa khác hoặc xem lại danh mục đang chọn.
                        </p>
                    </div>
                </div>
            @endif
        </div>

        @include('frontend.partials.site-sidebar', [
            'sidebarSearchAction' => $currentUrl,
            'sidebarSearchName' => 'q',
            'sidebarSearchValue' => $keyword,
            'sidebarSearchPlaceholder' => 'Tìm kiếm tin tức...',
            'sidebarCategoryTitle' => 'Danh mục tin tức',
            'sidebarCategories' => $sidebarCategories,
            'sidebarRecentTitle' => 'Bài viết mới nhất',
            'sidebarRecentPosts' => $sidebarRecentPosts,
        ])
    </div>
</section>
@endsection
