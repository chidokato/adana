@extends('frontend.layout.main')

@section('content')
@php
    $companyName = $siteSetting->company_name ?? config('app.name', 'ADANA');
    $address = $siteSetting->address ?? 'Địa chỉ đang cập nhật';
    $hotline = $siteSetting->hotline ?? 'Đang cập nhật';
    $email = $siteSetting->email ?? 'Đang cập nhật';
    $zalo = $siteSetting->zalo ?? 'Đang cập nhật';
    $intro = $siteSetting->short_intro ?? 'Chúng tôi luôn sẵn sàng hỗ trợ khi bạn cần tư vấn sản phẩm, báo giá hoặc trao đổi hợp tác.';
@endphp

<div class="contact-page-wrap">
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
                    <span>Liên hệ</span>
                </li>
            </ul>
        </div>
    </section>

    <section class="bg-white pb-84">
        <div class="tf-spacing"></div>
        <div class="container contact-page">
            <div class="grid grid-cols-2 lg-grid-cols-1 gap-30">
                <div class="contact-page-info">
                    <p class="h3 mb-12 capitalize">Liên hệ với chúng tôi</p>
                    <p class="text-body-style-2 mb-24">{{ $intro }}</p>

                    <ul class="grid grid-cols-1 gap-24 mb-24">
                        <li class="contact gap-16">
                            <div class="icon">
                                <img src="{{ asset('site/assets/icons/MapPin.svg') }}" alt="address">
                            </div>
                            <div class="flex flex-col">
                                <p class="h5 mb-8">Địa chỉ doanh nghiệp</p>
                                <p class="text-secondary">{{ $address }}</p>
                            </div>
                        </li>
                        <li class="contact gap-16">
                            <div class="icon">
                                <img src="{{ asset('site/assets/icons/PhoneCall.svg') }}" alt="phone">
                            </div>
                            <div class="flex flex-col">
                                <p class="h5 mb-8">Thông tin liên hệ</p>
                                <a href="tel:{{ preg_replace('/\s+/', '', $hotline) }}" class="text-secondary">{{ $hotline }}</a>
                                <a href="mailto:{{ $email }}" class="text-secondary">{{ $email }}</a>
                                <p class="text-secondary">Zalo: {{ $zalo }}</p>
                            </div>
                        </li>

                        <li class="contact gap-16">
                            <div class="icon">
                                <img src="{{ asset('site/assets/icons/Alarm-white.svg') }}" alt="time">
                            </div>
                            <div class="flex flex-col">
                                <p class="h5 mb-8">Thời gian hỗ trợ</p>
                                <p class="text-secondary">Thứ 2 - Thứ 7: 8:00 - 18:00</p>
                                <p class="text-secondary">Ngoài giờ: vui lòng để lại thông tin, chúng tôi sẽ phản hồi sớm</p>
                            </div>
                        </li>
                    </ul>

                    <p class="h5 mb-20 capitalize">Kết nối qua mạng xã hội:</p>

                    <ul class="contact-page-info-social flex gap-8">
                        <li>
                            <a href="#" class="hover-fill-white" aria-label="Facebook">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_contact_fb)">
                                        <path d="M11.5541 20V10.8777H14.6148L15.074 7.32156H11.5541V5.05147C11.5541 4.0222 11.8387 3.32076 13.3164 3.32076L15.1979 3.31999V0.13923C14.8725 0.0969453 13.7556 0 12.4556 0C9.74098 0 7.88252 1.65697 7.88252 4.69927V7.32156H4.8125V10.8777H7.88252V20H11.5541Z" fill="#1C1C1C"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_contact_fb">
                                            <rect width="20" height="20" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="hover-stroke-white" aria-label="X">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_contact_x)">
                                        <path d="M3.75 3.125H7.5L16.25 16.875H12.5L3.75 3.125Z" stroke="#1C1C1C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M8.89687 11.2129L3.75 16.8746" stroke="#1C1C1C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M16.2484 3.125L11.1016 8.78672" stroke="#1C1C1C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_contact_x">
                                            <rect width="20" height="20" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="hover-stroke-white" aria-label="Instagram">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_contact_ig)">
                                        <path d="M10 13.125C11.7259 13.125 13.125 11.7259 13.125 10C13.125 8.27411 11.7259 6.875 10 6.875C8.27411 6.875 6.875 8.27411 6.875 10C6.875 11.7259 8.27411 13.125 10 13.125Z" stroke="#1C1C1C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M13.75 2.5H6.25C4.17893 2.5 2.5 4.17893 2.5 6.25V13.75C2.5 15.8211 4.17893 17.5 6.25 17.5H13.75C15.8211 17.5 17.5 15.8211 17.5 13.75V6.25C17.5 4.17893 15.8211 2.5 13.75 2.5Z" stroke="#1C1C1C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M14.0625 6.71875C14.494 6.71875 14.8438 6.36897 14.8438 5.9375C14.8438 5.50603 14.494 5.15625 14.0625 5.15625C13.631 5.15625 13.2812 5.50603 13.2812 5.9375C13.2812 6.36897 13.631 6.71875 14.0625 6.71875Z" fill="#1C1C1C"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_contact_ig">
                                            <rect width="20" height="20" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="bg-white radius-20 contact-page-form">
                    <p class="h3 mb-12 capitalize">Gửi thông tin cho chúng tôi</p>

                    <p class="text-body-style-2 mb-32">Điền nội dung bạn cần hỗ trợ, chúng tôi sẽ liên hệ lại trong thời gian sớm nhất.</p>

                    <form action="#" method="post">
                        <div class="grid grid-cols-2 md-grid-cols-1 gap-x-20 gap-y-24 mb-22">
                            <div class="md-col-span-2 padding-0">
                                <p class="mb-8">Họ</p>
                                <input class="input-large" id="Firstname" name="Firstname" type="text" placeholder="Nhập họ của bạn" />
                            </div>
                            <div class="md-col-span-2 padding-0">
                                <p class="mb-8">Tên</p>
                                <input class="input-large" placeholder="Nhập tên của bạn" id="Lastname" name="Lastname" type="text" />
                            </div>
                            <div class="md-col-span-2 padding-0">
                                <p class="mb-8">Email</p>
                                <input class="input-large" name="SendInquiryemail" id="SendInquiryemail" type="email" placeholder="Nhập địa chỉ email" />
                            </div>
                            <div class="md-col-span-2 padding-0">
                                <p class="mb-8">Số điện thoại</p>
                                <input placeholder="Nhập số điện thoại" class="input-large" name="SendInquiryphone" id="SendInquiryphone" type="text" />
                            </div>

                            <div class="col-span-2 padding-0">
                                <p class="mb-8">Nội dung</p>
                                <textarea placeholder="Nội dung cần hỗ trợ" rows="3" name="message" class="message" id="message"></textarea>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-large font-weight-600 w-full" type="submit">
                            Gửi liên hệ
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
