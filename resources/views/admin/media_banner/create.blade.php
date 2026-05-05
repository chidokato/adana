@extends('admin.layout.main')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thêm slider/banner</h1>
    <a href="{{ route('admin.media-banners.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left mr-1"></i> Quay lại
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.media-banners.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="type">Loại</label>
                    <select class="form-control" id="type" name="type">
                        <option value="slider">Slider</option>
                        <option value="banner">Banner</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="position">Vị trí</label>
                    <input type="number" class="form-control" id="position" name="position" value="0">
                </div>
                <div class="form-group col-md-4">
                    <label>Trạng thái</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" checked>
                        <label class="custom-control-label" for="status">Bật</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="title">Tiêu đề</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>

            <div class="form-group">
                <label for="link">Link</label>
                <input type="text" class="form-control" id="link" name="link" placeholder="/duong-dan">
            </div>

            <div class="form-group">
                <label>Ảnh</label>
                <div style="display: flex;">
                    <span class="file-upload">
                        <span class="file-upload-content" onclick="$('.file-upload-input-media').trigger('click')">
                            <img class="file-upload-image file-upload-image-media" src="{{ asset('data/no_image.jpg') }}" alt="media" />
                        </span>
                        <span class="image-upload-wrap">
                            <input name="image" class="file-upload-input file-upload-input-media" type="file" onchange="readMedia(this);" accept="image/*" />
                        </span>
                    </span>
                </div>
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary btn-admin-primary">Lưu</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    function readMedia(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.file-upload-image-media').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
