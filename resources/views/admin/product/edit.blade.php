@extends('admin.layout.main')

@section('content')
<form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Sửa sản phẩm</h1>
    <div>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Quay lại
        </a>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Tiêu đề sản phẩm</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $product->title) }}" required>
                    <small class="text-muted d-block mt-1">Slug tự động theo tiêu đề.</small>
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $product->slug) }}">
                    <small class="text-muted d-block mt-1">Có thể chỉnh tay slug nếu cần.</small>
                    @error('slug')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="product_code">Mã sản phẩm</label>
                        <input type="text" class="form-control" id="product_code" name="product_code" value="{{ old('product_code', $product->product_code) }}">
                        @error('product_code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="price">Giá bán</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}">
                        @error('price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                        
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content">Nội dung</label>
                    <textarea class="form-control editor" id="content" name="content" rows="6">{{ old('content', $product->content) }}</textarea>
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
                    <small class="text-muted d-block mb-2">Tiêu đề hiển thị trên Google, không bắt buộc trùng với tiêu đề sản phẩm.</small>
                    <input type="text" class="form-control" id="seo_title" name="seo_title" value="{{ old('seo_title', $product->seo_title) }}">
                    @error('seo_title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="seo_description">Mô tả SEO</label>
                    <small class="text-muted d-block mb-2">Mô tả ngắn cho công cụ tìm kiếm, không bắt buộc trùng với mô tả sản phẩm.</small>
                    <textarea class="form-control" id="seo_description" name="seo_description" rows="3">{{ old('seo_description', $product->seo_description) }}</textarea>
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
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Ảnh đại diện</label>
                    <div style="display: flex;">
                        <span class="file-upload">
                            <span class="file-upload-content" onclick="$('.file-upload-input').trigger('click')">
                                <img class="file-upload-image" src="{{ $product->thumbnail ? asset($product->thumbnail) : asset('data/no_image.jpg') }}" alt="thumb" />
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
                    <label>Ảnh chi tiết (nhiều ảnh)</label>
                    <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
                    @error('images.*')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                @if($product->images->count())
                    <div class="form-group">
                        <label>Ảnh chi tiết</label>
                        <div class="mb-2">
                            @foreach($product->images as $image)
                                <div class="d-flex align-items-center mb-2">
                                    <img src="{{ asset($image->path) }}" alt="img" style="width: 60px; height: 40px; object-fit: cover;" class="mr-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="removeImage{{ $image->id }}" name="remove_images[]" value="{{ $image->id }}">
                                        <label class="custom-control-label" for="removeImage{{ $image->id }}">Xóa ảnh</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" {{ old('status', (string)$product->status) == '1' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="status">Trạng thái: Bật</label>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

</form>
@endsection

