@extends('frontend.layout.main')

@section('content')
@php
    $companyName = $siteSetting->company_name ?? config('app.name', 'ADANA');
    $intro = $siteSetting->short_intro ?? 'Chúng tôi luôn sẵn sàng tư vấn để giúp bạn chọn đúng sản phẩm và giải pháp phù hợp.';
@endphp

<section class="page-shell">
    <div class="container">
        <div class="page-hero-box">
            <span class="page-kicker">Trang nội dung</span>
            <h1>{{ $pageLabel }}</h1>
            <p>Trang này đã được tạo để liên kết menu hoạt động đầy đủ. Bạn có thể dùng nó như một landing page riêng cho nhóm nội dung <strong>{{ $pageLabel }}</strong> hoặc cập nhật thêm nội dung chi tiết từ phần quản trị sau.</p>
        </div>

        <div class="page-grid">
            <div class="page-card">
                <h2>{{ $pageLabel }} tại {{ $companyName }}</h2>
                <p>{{ $intro }}</p>
                <p>Hiện tại đây là trang mặc định dành cho đường dẫn <strong>/{{ $pageSlug }}</strong>. Nếu bạn muốn, mình có thể tiếp tục biến trang này thành một trang chuyên biệt với bố cục, nội dung và khối dữ liệu riêng theo đúng mục đích kinh doanh của bạn.</p>

                <div class="page-cta">
                    <a href="{{ route('frontend.contact') }}" class="btn btn-primary">Liên hệ tư vấn</a>
                    <a href="{{ route('frontend.products') }}" class="btn btn-line">Xem sản phẩm</a>
                </div>
            </div>

            <div class="page-card">
                <h3>Bạn có thể phát triển tiếp trang này thành</h3>
                <ul>
                    <li>Trang danh mục hoặc dòng sản phẩm chuyên biệt.</li>
                    <li>Trang giới thiệu dịch vụ, năng lực hoặc dự án tiêu biểu.</li>
                    <li>Trang landing page cho chiến dịch marketing hoặc SEO.</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
