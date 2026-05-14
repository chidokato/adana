@extends('frontend.layout.main')

@section('content')
@php
    $plainContent = trim(strip_tags($news->content ?: ''));
    $lead = $news->description ?: \Illuminate\Support\Str::limit($plainContent, 220);
    $contentHtml = $news->content ?: '<p>Nội dung bài viết đang được cập nhật.</p>';
@endphp

<section class="blog-details-banner">
    <div class="image flex">
        <img src="{{ $news->thumbnail ? asset($news->thumbnail) : asset('data/no_image.jpg') }}" alt="{{ $news->title }}">
    </div>
</section>

<section>
    <div class="bloc-details-container">
        <h1 class="title-2 mb-16 capitalize text-center">{{ $news->title }}</h1>

        <ul class="bloc-details-tag-style-2 mb-40">
            <li>
                <a class="h7" href="javascript:void(0)">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2.25C10.0716 2.25 8.18657 2.82183 6.58319 3.89317C4.97982 4.96451 3.73013 6.48726 2.99218 8.26884C2.25422 10.0504 2.06114 12.0108 2.43735 13.9021C2.81355 15.7934 3.74215 17.5307 5.10571 18.8943C6.46928 20.2579 8.20656 21.1865 10.0979 21.5627C11.9892 21.9389 13.9496 21.7458 15.7312 21.0078C17.5127 20.2699 19.0355 19.0202 20.1068 17.4168C21.1782 15.8134 21.75 13.9284 21.75 12C21.7473 9.41498 20.7192 6.93661 18.8913 5.10872C17.0634 3.28084 14.585 2.25273 12 2.25ZM6.945 18.5156C7.48757 17.6671 8.23501 16.9688 9.11843 16.4851C10.0019 16.0013 10.9928 15.7478 12 15.7478C13.0072 15.7478 13.9982 16.0013 14.8816 16.4851C15.765 16.9688 16.5124 17.6671 17.055 18.5156C15.6097 19.6397 13.831 20.2499 12 20.2499C10.169 20.2499 8.39032 19.6397 6.945 18.5156ZM9 11.25C9 10.6567 9.17595 10.0766 9.5056 9.58329C9.83524 9.08994 10.3038 8.70542 10.852 8.47836C11.4001 8.2513 12.0033 8.19189 12.5853 8.30764C13.1672 8.4234 13.7018 8.70912 14.1213 9.12868C14.5409 9.54824 14.8266 10.0828 14.9424 10.6647C15.0581 11.2467 14.9987 11.8499 14.7716 12.3981C14.5446 12.9462 14.1601 13.4148 13.6667 13.7444C13.1734 14.0741 12.5933 14.25 12 14.25C11.2044 14.25 10.4413 13.9339 9.87868 13.3713C9.31607 12.8087 9 12.0456 9 11.25ZM18.165 17.4759C17.3285 16.2638 16.1524 15.3261 14.7844 14.7806C15.5192 14.2019 16.0554 13.4085 16.3184 12.5108C16.5815 11.6132 16.5582 10.6559 16.252 9.77207C15.9457 8.88825 15.3716 8.12183 14.6096 7.5794C13.8475 7.03696 12.9354 6.74548 12 6.74548C11.0646 6.74548 10.1525 7.03696 9.39044 7.5794C8.62839 8.12183 8.05432 8.88825 7.74805 9.77207C7.44179 10.6559 7.41855 11.6132 7.68157 12.5108C7.94459 13.4085 8.4808 14.2019 9.21563 14.7806C7.84765 15.3261 6.67147 16.2638 5.835 17.4759C4.77804 16.2873 4.0872 14.8185 3.84567 13.2464C3.60415 11.6743 3.82224 10.0658 4.47368 8.61478C5.12512 7.16372 6.18213 5.93192 7.51745 5.06769C8.85276 4.20346 10.4094 3.74367 12 3.74367C13.5906 3.74367 15.1473 4.20346 16.4826 5.06769C17.8179 5.93192 18.8749 7.16372 19.5263 8.61478C20.1778 10.0658 20.3959 11.6743 20.1543 13.2464C19.9128 14.8185 19.222 16.2873 18.165 17.4759Z" fill="#1C1C1C"/>
                    </svg>
                    Admin
                </a>
            </li>
            <li>
                <a class="h7" href="javascript:void(0)">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.5 3H17.25V2.25C17.25 2.05109 17.171 1.86032 17.0303 1.71967C16.8897 1.57902 16.6989 1.5 16.5 1.5C16.3011 1.5 16.1103 1.57902 15.9697 1.71967C15.829 1.86032 15.75 2.05109 15.75 2.25V3H8.25V2.25C8.25 2.05109 8.17098 1.86032 8.03033 1.71967C7.88968 1.57902 7.69891 1.5 7.5 1.5C7.30109 1.5 7.11032 1.57902 6.96967 1.71967C6.82902 1.86032 6.75 2.05109 6.75 2.25V3H4.5C4.10218 3 3.72064 3.15804 3.43934 3.43934C3.15804 3.72064 3 4.10218 3 4.5V19.5C3 19.8978 3.15804 20.2794 3.43934 20.5607C3.72064 20.842 4.10218 21 4.5 21H19.5C19.8978 21 20.2794 20.842 20.5607 20.5607C20.842 20.2794 21 19.8978 21 19.5V4.5C21 4.10218 20.842 3.72064 20.5607 3.43934C20.2794 3.15804 19.8978 3 19.5 3ZM6.75 4.5V5.25C6.75 5.44891 6.82902 5.63968 6.96967 5.78033C7.11032 5.92098 7.30109 6 7.5 6C7.69891 6 7.88968 5.92098 8.03033 5.78033C8.17098 5.63968 8.25 5.44891 8.25 5.25V4.5H15.75V5.25C15.75 5.44891 15.829 5.63968 15.9697 5.78033C16.1103 5.92098 16.3011 6 16.5 6C16.6989 6 16.8897 5.92098 17.0303 5.78033C17.171 5.63968 17.25 5.44891 17.25 5.25V4.5H19.5V7.5H4.5V4.5H6.75ZM19.5 19.5H4.5V9H19.5V19.5Z" fill="#1C1C1C"/>
                    </svg>
                    {{ optional($news->created_at)->format('d/m/Y') }}
                </a>
            </li>
            <li>
                <a class="h7" href="{{ !empty(optional($news->category)->slug) ? url($news->category->slug) : 'javascript:void(0)' }}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M23.1244 11.5837L18.8438 5.16844C18.7075 4.96296 18.5225 4.79439 18.3053 4.67776C18.088 4.56113 17.8453 4.50006 17.5988 4.5H3.75C3.35218 4.5 2.97064 4.65804 2.68934 4.93934C2.40804 5.22064 2.25 5.60218 2.25 6V18C2.25 18.3978 2.40804 18.7794 2.68934 19.0607C2.97064 19.342 3.35218 19.5 3.75 19.5H17.5988C17.8451 19.4995 18.0876 19.4384 18.3047 19.322C18.5219 19.2056 18.707 19.0375 18.8438 18.8325L23.1216 12.4163C23.2042 12.2933 23.2486 12.1486 23.2491 12.0004C23.2496 11.8523 23.2062 11.7073 23.1244 11.5837ZM17.5988 18H3.75V6H17.5988L21.5981 12L17.5988 18Z" fill="#1C1C1C"/>
                    </svg>
                    {{ optional($news->category)->name ?? 'NEWS' }}
                </a>
            </li>
        </ul>

        <div class="quote mb-28">
            <div class="content">
                <p class="text-secondary mb-14 line-height-28">"{{ $lead ?: $news->title }}"</p>
                <p class="h7 flex items-center gap-8">
                    <img src="{{ asset('site/assets/icons/line.svg') }}" alt="quote">
                    {{ $siteSetting->company_name ?? 'ADANA Group' }}
                </p>
            </div>
            <img class="icon-quote" src="{{ asset('site/assets/icons/quote.svg') }}" alt="quote">
        </div>

        <div class="product-detail-content text-secondary mb-40">
            {!! $contentHtml !!}
        </div>

        <div class="flex justify-between mb-40 gap-16 md-flex-col">
            <ul class="blog-detail-tags flex gap-12">
                <li><p>Tag:</p></li>
                <li><a href="javascript:void(0)">{{ optional($news->category)->name ?? 'Tin tức' }}</a></li>
            </ul>

            <ul class="blog-detail-social flex gap-12">
                <li><p>Share this post:</p></li>
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
</section>

