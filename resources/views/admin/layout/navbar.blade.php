@php($adminUser = Auth::guard('admin')->user())

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.categories.index') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>Danh mục</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.products.index') }}">
            <i class="fas fa-fw fa-box"></i>
            <span>Sản phẩm</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.news.index') }}">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Tin tức</span>
        </a>
    </li>

    @if($adminUser && $adminUser->isAdmin())
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#setting"
               aria-expanded="true" aria-controls="setting">
                <i class="fas fa-fw fa-cog"></i>
                <span>Cài đặt</span>
            </a>
            <div id="setting" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('admin.menus.index') }}">Menu</a>
                    <a class="collapse-item" href="{{ route('admin.settings.edit') }}">Cấu hình website</a>
                    <a class="collapse-item" href="{{ route('admin.home-configs.index') }}">Cấu hình trang chủ</a>
                    <a class="collapse-item" href="{{ route('admin.seo.index') }}">SEO</a>
                    <a class="collapse-item" href="{{ route('admin.media-banners.index') }}">Slider & Banner</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="fas fa-fw fa-user-shield"></i>
                <span>Phân quyền</span>
            </a>
        </li>
    @endif

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
