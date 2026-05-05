@php($news = $news ?? null)
@php($thumbnailPreview = !empty($news->thumbnail) ? asset($news->thumbnail) : null)

<div class="row">
    <div class="col-xl-9">
        <div class="card border">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu đề</label>
                            <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $news->title ?? '') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" id="slug" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $news->slug ?? '') }}">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả ngắn</label>
                            <textarea id="description" name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $news->description ?? '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-0">
                            <label for="content" class="form-label">Nội dung</label>
                            <textarea id="content" name="content" rows="8" class="form-control editor @error('content') is-invalid @enderror">{{ old('content', $news->content ?? '') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border">
            <div class="card-header">
                <h5 class="card-title mb-0">Cấu hình SEO</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="seo_title" class="form-label">Title</label>
                    <input type="text" id="seo_title" name="seo_title" class="form-control @error('seo_title') is-invalid @enderror" value="{{ old('seo_title', $news->seo_title ?? '') }}">
                    @error('seo_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-0">
                    <label for="seo_description" class="form-label">Description</label>
                    <textarea id="seo_description" name="seo_description" rows="3" class="form-control @error('seo_description') is-invalid @enderror">{{ old('seo_description', $news->seo_description ?? '') }}</textarea>
                    @error('seo_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3">
        <div class="card border">
            <div class="card-body">
                <div class="mb-3">
                    <label for="category_id" class="form-label">Danh mục</label>
                    <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                        <option value="">Không chọn</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ (string) old('category_id', $news->category_id ?? '') === (string) $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="card border mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Hình ảnh</h5>
                    </div>
                    <div class="card-body">
                        <label class="form-label">Ảnh đại diện</label>
                        <input type="file" id="news-thumbnail-input" name="thumbnail" class="d-none @error('thumbnail') is-invalid @enderror" accept="image/*">
                        <button type="button" id="news-thumbnail-dropzone" class="border rounded bg-light d-flex align-items-center justify-content-center overflow-hidden p-0 w-100 news-image-dropzone">
                            <img id="news-thumbnail-preview" src="{{ $thumbnailPreview }}" alt="Thumbnail" class="w-100 h-100 object-fit-cover {{ $thumbnailPreview ? '' : 'd-none' }}">
                            <div id="news-thumbnail-placeholder" class="text-center text-muted px-3 {{ $thumbnailPreview ? 'd-none' : '' }}">
                                <div class="display-6 mb-2"><i class="ri-image-line"></i></div>
                                <div class="fw-semibold">NO IMAGE</div>
                                <div>Click hoặc drop ảnh vào đây</div>
                            </div>
                        </button>
                        @error('thumbnail')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="custom-control custom-switch">
                    <input class="custom-control-input" type="checkbox" id="status" name="status" value="1" {{ old('status', $news->status ?? 1) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="status">Hiển thị tin tức</label>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .news-image-dropzone {
        min-height: 205px;
        transition: .2s ease;
    }

    .news-image-dropzone:hover {
        border-color: rgba(64, 81, 137, .35) !important;
        background: #f8fafc !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const thumbnailInput = document.getElementById('news-thumbnail-input');
        const thumbnailDropzone = document.getElementById('news-thumbnail-dropzone');
        const thumbnailPreview = document.getElementById('news-thumbnail-preview');
        const thumbnailPlaceholder = document.getElementById('news-thumbnail-placeholder');

        if (!thumbnailInput || !thumbnailDropzone) {
            return;
        }

        thumbnailDropzone.addEventListener('click', function () {
            thumbnailInput.click();
        });

        thumbnailDropzone.addEventListener('dragover', function (event) {
            event.preventDefault();
        });

        thumbnailDropzone.addEventListener('drop', function (event) {
            event.preventDefault();
            if (!event.dataTransfer.files.length) {
                return;
            }
            thumbnailInput.files = event.dataTransfer.files;
            renderThumbnailPreview(event.dataTransfer.files[0]);
        });

        thumbnailInput.addEventListener('change', function () {
            if (!thumbnailInput.files.length) {
                return;
            }
            renderThumbnailPreview(thumbnailInput.files[0]);
        });

        function renderThumbnailPreview(file) {
            if (!file || !file.type.startsWith('image/')) {
                return;
            }

            const reader = new FileReader();
            reader.onload = function (event) {
                thumbnailPreview.src = event.target.result;
                thumbnailPreview.classList.remove('d-none');
                thumbnailPlaceholder.classList.add('d-none');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
