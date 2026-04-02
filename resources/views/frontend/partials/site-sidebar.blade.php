@php
    $sidebarSearchAction = $sidebarSearchAction ?? null;
    $sidebarSearchName = $sidebarSearchName ?? 'q';
    $sidebarSearchValue = $sidebarSearchValue ?? '';
    $sidebarSearchPlaceholder = $sidebarSearchPlaceholder ?? 'Search products...';
    $sidebarCategoryTitle = $sidebarCategoryTitle ?? 'Categories';
    $sidebarRecentTitle = $sidebarRecentTitle ?? 'Recent posts';
    $sidebarCategories = collect($sidebarCategories ?? []);
    $sidebarRecentPosts = collect($sidebarRecentPosts ?? []);
    $sidebarAdditionalRecentSections = collect($sidebarAdditionalRecentSections ?? []);
@endphp

<div class="innerpage__sidebar">
    @if($sidebarSearchAction)
        <form action="{{ $sidebarSearchAction }}" method="get" class="widget-search w-full mb-34">
            <input class="input-normal" type="text" name="{{ $sidebarSearchName }}" value="{{ $sidebarSearchValue }}" placeholder="{{ $sidebarSearchPlaceholder }}" />
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
    @endif

    @if($sidebarCategories->isNotEmpty())
        <p class="h4 mb-16">{{ $sidebarCategoryTitle }}</p>
        <ul class="widget-categories mb-32">
            @foreach($sidebarCategories as $category)
                <li>
                    <a href="{{ $category['url'] ?? '#' }}" class="{{ !empty($category['active']) ? 'active' : '' }}" target="{{ $category['target'] ?? '_self' }}">
                        <span class="label">{{ $category['label'] ?? '' }}</span>
                        @if(array_key_exists('count', $category))
                            <span>({{ $category['count'] }})</span>
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

    @if($sidebarRecentPosts->isNotEmpty())
        <div class="divider mb-32 w-full"></div>
        <p class="h4 mb-16 capitalize">{{ $sidebarRecentTitle }}</p>
        <div class="mb-32">
            @foreach($sidebarRecentPosts as $recent)
                <a href="{{ $recent['url'] ?? '#' }}" class="recent-post overflow-hidden mb-16">
                    <div class="image">
                        <img class="post--img flex" src="{{ $recent['image'] ?? asset('data/no_image.jpg') }}" alt="{{ $recent['title'] ?? 'post' }}">
                    </div>
                    <div class="content">
                        @if(!empty($recent['meta']))
                            <div class="flex gap-12 md-gap-6 justify-start mb-6">
                                @foreach($recent['meta'] as $meta)
                                    <span class="text-xs {!! $meta['class'] ?? '' !!}">{{ $meta['text'] ?? '' }}</span>
                                @endforeach
                            </div>
                        @endif
                        <p class="title h7">{{ $recent['title'] ?? '' }}</p>
                    </div>
                </a>
                @if(!$loop->last)
                    <div class="divider mb-16 w-full"></div>
                @endif
            @endforeach
        </div>
    @endif

    @foreach($sidebarAdditionalRecentSections as $section)
        @php
            $sectionPosts = collect($section['posts'] ?? []);
        @endphp
        @if($sectionPosts->isNotEmpty())
            <div class="divider mb-32 w-full"></div>
            <p class="h4 mb-16 capitalize">{{ $section['title'] ?? 'Recent posts' }}</p>
            <div class="mb-32">
                @foreach($sectionPosts as $recent)
                    <a href="{{ $recent['url'] ?? '#' }}" class="recent-post overflow-hidden mb-16">
                        <div class="image">
                            <img class="post--img flex" src="{{ $recent['image'] ?? asset('data/no_image.jpg') }}" alt="{{ $recent['title'] ?? 'post' }}">
                        </div>
                        <div class="content">
                            @if(!empty($recent['meta']))
                                <div class="flex gap-12 md-gap-6 justify-start mb-6">
                                    @foreach($recent['meta'] as $meta)
                                        <span class="text-xs {!! $meta['class'] ?? '' !!}">{{ $meta['text'] ?? '' }}</span>
                                    @endforeach
                                </div>
                            @endif
                            <p class="title h7">{{ $recent['title'] ?? '' }}</p>
                        </div>
                    </a>
                    @if(!$loop->last)
                        <div class="divider mb-16 w-full"></div>
                    @endif
                @endforeach
            </div>
        @endif
    @endforeach
</div>
