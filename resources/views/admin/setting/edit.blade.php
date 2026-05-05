@extends('admin.layout.main')

@section('title', 'Cau hinh website')
@section('page_title', 'Cau hinh website')
@section('breadcrumb', 'Cau hinh website')

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Cau hinh website',
        'heroSubtitle' => 'Cap nhat thong tin doanh nghiep, mang xa hoi va nhan dien thuong hieu.',
        'heroPrimaryForm' => 'setting-form',
        'heroPrimaryType' => 'submit',
        'heroPrimaryLabel' => 'Luu setting',
        'heroSecondaryRoute' => route('admin.dashboard'),
        'heroSecondaryLabel' => 'Quay lai',
    ])

    <form id="setting-form" action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Thong tin cong ty</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="company_name" class="form-label">Ten cong ty</label>
                            <input type="text" id="company_name" name="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{ old('company_name', $setting->company_name ?? '') }}">
                            @error('company_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $setting->email ?? '') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="hotline" class="form-label">Hotline</label>
                            <input type="text" id="hotline" name="hotline" class="form-control @error('hotline') is-invalid @enderror" value="{{ old('hotline', $setting->hotline ?? '') }}">
                            @error('hotline')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="address" class="form-label">Dia chi</label>
                            <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $setting->address ?? '') }}">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-0">
                            <label for="short_intro" class="form-label">Gioi thieu ngan</label>
                            <textarea id="short_intro" name="short_intro" rows="4" class="form-control @error('short_intro') is-invalid @enderror">{{ old('short_intro', $setting->short_intro ?? '') }}</textarea>
                            @error('short_intro')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Mang xa hoi</h4>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-lg-4">
                        <label for="facebook" class="form-label">Facebook</label>
                        <input type="url" id="facebook" name="facebook" class="form-control @error('facebook') is-invalid @enderror" value="{{ old('facebook', $setting->facebook ?? '') }}" placeholder="https://facebook.com/...">
                        @error('facebook')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <label for="youtube" class="form-label">YouTube</label>
                        <input type="url" id="youtube" name="youtube" class="form-control @error('youtube') is-invalid @enderror" value="{{ old('youtube', $setting->youtube ?? '') }}" placeholder="https://youtube.com/...">
                        @error('youtube')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <label for="zalo" class="form-label">Zalo</label>
                        <input type="text" id="zalo" name="zalo" class="form-control @error('zalo') is-invalid @enderror" value="{{ old('zalo', $setting->zalo ?? '') }}">
                        @error('zalo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <label for="tiktok" class="form-label">TikTok</label>
                        <input type="url" id="tiktok" name="tiktok" class="form-control @error('tiktok') is-invalid @enderror" value="{{ old('tiktok', $setting->tiktok ?? '') }}" placeholder="https://tiktok.com/...">
                        @error('tiktok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <label for="instagram" class="form-label">Instagram</label>
                        <input type="url" id="instagram" name="instagram" class="form-control @error('instagram') is-invalid @enderror" value="{{ old('instagram', $setting->instagram ?? '') }}" placeholder="https://instagram.com/...">
                        @error('instagram')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <label for="twitter" class="form-label">Twitter/X</label>
                        <input type="url" id="twitter" name="twitter" class="form-control @error('twitter') is-invalid @enderror" value="{{ old('twitter', $setting->twitter ?? '') }}" placeholder="https://x.com/...">
                        @error('twitter')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <label for="linkedin" class="form-label">LinkedIn</label>
                        <input type="url" id="linkedin" name="linkedin" class="form-control @error('linkedin') is-invalid @enderror" value="{{ old('linkedin', $setting->linkedin ?? '') }}" placeholder="https://linkedin.com/...">
                        @error('linkedin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Hinh anh thuong hieu</h4>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    @include('admin.setting.partials.image-field', [
                        'title' => 'Logo',
                        'field' => 'logo',
                        'image' => $setting->logo ?? null,
                    ])

                    @include('admin.setting.partials.image-field', [
                        'title' => 'Logo footer',
                        'field' => 'footer_logo',
                        'image' => $setting->footer_logo ?? null,
                    ])

                    @include('admin.setting.partials.image-field', [
                        'title' => 'Favicon',
                        'field' => 'favicon',
                        'image' => $setting->favicon ?? null,
                    ])
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-input-trigger]').forEach(function (trigger) {
            trigger.addEventListener('click', function () {
                var inputId = trigger.getAttribute('data-input-trigger');
                document.getElementById(inputId)?.click();
            });
        });

        document.querySelectorAll('.setting-image-input').forEach(function (input) {
            var preview = document.getElementById(input.dataset.previewTarget);
            var placeholder = document.getElementById(input.dataset.placeholderTarget);
            var dropzone = document.querySelector('[data-input-trigger="' + input.id + '"]');

            input.addEventListener('change', function () {
                if (!input.files || !input.files[0]) {
                    return;
                }
                renderPreview(input.files[0], preview, placeholder);
            });

            if (dropzone) {
                dropzone.addEventListener('dragover', function (event) {
                    event.preventDefault();
                });

                dropzone.addEventListener('drop', function (event) {
                    event.preventDefault();
                    if (!event.dataTransfer.files.length) {
                        return;
                    }
                    input.files = event.dataTransfer.files;
                    renderPreview(event.dataTransfer.files[0], preview, placeholder);
                });
            }
        });

        function renderPreview(file, preview, placeholder) {
            if (!file || !file.type.startsWith('image/')) {
                return;
            }

            var reader = new FileReader();
            reader.onload = function (event) {
                preview.src = event.target.result;
                preview.classList.remove('d-none');
                placeholder.classList.add('d-none');
            };
            reader.readAsDataURL(file);
        }
    });
</script>

<style>
    .setting-image-dropzone {
        min-height: 220px;
        transition: .2s ease;
    }

    .setting-image-dropzone:hover {
        border-color: rgba(64, 81, 137, .35) !important;
        background: #f8fafc !important;
    }
</style>
@endsection
