<!doctype html>
<html lang="vi" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">
<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Admin') | Adana</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Trang quản trị Adana">
    <meta name="author" content="Adana">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('admin-assets/images/favicon.ico') }}">
    <script src="{{ asset('admin-assets/js/layout.js') }}"></script>
    <link href="{{ asset('admin-assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css/backend-admin.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_asset/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_asset/zoom/zoom.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        .btn-admin-primary {
            min-height: calc(1.5em + .75rem + 2px);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .35rem;
        }

        .admin-logo-text {
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .admin-logo-text span {
            color: #0ab39c;
        }

        .admin-hero-panel {
            background: linear-gradient(135deg, #405189, #0ab39c);
            color: #fff;
        }

        .admin-shortcut-card {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.1rem;
            border: 1px solid var(--vz-border-color);
            border-radius: 1rem;
            color: inherit;
            text-decoration: none;
            transition: .2s ease;
        }

        .admin-shortcut-card:hover {
            transform: translateY(-2px);
            border-color: rgba(10, 179, 156, .35);
            box-shadow: 0 12px 30px rgba(64, 81, 137, .08);
            color: inherit;
        }

        .admin-shortcut-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(10, 179, 156, .12);
            color: #0ab39c;
            font-size: 1.25rem;
        }

        .admin-shortcut-text {
            flex: 1;
            font-weight: 600;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -.75rem;
            margin-left: -.75rem;
        }

        .form-row > .col,
        .form-row > [class*="col-"] {
            padding-right: .75rem;
            padding-left: .75rem;
        }

        .text-gray-800 {
            color: #495057 !important;
        }

        .font-weight-bold {
            font-weight: 700 !important;
        }

        .custom-control {
            position: relative;
            min-height: 1.5rem;
            padding-left: 3rem;
        }

        .custom-control-input {
            position: absolute;
            left: 0;
            z-index: -1;
            opacity: 0;
        }

        .custom-control-label {
            margin-bottom: 0;
            cursor: pointer;
        }

        .ck.ck-editor__editable_inline {
            height: 520px;
            max-height: 520px;
            overflow-y: auto;
        }

        .custom-control-label::before {
            position: absolute;
            top: .15rem;
            left: 0;
            display: block;
            width: 2.5rem;
            height: 1.35rem;
            content: "";
            background-color: #d6dae1;
            border-radius: 2rem;
            transition: .2s ease;
        }

        .custom-control-label::after {
            position: absolute;
            top: .3rem;
            left: .2rem;
            width: 1.05rem;
            height: 1.05rem;
            content: "";
            background: #fff;
            border-radius: 50%;
            box-shadow: 0 2px 6px rgba(15, 23, 42, .15);
            transition: .2s ease;
        }

        .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #0ab39c;
        }

        .custom-control-input:checked ~ .custom-control-label::after {
            transform: translateX(1.15rem);
        }

        .mr-1 {
            margin-right: .25rem !important;
        }
    </style>
    @yield('css')
    @stack('styles')
