<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $seoTitle ?? ($pageTitle ?? config('app.name')) }}</title>
	<link rel="stylesheet" href="{{ asset('site/assets/scss/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/app.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/pages.css') }}">
	<meta name="description" content="{{ $seoDescription ?? ($pageDescription ?? '') }}">
	<meta property="og:image" content="{{ !empty($siteSetting->logo) ? asset($siteSetting->logo) : asset('site/assets/images/logo.png') }}">
	<meta property="og:type" content="website">
    <link rel="canonical" href="{{ url()->current() }}">
    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ !empty($siteSetting->favicon) ? asset($siteSetting->favicon) : asset('site/assets/images/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ !empty($siteSetting->favicon) ? asset($siteSetting->favicon) : asset('site/assets/images/favicon.png') }}">
</head>
<body>
	<!-- preloade -->
	<div class="preload preload-container">
		<img class="preload--icon" src="{{ !empty($siteSetting->logo) ? asset($siteSetting->logo) : asset('site/assets/images/logo.png') }}" alt="{{ $siteSetting->company_name ?? config('app.name') }}">
	  </div>
	  <!-- preload -->

	<!-- <div class="fixed-header-primary"></div>  -->

    <div id="wrapper"> 
		<!-- Header -->
@include('frontend.partials.header')
<!-- Header -->

        <section class="home-hero-title-section">
            <div class="container">
                <h1 class="home-hero-title">
                    Hóa chất tốt nhất với <span>hiệu suất vượt trội</span>
                </h1>
            </div>
        </section>

		<!-- page-title -->
		<section class="page-title flex h-800 page-title-style-1">
			@if(!empty($siteSliders) && $siteSliders->count())
				<div class="swiper-container page-title--slider sw-single">
					<div class="swiper-wrapper">
						@foreach($siteSliders as $slide)
							<div class="swiper-slide">
								<div class="tp-showcase-slider-bg" data-background="{{ asset($slide->image) }}"></div>
							</div>
						@endforeach
					</div>
					<div class="swiper-pagination pagination-white pagination-style pagination-page-title--slider-1"></div>
				</div>
			@else
				<div class="tp-showcase-slider-bg" data-background="{{ asset('site/assets/images/page-title/banner-4.jpg') }}"></div>
			@endif
		</section>
		<!-- page-title -->

		@php
			$aboutConfig = $homeConfigs->get('about');
			$introConfig = $homeConfigs->get('intro_section');
			$companyName = $siteSetting->company_name ?? config('app.name', 'ADANA Group');
			$homeAboutTitle = optional($aboutConfig)->title ?: optional($introConfig)->title ?: $companyName;
			$homeAboutLead = optional($aboutConfig)->content ?: optional($introConfig)->content ?: optional($introConfig)->description ?: ('<p>' . e($siteSetting->short_intro ?? 'ADANA Group cung cấp giải pháp trọn gói trong lĩnh vực HVAC, vật tư tiêu hao, hóa chất công nghiệp và gia công cơ khí theo yêu cầu.') . '</p>');
			$homeAboutMainImage = !empty(optional($aboutConfig)->image) ? asset(optional($aboutConfig)->image) : (!empty(optional($introConfig)->image) ? asset(optional($introConfig)->image) : asset('site/assets/images/pages/about-1.jpg'));
			$homeAboutSubImage = !empty(optional($aboutConfig)->sub_image)
                ? asset(optional($aboutConfig)->sub_image)
                : (!empty(optional($introConfig)->sub_image)
                    ? asset(optional($introConfig)->sub_image)
                    : asset('site/assets/images/pages/about-2.jpg'));
			$homePhone = $siteSetting->hotline ?? '0936 361 248';
		@endphp

		<section class="py-100 home-about-section">
			<div class="container">
				<div class="row items-center">
					<div class="col-lg-6">
						<div class="home-about-box wow fadeIn" data-wow-delay="0.1s">
							<img class="main-img radius-16 mb-32" src="{{ $homeAboutMainImage }}" alt="{{ $homeAboutTitle }}">
							<div class="sub-img wow fadeInUp mb-32" data-wow-delay="0.2s">
								<img src="{{ $homeAboutSubImage }}" alt="{{ $companyName }}">
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="home-about-content wow fadeInUp" data-wow-delay="0.2s">
							<h2 class="font-weight-600 mb-20">{{ $homeAboutTitle }}</h2>
							<div class="intro-lead mb-20 text-justify">{!! $homeAboutLead !!}</div>

							<ul class="flex flex-col gap-12 mb-20">
								<li class="flex gap-12">
									<img class="w-24 h-24" src="{{ asset('site/assets/icons/check.svg') }}" alt="check">
									<p class="h7">Một đầu mối liên hệ cho nhiều hạng mục kỹ thuật, thiết bị và vật tư.</p>
								</li>
								<li class="flex gap-12">
									<img class="w-24 h-24" src="{{ asset('site/assets/icons/check.svg') }}" alt="check">
									<p class="h7">Kết hợp dịch vụ, sản xuất, cung ứng và hậu mãi trong cùng hệ sinh thái.</p>
								</li>
								<li class="flex gap-12">
									<img class="w-24 h-24" src="{{ asset('site/assets/icons/check.svg') }}" alt="check">
									<p class="h7">Đồng hành cùng nhà máy, tòa nhà và doanh nghiệp bằng giải pháp sát nhu cầu thực tế.</p>
								</li>
							</ul>

							<div class="flex gap-28 items-center flex-wrap">
	                            <a href="{{ route('frontend.contact') }}" class="btn btn-primary btn-large font-weight-600">
	                                Liên hệ ngay
	                            </a>

	                            <a href="tel:0936361248" class="flex gap-16">
	                                <img src="{{ asset('site/assets/icons/PhoneCall-3.svg') }}" alt="PhoneCall">
	                                <div class="mt2">
	                                    <span class="text-sm text-secondary">Tư vấn nhanh</span>
	                                    <p class="h4">{{ $homePhone }}</p>
	                                </div>
	                            </a>
	                        </div>
							
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Trending Searches Near You -->
		<section class="py-100 background-light"> 
			<div class="container wow fadeIn" data-wow-delay="0.1s">
				
				<div class="swiper-container swiper-card-4">
					<div class="swiper-wrapper">
						@foreach($homeProducts as $product)
							<div class="swiper-slide">
								<div class="card-box card-box-style-8">
									<div class="top">
										<p class="bg-primary-2 text-white highlight">Sản phẩm</p>
									</div>
									<div class="image">
										<a href="#">
											<img class="card--img" src="{{ $product->thumbnail ? asset($product->thumbnail) : asset('data/no_image.jpg') }}" alt="{{ $product->title }}">
										</a>
									</div>
									<div class="content">
										<p class="h6 card-box__title mb-8">
											<a href="#">{{ $product->title }}</a>
										</p>
										<ul class="tag mb-10">
											@if(!empty($product->product_code))
												<li>
													<img src="{{ asset('site/assets/icons/icon-gauge.svg') }}" alt="code">
													<span>{{ $product->product_code }}</span>
												</li>
											@endif
											@if(!empty(optional($product->category)->name))
												<li>
													<img src="{{ asset('site/assets/icons/calendar.svg') }}" alt="category">
													<span>{{ $product->category->name }}</span>
												</li>
											@endif
										</ul>
										<p class="h6 card-box__price mb-15 flex justify-between gap-8 items-center">
											{{ number_format((float) $product->price, 0, ',', '.') }} đ
										</p>
										<div class="divider mb-15"></div>
										<div class="flex justify-between flex-wrap">
											<a href="#" class="compare-details btn btn-small">Mã: {{ $product->product_code ?: '---' }}</a>
											<a href="#" class="view-details">
												Xem chi tiết
												<img class="ml-4" src="{{ asset('site/assets/icons/CaretCircleRight.svg') }}" alt="CaretCircleRight.svg">
											</a>
										</div>
									</div>
								</div>
							</div>
						@endforeach
					</div>

					<div class="swiper-pagination pagination-dark pagination-style pagination-swiper-card-4 mt-38"></div>
				</div>
			</div>
		</section>

		<section class="py-100 bg-white"> 
			<div class="container">
				<div class="title-section mb-28 wow fadeInDown" data-wow-delay="0.1s">
					<h2 class="">{{ optional($homeConfigs->get('news_section'))->title ?? 'Tin tức' }}</h2>
					<a href="{{ route('frontend.news') }}" class="btn btn-line-style-2 effect-line-primary btn-large hover-fill-white home-view-all-btn">
						{{ optional($homeConfigs->get('news_section'))->note ?? 'Xem tất cả' }}
						<svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M8.125 0C6.51803 0 4.94714 0.476523 3.611 1.36931C2.27485 2.2621 1.23344 3.53105 0.618482 5.0157C0.00352044 6.50035 -0.157382 8.13401 0.156123 9.71011C0.469628 11.2862 1.24346 12.7339 2.37976 13.8702C3.51606 15.0065 4.9638 15.7804 6.5399 16.0939C8.11599 16.4074 9.74966 16.2465 11.2343 15.6315C12.719 15.0166 13.9879 13.9752 14.8807 12.639C15.7735 11.3029 16.25 9.73197 16.25 8.125C16.2477 5.97081 15.391 3.90551 13.8677 2.38227C12.3445 0.85903 10.2792 0.00227486 8.125 0ZM11.6922 8.56719L9.19219 11.0672C9.07492 11.1845 8.91586 11.2503 8.75 11.2503C8.58415 11.2503 8.42509 11.1845 8.30782 11.0672C8.19054 10.9499 8.12466 10.7909 8.12466 10.625C8.12466 10.4591 8.19054 10.3001 8.30782 10.1828L9.74141 8.75H5C4.83424 8.75 4.67527 8.68415 4.55806 8.56694C4.44085 8.44973 4.375 8.29076 4.375 8.125C4.375 7.95924 4.44085 7.80027 4.55806 7.68306C4.67527 7.56585 4.83424 7.5 5 7.5H9.74141L8.30782 6.06719C8.19054 5.94991 8.12466 5.79085 8.12466 5.625C8.12466 5.45915 8.19054 5.30009 8.30782 5.18281C8.42509 5.06554 8.58415 4.99965 8.75 4.99965C8.91586 4.99965 9.07492 5.06554 9.19219 5.18281L11.6922 7.68281C11.7503 7.74086 11.7964 7.80979 11.8279 7.88566C11.8593 7.96154 11.8755 8.04287 11.8755 8.125C11.8755 8.20713 11.8593 8.28846 11.8279 8.36434C11.7964 8.44021 11.7503 8.50914 11.6922 8.56719Z" fill="#1C1C1C"/>
						</svg>
					</a>
				</div>
				<div class="swiper-container swiper-news wow fadeIn" data-wow-delay="0.1s">
					<div class="swiper-wrapper">
						@foreach($homeNews as $news)
							<div class="swiper-slide">
								<a href="#" class="post-style-2 overflow-hidden">
									<img class="post--img flex" src="{{ $news->thumbnail ? asset($news->thumbnail) : asset('data/no_image.jpg') }}" alt="{{ $news->title }}">
									<div class="content">
										<p class="h5 text-white mb-8 title">
											{{ $news->title }}
										</p>
										<div class="flex gap-8 justify-start">
											<span class="text-white text-xs">by Admin</span>
											<span class="text-white text-xs">{{ optional($news->created_at)->format('d/m/Y') }}</span>
											<span class="text-xs text-highlight uppercase text-underline">{{ optional($news->category)->name ?? 'NEWS' }}</span>
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
		<!-- Trending Searches Near You -->


		<!-- Footer -->
		@include('frontend.partials.footer')
		<!-- Footer -->
    </div>
     
	<!-- Modal -->
	<div id="CardModal" class="modal">
		<div class="bg-modal"></div>
		<div class="modal-content">
			<button class="close-modal">
				<img src="{{ asset('site/assets/icons/close-modal.svg') }}" alt="close-modal">
			</button>
			<div class="modal-container">
				<div class="modal-inner">
					<div class="card-details">
						<div class="flex mb-40">
							<div class="w-24"></div>
							<div class="w-76 grid grid-cols-2 gap-60">
								<div>
									<img class="mb-10 radius-16" src="{{ asset('site/assets/images/card/card-50.jpg') }}" alt="">
									<p class="h4 text-center">Audi A6 Avant E-Tron</p>
								</div>
								<div>
									<img class="mb-10 radius-16" src="{{ asset('site/assets/images/card/card-51.jpg') }}" alt="">
									<p class="h4 text-center">2024 Hyundai Elantra</p>
								</div>
							</div>
						</div>

						<table class="card-details--table">
							<tr>
								<td>
									<div class="flex items-center gap-8">
										<img src="{{ asset('site/assets/icons/mileage.svg') }}" alt="mileage">
										<span>Mileage:</span>
									</div>
								</td>
								<td>51600 km</td>
								<td>42600 km</td>
							</tr>
							<tr>
								<td>
									<div class="flex items-center gap-8">
										<img src="{{ asset('site/assets/icons/years.svg') }}" alt="mileage">
										<span>Years:</span>
									</div>
								</td>
								<td>2022</td>
								<td>2021</td>
							</tr>
							<tr>
								<td>
									<div class="flex items-center gap-8">
										<img src="{{ asset('site/assets/icons/fuel.svg') }}" alt="mileage">
										<span>Fuel:</span>
									</div>
								</td>
								<td>Benzin + Plin</td>
								<td>Benzin + Plin</td>
							</tr>
							<tr>
								<td>
									<div class="flex items-center gap-8">
										<img src="{{ asset('site/assets/icons/color.svg') }}" alt="mileage">
										<span>Color:</span>
									</div>
								</td>
								<td>White</td>
								<td>Gold</td>
							</tr>
							<tr>
								<td>
									<div class="flex items-center gap-8">
										<img src="{{ asset('site/assets/icons/location.svg') }}" alt="mileage">
										<span>Location:</span>
									</div>
								</td>
								<td>Tampa, FL</td>
								<td>Tampa, FL</td>
							</tr>

							<tr>
								<td>
									<div class="flex items-center gap-8">
										<img src="{{ asset('site/assets/icons/interior.svg') }}" alt="mileage">
										<span>Interior:</span>
									</div>
								</td>
								<td>Jet Black</td>
								<td>Jet Brown</td>
							</tr>

							<tr>
								<td>
									<div class="flex items-center gap-8">
										<img src="{{ asset('site/assets/icons/engine.svg') }}" alt="mileage">
										<span>Engine:</span>
									</div>
								</td>
								<td>1.5L Inline</td>
								<td>2.5L Inline</td>
							</tr>
							<tr>
								<td>
									<div class="flex items-center gap-8">
										<img src="{{ asset('site/assets/icons/transmission.svg') }}" alt="mileage">
										<span>Transmission:</span>
									</div>
								</td>
								<td>Automatic</td>
								<td>Automatic</td>
							</tr>
							<tr>
								<td>
									<div class="flex items-center gap-8 ">
										<img src="{{ asset('site/assets/icons/VIN.svg') }}" alt="mileage">
										<span>VIN:</span>
									</div>
								</td>
								<td>1G1ZD5ST0PF</td>
								<td>1G1ZD5ST0PF</td>
							</tr>
							<tr>
								<td>
									<div class="flex items-center gap-8">
										<img src="{{ asset('site/assets/icons/QrCode.svg') }}" alt="mileage">
										<span>Stock Number:</span>
									</div>
								</td>
								<td>165921</td>
								<td>165921</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Modal -->

	<!-- LoginModal -->
	<div id="LoginModal" class="modal modal-login">
		<div class="bg-modal"></div>
		<div class="modal-content modal-sm">
			<button class="close-modal">
				<img src="{{ asset('site/assets/icons/close-modal.svg') }}" alt="close-modal">
			</button>
			<div class="modal-container">
				<div class="modal-inner">
					<h2 class="mb-20 text-center">Log In</h2>

					<form action="#">
						<div class="resutl mb-20">
							<p class="text-secondary mb-4">Username: <span class="font-weight-600 capitalize">demo</span></p>
							<p class="text-secondary">Password: <span class="font-weight-600 capitalize">demo</span></p>
						</div>

						<label for="email-login" class="mb-20 px-2">
							<span class="mb-8 flex">Email*</span>
							<input class="input-large active" value="themesflat@gmail.com" type="email" id="email-login" name="email-login" placeholder="Enter your email" required>
						</label>

						<label for="Password-login" class="mb-24 px-2">
							<span class="flex mb-8">Password*</span>
							<input class="input-large active password-input is-hidden" type="password" id="Password-login" name="Password-login" placeholder="Password" required>
						</label>

						<div class="flex justify-between gap-12 mb-20">
							<label class="filter-checkbox style-5">
								<input type="checkbox" name="features" value="touch-screen" checked>
								<span class="text-sm">Remember me</span>
							</label>

							<span class="text-sm font-bold text-underline open-modal cursor-pointer" data-modal-id="#ForgotPasswordModal">Forgot Your Password?</span>
						</div>

						<button type="submit" class="btn btn-primary btn-large w-full mb-12 font-weight-600">
							Login
						</button>

						<p class="text-sm text-secondary flex gap-8 justify-center open-modal cursor-pointer" data-modal-id="#SignUpModal">Not registered yet? <span class="text-sm font-weight-600 text-underline">Sign Up</span></p>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /LoginModal -->

	<!-- ForgotPasswordModal -->
	<div id="ForgotPasswordModal" class="modal modal-login">
		<div class="bg-modal"></div>
		<div class="modal-content modal-sm">
			<button class="close-modal">
				<img src="{{ asset('site/assets/icons/close-modal.svg') }}" alt="close-modal">
			</button>
			<div class="modal-container">
				<div class="modal-inner">
					<h2 class="mt-20 mb-20 text-center">Forgot Password</h2>

					<form action="#"> 

						<label for="email-forgot-password" class="mb-20 px-2">
							<span class="mb-8 flex">Username or email address *</span>
							<input class="input-large active" type="email" id="email-forgot-password" name="email-forgot-password" placeholder="Username or email address *" required>
						</label> 
						 

						<button type="submit" class="btn btn-primary btn-large w-full mb-12 font-weight-600">
							Get Reset Code
						</button>

						<p class="text-sm text-secondary flex gap-8 justify-center open-modal cursor-pointer" data-modal-id="#SignUpModal">Not registered yet? <span class="text-sm font-weight-600 text-underline">Sign Up</span></p>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /ForgotPasswordModal -->

	<!-- Search Modal -->
	<div id="SearchModal" class="search-modal">
		<div class="search-modal__overlay"></div>
		<div class="search-modal__content">
			<button class="search-modal__close" id="searchModalClose">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</button>
			<h2 class="search-modal__title">WHAT ARE YOU LOOKING FOR?</h2>
			<form class="search-modal__form" action="#" method="get">
				<div class="search-modal__input-wrapper">
					<input type="text" class="search-modal__input" placeholder="Search for anything" autocomplete="off" id="searchModalInput">
					<button type="submit" class="search-modal__submit" aria-label="Search">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M10.5 18C14.6421 18 18 14.6421 18 10.5C18 6.35786 14.6421 3 10.5 3C6.35786 3 3 6.35786 3 10.5C3 14.6421 6.35786 18 10.5 18Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M15.8047 15.8047L21.0012 21.0012" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</button>
				</div>
			</form>
		</div>
	</div>
	<!-- /Search Modal -->

	<!-- SignUpModal -->
	<div id="SignUpModal" class="modal modal-login">
		<div class="bg-modal"></div>
		<div class="modal-content modal-sm">
			<button class="close-modal">
				<img src="{{ asset('site/assets/icons/close-modal.svg') }}" alt="close-modal">
			</button>
			<div class="modal-container">
				<div class="modal-inner">
					<h2 class="mb-20 text-center">Sign Up</h2>

					<form action="#"> 
						<label for="SignUp-login" class="mb-20 px-2">
							<span class="mb-8 flex">Email*</span>
							<input class="input-large active" value="themesflat@gmail.com" type="email" id="SignUp-login" name="SignUp-login" placeholder="Enter your email" required>
						</label>

						<label for="Password-SignUp" class="mb-24 px-2">
							<span class="mb-8 flex">Password*</span>
							<input class="input-large active password-input is-hidden" type="password" id="Password-SignUp" name="Password-SignUp" placeholder="Password" required>
						</label>
						<label for="ConfirmPassword-SignUp" class="mb-20 px-2">
							<span class="mb-8 flex">Confirm password*</span>
							<input class="input-large active password-input is-hidden" type="password" id="ConfirmPassword-SignUp" name="ConfirmPassword-SignUp" placeholder="Password" required>
						</label>

						<div class="flex justify-between gap-12 mb-20">
							<label class="filter-checkbox style-5">
								<input type="checkbox" name="features" value="touch-screen" checked>
								<span class="text-sm">I agree to the <a href="terms.html" class="text-underline font-bold text-sm pl-4"> Terms of User</a></span>
							</label> 
						</div>

						<button type="submit" class="btn btn-primary btn-large w-full mb-12 font-weight-600">
							Create a new account
						</button>

						<p class="text-sm text-secondary flex gap-8 justify-center mb-20">Already have an account? <span class="text-sm font-weight-600 text-underline cursor-pointer open-modal" data-modal-id="#LoginModal">Login Here</span></p>
					
						<div class="flex justify-center items-center gap-20 mb-20">
							<p class="text-sm divider w-full"></p>
							<p class="text-sm text-secondary text-center min-w-max">or sign up with</p>
							<p class="text-sm divider w-full"></p>
						</div>

						<div class="flex flex-col gap-12 social-login">
							<a href="dashboard.html" class="font-weight-500 flex items-center gap-8">
								<img src="{{ asset('site/assets/icons/facebook.svg') }}" alt="google">
								Facebook
							</a>

							<a href="dashboard.html" class="font-weight-500 flex items-center gap-8">
								<img src="{{ asset('site/assets/icons/Google.svg') }}" alt="google">
								Google
							</a>

							<a href="dashboard.html" class="font-weight-500 flex items-center gap-8">
								<img src="{{ asset('site/assets/icons/Twitter.svg') }}" alt="google">
								X
							</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /SignUpModal -->

	<!-- CompareModal (Bottom Modal) -->
	<div id="CompareModal" class="modal modal-bottom">
		<div class="bg-modal"></div>
		<div class="modal-content">
			<button class="close-modal">
				<img src="{{ asset('site/assets/icons/close-modal.svg') }}" alt="close-modal">
			</button>
			<div class="modal-container">
				<div class="modal-inner">
					<div class="compare-modal-content">
						<div class="compare-items" id="compareItems">
							<!-- Compare items will be dynamically added here -->

							<div class="compare-item-list">
								<div class="compare-item flex items-center gap-12">
									<button class="compare-item-remove" type="button" aria-label="Remove item">
										<img src="{{ asset('site/assets/icons/close-modal.svg') }}" alt="car" class="radius-50">
									</button>
									<div class="compare-item-image">
										<img src="{{ asset('site/assets/images/card/card-3.jpg') }}" alt="car" class="radius-50">
									</div>
									<div class="compare-item-info">
										<p class="h7 font-weight-500 mb-8">2017 BMV X1 xDrive 20d xline</p>
										<div class="flex gap-4">
											<div class="flex items-center gap-4">
												<img src="{{ asset('site/assets/icons/icon-gauge.svg') }}" alt="mileage" width="16" height="16">
												<span class="text-sm">89300 miles</span>
											</div>
											<div class="flex items-center gap-4">
												<img src="{{ asset('site/assets/icons/calendar.svg') }}" alt="fuel" width="16" height="16">
												<span class="text-sm">2018</span>
											</div>
											<div class="flex items-center gap-4">
												<img src="{{ asset('site/assets/icons/gaspump.svg') }}" alt="transmission" width="16" height="16">
												<span class="text-sm">Benzin</span>
											</div>
											<div class="flex items-center gap-4">
												<img src="{{ asset('site/assets/icons/auto.svg') }}" alt="transmission" width="16" height="16">
												<span class="text-sm">Auto</span>
											</div>
										</div>
									</div>
								</div>
	
								<div class="compare-item flex items-center gap-12">
									<button class="compare-item-remove" type="button" aria-label="Remove item">
										<img src="{{ asset('site/assets/icons/close-modal.svg') }}" alt="car" class="radius-50">
									</button>
									<div class="compare-item-image">
										<img src="{{ asset('site/assets/images/card/card-4.jpg') }}" alt="car" class="radius-50">
									</div>
									<div class="compare-item-info">
										<p class="h7 font-weight-500 mb-8">2017 BMV X1 xDrive 20d xline</p>
										<div class="flex gap-4">
											<div class="flex items-center gap-4">
												<img src="{{ asset('site/assets/icons/icon-gauge.svg') }}" alt="mileage" width="16" height="16">
												<span class="text-sm">89300 miles</span>
											</div>
											<div class="flex items-center gap-4">
												<img src="{{ asset('site/assets/icons/calendar.svg') }}" alt="fuel" width="16" height="16">
												<span class="text-sm">2018</span>
											</div>
											<div class="flex items-center gap-4">
												<img src="{{ asset('site/assets/icons/gaspump.svg') }}" alt="transmission" width="16" height="16">
												<span class="text-sm">Benzin</span>
											</div>
											<div class="flex items-center gap-4">
												<img src="{{ asset('site/assets/icons/auto.svg') }}" alt="transmission" width="16" height="16">
												<span class="text-sm">Auto</span>
											</div>
										</div>
									</div>
								</div>
								<div class="compare-item flex items-center gap-12">
									<button class="compare-item-remove" type="button" aria-label="Remove item">
										<img src="{{ asset('site/assets/icons/close-modal.svg') }}" alt="car" class="radius-50">
									</button>
									<div class="compare-item-image">
										<img src="{{ asset('site/assets/images/card/card-4.jpg') }}" alt="car" class="radius-50">
									</div>
									<div class="compare-item-info">
										<p class="h7 font-weight-500 mb-8">2017 BMV X1 xDrive 20d xline</p>
										<div class="flex gap-4">
											<div class="flex items-center gap-4">
												<img src="{{ asset('site/assets/icons/icon-gauge.svg') }}" alt="mileage" width="16" height="16">
												<span class="text-sm">89300 miles</span>
											</div>
											<div class="flex items-center gap-4">
												<img src="{{ asset('site/assets/icons/calendar.svg') }}" alt="fuel" width="16" height="16">
												<span class="text-sm">2018</span>
											</div>
											<div class="flex items-center gap-4">
												<img src="{{ asset('site/assets/icons/gaspump.svg') }}" alt="transmission" width="16" height="16">
												<span class="text-sm">Benzin</span>
											</div>
											<div class="flex items-center gap-4">
												<img src="{{ asset('site/assets/icons/auto.svg') }}" alt="transmission" width="16" height="16">
												<span class="text-sm">Auto</span>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="compare-action">
								<a href="compare.html" class="btn btn-primary btn-large font-weight-600">
									Compare
								</a>
							</div>
						</div>
						
						<!-- Empty State -->
						
						<div class="compare-empty-state text-center" id="compareEmptyState" style="display: none;">
							<p class="text-muted">Your compare is currently empty</p>
						</div>
						
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<!-- /CompareModal -->
 
	 <!-- go top button -->
	<div class="progress-wrap active-progress">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
               style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 286.138;">
            </path>
        </svg> 
		<img class="progress-wrap-icon" src="{{ asset('site/assets/icons/top.svg') }}" alt="top">
    </div>
    <!-- /go top button -->

    <script src="{{ asset('site/assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('site/assets/js/jquery.cookie.min.js') }}"></script>
	<!-- jQuery UI for slider - REQUIRED by gear-slider.js -->
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
	<script src="{{ asset('site/assets/js/swiper-bundle.min.js') }}"></script>
	<script src="{{ asset('site/assets/js/swiper.js') }}"></script>
	<!-- gear-slider.js requires jQuery UI slider - must load after jquery-ui.min.js -->
	<script src="{{ asset('site/assets/js/gear-slider.js') }}"></script>
    <script src="{{ asset('site/assets/js/wow.min.js') }}"></script> 
	<script src="{{ asset('site/assets/js/simpleParallaxVanilla.umd.js') }}"></script>
    <script src="{{ asset('site/assets/js/app.js') }}"></script>
</body>

</html>
