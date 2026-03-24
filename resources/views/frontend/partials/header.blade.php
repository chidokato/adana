<!-- Header -->
<div class="header-wrapper">
    <header class="header header-style-1 border-bottom border-color-blur" id="">
        <div class="header-container-fluid max-w-1920 relative">
            <div class="header-inner d-flex align-items-center justify-content-between" id="site-header-inner">
                <div class="logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ !empty($siteSetting->logo) ? asset($siteSetting->logo) : asset('site/assets/images/logo-white.png') }}" alt="logo">
                    </a>
                </div>
                <div class="logo-mobile">
                    <a href="{{ url('/') }}">
                        <img src="{{ !empty($siteSetting->logo) ? asset($siteSetting->logo) : asset('site/assets/images/logo-white.png') }}" alt="logo-mobile">
                    </a>
                </div>

                <div class="header-right gap-20 header-right-style-2 main-nav-wrapper">
                    <nav id="main-nav" class="main-nav margin-right-auto">
                        <ul id="menu-primary-menu" class="menu menu style-2">
                            @if(!empty($headerMenuItems))
                                @include('frontend.partials.menu-items', ['items' => $headerMenuItems])
                            @endif
                        </ul>
                    </nav>

                    <div class="mobile-button"><span></span></div>
                </div>
            </div>
        </div>
    </header>
</div>
<!-- Header -->
