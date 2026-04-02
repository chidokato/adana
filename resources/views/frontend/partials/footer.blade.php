<footer class="bg-primary footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="footer-top-inner">
                        <div>
                            <a href="{{ url('/') }}">
                                <img class="logo" src="{{ !empty($siteSetting->footer_logo) ? asset($siteSetting->footer_logo) : (!empty($siteSetting->logo) ? asset($siteSetting->logo) : asset('site/assets/images/logo-white.png')) }}" alt="logo">
                            </a>

                            @if(!empty($siteSetting->company_name))
                                <p class="text-xs uppercase font-weight-500 mb-8 text-muted">{{ $siteSetting->company_name }}</p>
                            @endif

                            @if(!empty($siteSetting->short_intro))
                                <p class="text-white mb-28">{{ $siteSetting->short_intro }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="footer-links">
                        <div class="collapse mt-4">
                            <p class="font-weight-600 text-white mb-14 collapse-title justify-between" data-breakpoint="mobile">
                                DANH MỤC SẢN PHẨM
                                <span class="icon text-white hidden md-block">+</span>
                            </p>
                            <ul class="widget-links collapse-content md-hidden">
                                @if(!empty($menuProductCategories) && $menuProductCategories->count())
                                    @foreach($menuProductCategories as $category)
                                        <li>
                                            <a href="{{ route('frontend.products.category', $category->slug ?: $category->id) }}">
                                                {{ $category->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <li><a href="javascript:void(0)">Chưa có danh mục sản phẩm</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="footer-links">
                        <div class="collapse mt-4">
                            <p class="font-weight-600 text-white mb-14 collapse-title justify-between" data-breakpoint="mobile">
                                MENU FOOTER
                                <span class="icon text-white hidden md-block">+</span>
                            </p>
                            <ul class="widget-links collapse-content md-hidden">
                                @if(!empty($footerMenuItems) && $footerMenuItems->count())
                                    @foreach($footerMenuItems as $item)
                                        <li>
                                            <a href="{{ $item->resolvedUrl() }}" target="{{ $item->target ?: '_self' }}">
                                                {{ $item->label }}
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <li><a href="javascript:void(0)">Chưa có menu footer</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="footer-contact">
                        <div>
                            @if(!empty($siteSetting->company_name))
                                <p class="font-weight-600 text-white mb-20 h5">{{ $siteSetting->company_name }}</p>
                            @endif

                            @if(!empty($siteSetting->address))
                                <div class="flex items-start gap-8 mb-12 text-white">
                                    <span style="width: 18px; min-width: 18px; display: inline-flex; justify-content: center; margin-top: 2px;">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 21C12 21 19 14.75 19 9.75C19 5.91015 15.866 3 12 3C8.13401 3 5 5.91015 5 9.75C5 14.75 12 21 12 21Z" stroke="white" stroke-width="1.8"/>
                                            <circle cx="12" cy="10" r="2.5" stroke="white" stroke-width="1.8"/>
                                        </svg>
                                    </span>
                                    <span class="text-white">{{ $siteSetting->address }}</span>
                                </div>
                            @endif

                            @if(!empty($siteSetting->email))
                                <div class="flex items-start gap-8 mb-12 text-white">
                                    <span style="width: 18px; min-width: 18px; display: inline-flex; justify-content: center; margin-top: 2px;">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4 7L12 13L20 7" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                            <rect x="3" y="5" width="18" height="14" rx="2" stroke="white" stroke-width="1.8"/>
                                        </svg>
                                    </span>
                                    <a href="mailto:{{ $siteSetting->email }}" class="text-white" style="color: #fff;">{{ $siteSetting->email }}</a>
                                </div>
                            @endif

                            @if(!empty($siteSetting->hotline))
                                <div class="flex items-start gap-8 mb-12 text-white">
                                    <span style="width: 18px; min-width: 18px; display: inline-flex; justify-content: center; margin-top: 2px;">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21 16.92V19A2 2 0 0 1 18.82 21C9.94 21 3 14.06 3 5.18A2 2 0 0 1 5 3H7.09A2 2 0 0 1 9.06 4.64L9.5 7.28A2 2 0 0 1 8.93 9.02L7.62 10.33C9.02 13.09 10.91 14.98 13.67 16.38L14.98 15.07A2 2 0 0 1 16.72 14.5L19.36 14.94A2 2 0 0 1 21 16.92Z" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <a href="tel:{{ $siteSetting->hotline }}" class="text-white" style="color: #fff;">{{ $siteSetting->hotline }}</a>
                                </div>
                            @endif

                            @if(!empty($siteSetting->zalo))
                                <div class="flex items-start gap-8 mb-12 text-white">
                                    <span style="width: 18px; min-width: 18px; display: inline-flex; justify-content: center; margin-top: 2px;">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21 11.5C21 16.1944 16.9706 20 12 20C10.4477 20 8.98733 19.6285 7.71429 18.9724L4 20L5.14286 16.9162C3.81178 15.4594 3 13.5678 3 11.5C3 6.80558 7.02944 3 12 3C16.9706 3 21 6.80558 21 11.5Z" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <span class="text-white">{{ $siteSetting->zalo }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
