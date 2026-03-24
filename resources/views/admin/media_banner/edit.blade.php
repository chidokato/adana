@extends('admin.layout.main')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Sửa slider/banner</h1>
    <a href="{{ route('admin.media-banners.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left mr-1"></i> Quay lại
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.media-banners.update', $item) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="type">Loại</label>
                    <select class="form-control" id="type" name="type">
                        <option value="slider" {{ $item->type === 'slider' ? 'selected' : '' }}>Slider</option>
                        <option value="banner" {{ $item->type === 'banner' ? 'selected' : '' }}>Banner</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="position">Vị trí</label>
                    <input type="number" class="form-control" id="position" name="position" value="{{ $item->position }}">
                </div>
                <div class="form-group col-md-4">
                    <label>Trạng thái</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" {{ $item->status ? 'checked' : '' }}>
                        <label class="custom-control-label" for="status">Bật</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="title">Tiêu đề</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $item->title }}">
            </div>

            <div class="form-group">
                <label for="link">Link</label>
                <input type="text" class="form-control" id="link" name="link" value="{{ $item->link }}">
            </div>

            <div class="form-group">
                <label>Ảnh</label>
                <div style="display: flex;">
                    <span class="file-upload">
                        <span class="file-upload-content" onclick="$('.file-upload-input-media').trigger('click')">
                            <img class="file-upload-image file-upload-image-media" src="{{ $item->image ? asset($item->image) : asset('data/no_image.jpg') }}" alt="media" />
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
                <button type="submit" class="btn btn-primary">Cập nhật</button>
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

