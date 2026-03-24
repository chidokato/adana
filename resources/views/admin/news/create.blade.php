@extends('admin.layout.main')

@section('content')
<form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
@csrf
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thêm tin tức</h1>
    <div>
        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Quay lại
        </a>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Tiêu đề bài viết</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                    <small class="text-muted d-block mt-1">Slug sẽ tự động tạo từ tiêu đề.</small>
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                        
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                

                <div class="form-group">
                    <label for="content">Nội dung</label>
                    <textarea class="form-control editor" id="content" name="content" rows="6">{{ old('content') }}</textarea>
                    @error('content')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label for="seo_title">Tiêu đề SEO</label>
                    <small class="text-muted d-block mb-2">Tiêu đề hiển thị trên Google, không bắt buộc trùng với tiêu đề bài viết.</small>
                    <input type="text" class="form-control" id="seo_title" name="seo_title" value="{{ old('seo_title') }}">
                    @error('seo_title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="seo_description">Mô tả SEO</label>
                    <small class="text-muted d-block mb-2">Mô tả ngắn cho công cụ tìm kiếm, không bắt buộc trùng với mô tả bài viết.</small>
                    <textarea class="form-control" id="seo_description" name="seo_description" rows="3">{{ old('seo_description') }}</textarea>
                    @error('seo_description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label for="category_id">Danh mục</label>
                    <select class="form-control" id="category_id" name="category_id">
                        <option value="">-- Chọn danh mục --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Hình ảnh thumb</label>
                    <div style="display: flex;">
                        <span class="file-upload">
                            <span class="file-upload-content" onclick="$('.file-upload-input').trigger('click')">
                                <img class="file-upload-image" src="{{ asset('data/no_image.jpg') }}" alt="thumb" />
                            </span>
                            <span class="image-upload-wrap">
                                <input name="thumbnail" class="file-upload-input" type="file" onchange="readURL(this);" accept="image/*" />
                            </span>
                        </span>
                    </div>
                    @error('thumbnail')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" {{ old('status', '1') == '1' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="status">Trạng thái: Bật</label>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

</form>
@endsection
