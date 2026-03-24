@extends('admin.layout.main')

@section('content')
<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cấu hình website</h1>
    <div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </div>
</div>

@include('admin.alert')

<div class="row">
    <div class="col-md-5">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label for="company_name">Tên công ty</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', $setting->company_name ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="short_intro">Giới thiệu ngắn</label>
                    <textarea class="form-control" id="short_intro" name="short_intro" rows="3">{{ old('short_intro', $setting->short_intro ?? '') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $setting->address ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="hotline">Hotline</label>
                    <input type="text" class="form-control" id="hotline" name="hotline" value="{{ old('hotline', $setting->hotline ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="zalo">Zalo</label>
                    <input type="text" class="form-control" id="zalo" name="zalo" value="{{ old('zalo', $setting->zalo ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $setting->email ?? '') }}">
                </div>
               
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" id="facebook" name="facebook" value="{{ old('facebook', $setting->facebook ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="youtube">YouTube</label>
                    <input type="text" class="form-control" id="youtube" name="youtube" value="{{ old('youtube', $setting->youtube ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="tiktok">TikTok</label>
                    <input type="text" class="form-control" id="tiktok" name="tiktok" value="{{ old('tiktok', $setting->tiktok ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" id="instagram" name="instagram" value="{{ old('instagram', $setting->instagram ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="twitter">Twitter/X</label>
                    <input type="text" class="form-control" id="twitter" name="twitter" value="{{ old('twitter', $setting->twitter ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="linkedin">LinkedIn</label>
                    <input type="text" class="form-control" id="linkedin" name="linkedin" value="{{ old('linkedin', $setting->linkedin ?? '') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label>Logo</label>
                    <div style="display: flex;">
                        <span class="file-upload">
                            <span class="file-upload-content" onclick="$('.file-upload-input-logo').trigger('click')">
                                <img class="file-upload-image file-upload-image-logo" src="{{ !empty($setting->logo) ? asset($setting->logo) : asset('data/no_image.jpg') }}" alt="logo" />
                            </span>
                            <span class="image-upload-wrap">
                                <input name="logo" class="file-upload-input file-upload-input-logo" type="file" onchange="readLogo(this);" accept="image/*" />
                            </span>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label>Favicon</label>
                    <div style="display: flex;">
                        <span class="file-upload">
                            <span class="file-upload-content" onclick="$('.file-upload-input-favicon').trigger('click')">
                                <img style="height: 50px;" class="file-upload-image file-upload-image-favicon" src="{{ !empty($setting->favicon) ? asset($setting->favicon) : asset('data/no_image.jpg') }}" alt="favicon" />
                            </span>
                            <span class="image-upload-wrap">
                                <input name="favicon" class="file-upload-input file-upload-input-favicon" type="file" onchange="readFavicon(this);" accept="image/*" />
                            </span>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label>Logo Footer</label>
                    <div style="display: flex;">
                        <span class="file-upload">
                            <span class="file-upload-content" onclick="$('.file-upload-input-footer-logo').trigger('click')">
                                <img class="file-upload-image file-upload-image-footer-logo" src="{{ !empty($setting->footer_logo) ? asset($setting->footer_logo) : asset('data/no_image.jpg') }}" alt="footer-logo" />
                            </span>
                            <span class="image-upload-wrap">
                                <input name="footer_logo" class="file-upload-input file-upload-input-footer-logo" type="file" onchange="readFooterLogo(this);" accept="image/*" />
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection

@section('js')
<script>
    function readLogo(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.file-upload-image-logo').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function readFavicon(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.file-upload-image-favicon').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function readFooterLogo(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.file-upload-image-footer-logo').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
