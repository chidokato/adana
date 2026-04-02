@extends('frontend.layout.main')

@section('content')
@php
    $aboutConfig = $homeConfigs->get('about');
    $companyName = $siteSetting->company_name ?? config('app.name', 'ADANA Group');
    $mainImage = !empty(optional($aboutConfig)->image) ? asset(optional($aboutConfig)->image) : asset('site/assets/images/pages/about-1.jpg');
    $subImage = asset('site/assets/images/pages/about-2.jpg');
    $phone = $siteSetting->hotline ?? '0936 361 248';
    $email = $siteSetting->email ?? 'contact@adanagroup.com';
    $shortIntro = $siteSetting->short_intro ?: 'ADANA Group cung cấp giải pháp trọn gói trong lĩnh vực HVAC, vật tư tiêu hao, hóa chất công nghiệp và gia công cơ khí theo yêu cầu.';
@endphp

<div class="about-page">
    <section class="background-light mb-32">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}">Trang chủ</a></li>
                <li><img src="{{ asset('site/assets/icons/right.svg') }}" alt="right"></li>
                <li><span>Giới thiệu</span></li>
            </ul>
        </div>
    </section>

    <section class="pb-100">
        <div class="container">
            <h2>Giới thiệu</h2>
            <div class="tf-spacing-style3"></div>

            <div class="row items-center">
                <div class="col-lg-6">
                    <div class="about-box">
                        <img class="main-img radius-16 wow fadeIn" data-wow-delay="0.1s" src="{{ $mainImage }}" alt="{{ $companyName }}">
                        <div class="sub-img wow fadeInUp" data-wow-delay="0.2s">
                            <img src="{{ $subImage }}" alt="{{ $companyName }}">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="about-content">
                        <h2 class="font-weight-600 mb-20">{{ $companyName }}</h2>
                        <p class="intro-lead mb-20">{{ $shortIntro }}</p>
                        <p class="intro-lead mb-28">
                            ADANA Group được thành lập từ mong muốn mang đến cho khách hàng một dịch vụ trọn gói hoàn thiện hơn, vượt lên trên sự thỏa mãn thông thường bằng tiêu chuẩn rõ ràng, chất lượng dịch vụ ổn định, sản phẩm phù hợp và hệ thống quản lý tiên tiến.
                        </p>

                        <ul class="flex flex-col gap-24 mb-32">
                            <li class="flex gap-12">
                                <img class="w-24 h-24" src="{{ asset('site/assets/icons/check.svg') }}" alt="check">
                                <p class="h5">Một đầu mối liên hệ cho nhiều hạng mục kỹ thuật, thiết bị và vật tư.</p>
                            </li>
                            <li class="flex gap-12">
                                <img class="w-24 h-24" src="{{ asset('site/assets/icons/check.svg') }}" alt="check">
                                <p class="h5">Kết hợp dịch vụ, sản xuất, cung ứng và hậu mãi trong cùng hệ sinh thái.</p>
                            </li>
                            <li class="flex gap-12">
                                <img class="w-24 h-24" src="{{ asset('site/assets/icons/check.svg') }}" alt="check">
                                <p class="h5">Đồng hành cùng nhà máy, tòa nhà và doanh nghiệp bằng giải pháp sát nhu cầu thực tế.</p>
                            </li>
                        </ul>

                        <div class="flex gap-28 items-center flex-wrap">
                            <a href="{{ route('frontend.contact') }}" class="btn btn-primary btn-large font-weight-600">
                                Liên hệ ngay
                            </a>

                            <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}" class="flex gap-16">
                                <img src="{{ asset('site/assets/icons/PhoneCall-3.svg') }}" alt="PhoneCall">
                                <div class="mt2">
                                    <span class="text-sm text-secondary">Tư vấn nhanh</span>
                                    <p class="h4">{{ $phone }}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-100">
        <div class="container">
            <div class="title-section mb-40">
                <h2>Lĩnh vực hoạt động</h2>
                <p class="section-copy mt-12">
                    Chúng tôi cung cấp các dịch vụ hỗn hợp và sản phẩm thiết bị cho doanh nghiệp công nghiệp, thương mại và công trình dân dụng với định hướng đồng bộ, hiệu quả và bền vững.
                </p>
            </div>

            <div class="service-grid">
                <div class="info-card wow fadeInUp" data-wow-delay="0.1s">
                    <h4>Dịch vụ HVAC và bảo trì kỹ thuật</h4>
                    <p>
                        Thiết kế, lắp đặt, di dời, bảo trì và bảo dưỡng hệ thống HVAC, chiller, AHU, FCU, boiler, cooling tower, quạt thông gió, đường ống, trạm điện và nhiều hệ thống kỹ thuật nhà xưởng, tòa nhà.
                    </p>
                </div>

                <div class="info-card wow fadeInUp" data-wow-delay="0.2s">
                    <h4>Vật tư tiêu hao cho sản xuất</h4>
                    <p>
                        Cung cấp vật tư tiêu hao phục vụ vận hành nhà máy trong các khu công nghiệp với định hướng hàng chính hãng, chất lượng cao và mức giá cạnh tranh.
                    </p>
                </div>

                <div class="info-card wow fadeInUp" data-wow-delay="0.3s">
                    <h4>Hóa chất C88</h4>
                    <p>
                        Sản xuất và phân phối hóa chất tẩy rửa cáu cặn cho chiller, boiler, đường ống, két nước và thiết bị trao đổi nhiệt. Dòng C88 được phát triển theo hướng an toàn, không ăn mòn kim loại và thân thiện hơn với môi trường.
                    </p>
                </div>

                <div class="info-card wow fadeInUp" data-wow-delay="0.4s">
                    <h4>Sản xuất và gia công theo yêu cầu</h4>
                    <p>
                        Sản xuất dàn trao đổi nhiệt, coil chiller, coil AHU, dàn nóng, dàn lạnh, bình ngưng, bình bay hơi; đồng thời thiết kế, chế tạo, gia công CNC và khuôn mẫu cơ khí theo bản vẽ hoặc nhu cầu thực tế.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-100 background-light">
        <div class="container">
            <div class="title-section mb-40">
                <h2>Dịch vụ trọn gói cho doanh nghiệp</h2>
                <p class="section-copy mt-12">
                    ADANA Group phát triển mô hình dịch vụ đa lĩnh vực để khách hàng có thể làm việc với một đầu mối duy nhất cho cơ sở của mình, từ khảo sát, triển khai, cung ứng đến bảo trì và hỗ trợ sau bán hàng.
                </p>
            </div>

            <div class="customer-grid mb-40">
                <div class="info-card wow fadeInUp" data-wow-delay="0.1s">
                    <h5>Khách hàng tiêu biểu</h5>
                    <p>
                        Khách sạn, nhà máy, xưởng sản xuất, đại sứ quán, ngân hàng, tổ chức tài chính, trung tâm thương mại, tòa nhà văn phòng, khu nhà ở, trường học, cơ sở y tế và các dự án xây dựng.
                    </p>
                </div>

                <div class="info-card wow fadeInUp" data-wow-delay="0.2s">
                    <h5>Cách chúng tôi làm việc</h5>
                    <p>
                        Tư vấn đúng nhu cầu, đề xuất đúng hạng mục, thi công đúng tiêu chuẩn và theo sát hiệu quả vận hành sau bàn giao. Đây là nền tảng giúp ADANA duy trì sự tin cậy với khách hàng trong nhiều lĩnh vực.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-4 gap-130 md-grid-cols-2 counter-spacing">
                <div class="box-couter-item outline-right wow fadeInUp" data-wow-delay="0.1s">
                    <div class="content">
                        <div class="box-couter counter">
                            <div class="number-content font-main-2">
                                <span class="count-number font-main-2" data-to="4" data-speed="1500" data-inviewport="yes">4</span>+
                            </div>
                        </div>
                        <p class="font-weight-500 text-muted h7 text-center">Nhóm giải pháp chủ lực</p>
                    </div>
                </div>

                <div class="box-couter-item outline-right wow fadeInUp" data-wow-delay="0.2s">
                    <div class="content">
                        <div class="box-couter counter">
                            <div class="number-content font-main-2">
                                <span class="count-number font-main-2" data-to="1" data-speed="1500" data-inviewport="yes">1</span>
                            </div>
                        </div>
                        <p class="font-weight-500 text-muted h7 text-center">Đầu mối liên hệ xuyên suốt</p>
                    </div>
                </div>

                <div class="box-couter-item outline-right wow fadeInUp" data-wow-delay="0.3s">
                    <div class="content">
                        <div class="box-couter counter">
                            <div class="number-content font-main-2">
                                <span class="count-number font-main-2" data-to="20" data-speed="1500" data-inviewport="yes">20</span>+
                            </div>
                        </div>
                        <p class="font-weight-500 text-muted h7 text-center">Quốc gia và vùng lãnh thổ biết đến ADANA</p>
                    </div>
                </div>

                <div class="box-couter-item wow fadeInUp" data-wow-delay="0.4s">
                    <div class="content">
                        <div class="box-couter counter">
                            <div class="number-content font-main-2">
                                <span class="count-number font-main-2" data-to="24" data-speed="1500" data-inviewport="yes">24</span>/7
                            </div>
                        </div>
                        <p class="font-weight-500 text-muted h7 text-center">Tinh thần hỗ trợ và phản hồi</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-100">
        <div class="container">
            <div class="value-grid">
                <div class="info-card wow fadeInUp" data-wow-delay="0.1s">
                    <h4>Chất lượng làm nền tảng</h4>
                    <p>
                        Chúng tôi theo đuổi chất lượng dịch vụ, sản phẩm và nguồn nhân lực đồng bộ để mỗi hạng mục triển khai đều có tiêu chuẩn rõ ràng và khả năng vận hành ổn định lâu dài.
                    </p>
                </div>

                <div class="info-card wow fadeInUp" data-wow-delay="0.2s">
                    <h4>Giải pháp thực tế</h4>
                    <p>
                        ADANA không chỉ cung cấp sản phẩm đơn lẻ mà còn xây dựng phương án phù hợp với từng mô hình vận hành, tối ưu chi phí, thời gian và hiệu quả sử dụng cho khách hàng.
                    </p>
                </div>

                <div class="info-card wow fadeInUp" data-wow-delay="0.3s">
                    <h4>Đồng hành dài hạn</h4>
                    <p>
                        Từ khảo sát, cung ứng, thi công đến bảo trì, chúng tôi ưu tiên mối quan hệ hợp tác bền vững để mang lại giá trị, sự ổn định và phồn vinh cho khách hàng và hoạt động kinh doanh của họ.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-100">
        <div class="container">
            <div class="row g-4 items-center">
                <div class="col-lg-8">
                    <div class="story-box wow fadeInUp" data-wow-delay="0.1s">
                        <h2 class="mb-20">Câu chuyện tên gọi ADANA</h2>
                        <p class="section-copy mb-16">
                            Theo truyền thuyết Hy Lạp - La Mã cổ đại, ADANA gắn với câu chuyện về sự hình thành một vùng đất thịnh vượng. Một truyền thuyết khác liên hệ tên gọi này với vị thần mưa Adad, biểu tượng cho sự màu mỡ, của cải và phồn vinh.
                        </p>
                        <p class="section-copy mb-0">
                            ADANA Group kế thừa tinh thần cốt lõi của câu chuyện đó với khát vọng mang lại giá trị thực, sự phát triển bền vững và nền tảng vững chắc cho khách hàng, đối tác và công việc kinh doanh của họ.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="contact-box wow fadeInUp" data-wow-delay="0.2s">
                        <h4 class="text-white mb-12">Kết nối với {{ $companyName }}</h4>
                        <p class="mb-20">
                            Nếu bạn cần một đơn vị có thể đồng hành từ dịch vụ kỹ thuật đến cung ứng thiết bị, vật tư và hóa chất chuyên dụng, chúng tôi sẵn sàng hỗ trợ.
                        </p>
                        <p class="mb-8"><strong>Hotline:</strong> {{ $phone }}</p>
                        <p class="mb-24"><strong>Email:</strong> {{ $email }}</p>
                        <a href="{{ route('frontend.contact') }}" class="btn btn-white btn-large font-weight-600">
                            Gửi yêu cầu ngay
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