</head>
<body>
    @php($adminUser = Auth::guard('admin')->user())

    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="{{ route('admin.dashboard') }}" class="logo logo-dark text-decoration-none">
                                <span class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('admin-assets/images/logo-sm.png') }}" alt="Adana" height="28">
                                    <span class="admin-logo-text text-dark">Ada<span>na</span></span>
                                </span>
                            </a>
                            <a href="{{ route('admin.dashboard') }}" class="logo logo-light text-decoration-none">
                                <span class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('admin-assets/images/logo-sm.png') }}" alt="Adana" height="28">
                                    <span class="admin-logo-text text-white">Ada<span>na</span></span>
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger material-shadow-none" id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user" src="{{ $adminUser && $adminUser->avatar ? $adminUser->avatar : asset('admin-assets/images/users/avatar-1.jpg') }}" alt="Avatar">
                                    <span class="text-start ms-xl-2">
                                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ $adminUser->name ?? 'Admin' }}</span>
                                        <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">{{ $adminUser->role_label ?? 'Administrator' }}</span>
                                    </span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <h6 class="dropdown-header">Xin chào {{ $adminUser->name ?? 'Admin' }}!</h6>
                                @if ($adminUser && $adminUser->isAdmin())
                                    <a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                        <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                                        <span class="align-middle">Người dùng quản trị</span>
                                    </a>
                                @endif
                                <a class="dropdown-item" href="{{ route('admin.settings.edit') }}">
                                    <i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i>
                                    <span class="align-middle">Cấu hình website</span>
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                                    <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                    <span class="align-middle">Đăng xuất</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="app-menu navbar-menu">
            <div class="navbar-brand-box">
                <a href="{{ route('admin.dashboard') }}" class="logo logo-dark text-decoration-none">
                    <span class="d-flex align-items-center gap-2">
                        <img src="{{ asset('admin-assets/images/logo-sm.png') }}" alt="Adana" height="28">
                        <span class="admin-logo-text text-dark">Ada<span>na</span></span>
                    </span>
                </a>
                <a href="{{ route('admin.dashboard') }}" class="logo logo-light text-decoration-none">
                    <span class="d-flex align-items-center gap-2">
                        <img src="{{ asset('admin-assets/images/logo-sm.png') }}" alt="Adana" height="28">
                        <span class="admin-logo-text text-white">Ada<span>na</span></span>
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">
                    <div id="two-column-menu"></div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span>Quản trị</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="ri-dashboard-line"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                                <i class="ri-list-check-2"></i>
                                <span>Danh mục</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                                <i class="ri-shopping-bag-3-line"></i>
                                <span>Sản phẩm</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}" href="{{ route('admin.news.index') }}">
                                <i class="ri-newspaper-line"></i>
                                <span>Tin tức</span>
                            </a>
                        </li>

                        @if ($adminUser && $adminUser->isAdmin())
                            <li class="menu-title mt-3"><span>Hệ thống</span></li>
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ request()->routeIs('admin.menus.*') ? 'active' : '' }}" href="{{ route('admin.menus.index') }}">
                                    <i class="ri-menu-line"></i>
                                    <span>Menu</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ request()->routeIs('admin.home-configs.*') ? 'active' : '' }}" href="{{ route('admin.home-configs.index') }}">
                                    <i class="ri-layout-grid-line"></i>
                                    <span>Cấu hình trang chủ</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ request()->routeIs('admin.media-banners.*') ? 'active' : '' }}" href="{{ route('admin.media-banners.index') }}">
                                    <i class="ri-image-2-line"></i>
                                    <span>Slider & banner</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ request()->routeIs('admin.seo.*') ? 'active' : '' }}" href="{{ route('admin.seo.index') }}">
                                    <i class="ri-line-chart-line"></i>
                                    <span>SEO</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.edit') }}">
                                    <i class="ri-settings-3-line"></i>
                                    <span>Cấu hình website</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                                    <i class="ri-user-3-line"></i>
                                    <span>Phân quyền</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="sidebar-background"></div>
        </div>

        <div class="vertical-overlay"></div>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">@yield('page_title', 'Trang quản trị')</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                                        <li class="breadcrumb-item active">@yield('breadcrumb', 'Dashboard')</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    @yield('content')
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">{{ now()->year }} © Adana.</div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">Admin UI based on nhadatvn.org</div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('admin-assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin-assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin-assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('admin-assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('admin-assets/js/app.js') }}"></script>
    <script src="{{ asset('admin_asset/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin_asset/select2/js/select2-searchInputPlaceholder.js') }}"></script>
    <script src="{{ asset('admin_asset/zoom/zoom.js') }}"></script>
    <script src="{{ asset('admin_asset/js/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>
    <script src="{{ asset('admin_asset/js/customc-keditor.js') }}"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <script src="{{ asset('admin_asset/js/validate.js') }}"></script>
    <script>
        const uploadUrl = "{{ route('admin.upload') }}?_token={{ csrf_token() }}";

        document.addEventListener('DOMContentLoaded', function () {
            if (typeof initEditor === 'function') {
                initEditor();
            }

            if (window.jQuery) {
                $('.select2').select2({ searchInputPlaceholder: 'Nhập từ khóa' });

                $('input[name="datefilter"]').daterangepicker({
                    autoUpdateInput: false,
                    locale: {
                        cancelLabel: 'Clear'
                    }
                });

                $('input[name="datefilter"]').on('apply.daterangepicker', function (ev, picker) {
                    $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
                });

                $('input[name="datefilter"]').on('cancel.daterangepicker', function () {
                    $(this).val('');
                });
            }
        });
    </script>

    @include('admin.alert')
    @yield('js')
    @stack('scripts')
</body>
</html>
