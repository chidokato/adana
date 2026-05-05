<!doctype html>
<html lang="vi" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">
<head>
    <meta charset="utf-8" />
    <title>Đăng nhập Admin | Adana</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Trang đăng nhập khu vực quản trị Adana.">
    <meta name="author" content="Adana">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('admin-assets/images/favicon.ico') }}">
    <script src="{{ asset('admin-assets/js/layout.js') }}"></script>
    <link href="{{ asset('admin-assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .adana-brand {
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .adana-brand span {
            color: #0ab39c;
        }

        .auth-one-bg {
            background-image:
                linear-gradient(135deg, rgba(10, 179, 156, .92), rgba(64, 81, 137, .88)),
                url('{{ asset('admin-assets/images/auth-one-bg.jpg') }}');
            background-size: cover;
            background-position: center;
        }

        .feature-note {
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .18);
            border-radius: 1rem;
            padding: 1rem 1.25rem;
            color: rgba(255, 255, 255, .92);
        }
    </style>
</head>
<body>
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>

        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-10 col-lg-11">
                        <div class="card overflow-hidden border-0 shadow-lg">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4 auth-one-bg h-100">
                                        <div class="bg-overlay opacity-50"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="mb-4">
                                                <a href="{{ url('/') }}" class="d-inline-block text-white text-decoration-none">
                                                    <h2 class="adana-brand mb-0 text-white fw-bold">Ada<span>na</span></h2>
                                                </a>
                                            </div>

                                            <div class="mt-auto text-white">
                                                <span class="badge bg-light-subtle text-success text-uppercase mb-3">Admin interface</span>
                                                <h1 class="display-6 fw-semibold text-white mb-3">Khu vực quản trị nội dung và cấu hình hệ thống</h1>
                                                <p class="fs-15 text-white text-opacity-75 mb-4">
                                                    Giao diện admin đã được chuyển sang phong cách của `nhadatvn.org`, đồng thời giữ nguyên
                                                    cơ chế đăng nhập email hoặc Google đã có sẵn trong `adana`.
                                                </p>

                                                <div class="feature-note mb-4">
                                                    <div class="d-flex align-items-start gap-3">
                                                        <i class="ri-shield-check-line fs-3"></i>
                                                        <div>
                                                            <h5 class="text-white mb-2">Truy cập có kiểm soát</h5>
                                                            <p class="mb-0">Chỉ tài khoản admin đã được kích hoạt mới có thể vào backend và thao tác dữ liệu.</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row text-center g-3">
                                                    <div class="col-4">
                                                        <h4 class="text-white mb-1">CRUD</h4>
                                                        <p class="mb-0 text-white text-opacity-75 small">Nội dung</p>
                                                    </div>
                                                    <div class="col-4">
                                                        <h4 class="text-white mb-1">SEO</h4>
                                                        <p class="mb-0 text-white text-opacity-75 small">Cấu hình</p>
                                                    </div>
                                                    <div class="col-4">
                                                        <h4 class="text-white mb-1">Media</h4>
                                                        <p class="mb-0 text-white text-opacity-75 small">Banner</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4">
                                        <div>
                                            <h5 class="text-primary">Đăng nhập quản trị</h5>
                                            <p class="text-muted">Nhập thông tin để vào trang admin của Adana.</p>
                                        </div>

                                        <div class="mt-4">
                                            <form action="{{ route('admin.login.submit') }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="admin@adana.vn">
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label" for="password-input">Mật khẩu</label>
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror" id="password-input" name="password" placeholder="Nhập mật khẩu">
                                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted shadow-none" type="button" id="password-addon">
                                                            <i class="ri-eye-fill align-middle"></i>
                                                        </button>
                                                    </div>
                                                    @error('password')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1" id="auth-remember-check" name="remember">
                                                    <label class="form-check-label" for="auth-remember-check">Ghi nhớ đăng nhập</label>
                                                </div>

                                                <div class="mt-4">
                                                    <button class="btn btn-success w-100" type="submit">Đăng nhập vào admin</button>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="mt-3">
                                            <a class="btn btn-light border w-100 d-inline-flex align-items-center justify-content-center gap-2" href="{{ route('admin.google.redirect') }}">
                                                <img src="https://img.icons8.com/color/48/000000/google-logo.png" alt="Google" width="22" height="22">
                                                <span>Đăng nhập bằng Google</span>
                                            </a>
                                        </div>

                                        <div class="mt-4">
                                            <div class="alert alert-info mb-0" role="alert">
                                                Chỉ các email quản trị đã tồn tại và đang hoạt động mới được vào hệ thống.
                                            </div>
                                        </div>

                                        <div class="mt-5 text-center">
                                            <p class="mb-0">Cần quay lại website? <a href="{{ url('/') }}" class="fw-semibold text-primary text-decoration-underline">Về trang chủ</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer border-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy; <script>document.write(new Date().getFullYear())</script> Adana Admin</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="{{ asset('admin-assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin-assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin-assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('admin-assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('admin-assets/js/plugins.js') }}"></script>
    <script>
        document.getElementById('password-addon')?.addEventListener('click', function () {
            const input = document.getElementById('password-input');
            const icon = this.querySelector('i');
            const showPassword = input.type === 'password';
            input.type = showPassword ? 'text' : 'password';
            icon.className = showPassword ? 'ri-eye-off-fill align-middle' : 'ri-eye-fill align-middle';
        });
    </script>

    @include('admin.alert')
</body>
</html>