@if(collect($latestNews ?? [])->isNotEmpty())
    <section class="pt-0 pb-100">
        <div class="container">
            <div class="title-section mb-28">
                <h2>Tin liên quan</h2>
                <p class="text-secondary">Cập nhật thêm các bài viết mới nhất từ Adana Việt Nam.</p>
            </div>

            <div class="swiper-container swiper-news">
                <div class="swiper-wrapper">
                    @foreach($latestNews as $latestNewsItem)
                        <div class="swiper-slide">
                            <a href="{{ route('frontend.news.show', $latestNewsItem->slug) }}" class="post-style-2 overflow-hidden">
                                <img class="post--img flex" src="{{ $latestNewsItem->thumbnail ? asset($latestNewsItem->thumbnail) : asset('data/no_image.jpg') }}" alt="{{ $latestNewsItem->title }}">
                                <div class="content">
                                    <p class="h5 text-white mb-8 title">{{ $latestNewsItem->title }}</p>
                                    <div class="flex gap-8 justify-start">
                                        <span class="text-white text-xs">by Admin</span>
                                        <span class="text-white text-xs">{{ optional($latestNewsItem->created_at)->format('d/m/Y') }}</span>
                                        <span class="text-xs text-highlight uppercase text-underline">{{ optional($latestNewsItem->category)->name ?? 'NEWS' }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="swiper-pagination pagination-dark pagination-style pagination-swiper-news mt-35"></div>
            </div>
        </div>
    </section>
@endif
@endsection
