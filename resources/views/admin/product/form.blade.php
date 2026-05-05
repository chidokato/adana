@php($product = $product ?? null)
@php($thumbnailPreview = !empty($product->thumbnail) ? asset($product->thumbnail) : null)
<div class="row">
    <div class="col-xl-9">
        <div class="card border">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu đề</label>
                            <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $product->title ?? '') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" id="slug" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $product->slug ?? '') }}">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="product_code" class="form-label">Mã sản phẩm</label>
                            <input type="text" id="product_code" name="product_code" class="form-control @error('product_code') is-invalid @enderror" value="{{ old('product_code', $product->product_code ?? '') }}">
                            @error('product_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="price" class="form-label">Giá bán</label>
                            <input type="number" step="0.01" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price ?? '') }}">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả ngắn</label>
                            <textarea id="description" name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description ?? '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-0">
                            <label for="content" class="form-label">Nội dung</label>
                            <textarea id="content" name="content" rows="8" class="form-control editor @error('content') is-invalid @enderror">{{ old('content', $product->content ?? '') }}</textarea>
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
                    <input type="text" id="seo_title" name="seo_title" class="form-control @error('seo_title') is-invalid @enderror" value="{{ old('seo_title', $product->seo_title ?? '') }}">
                    @error('seo_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-0">
                    <label for="seo_description" class="form-label">Description</label>
                    <textarea id="seo_description" name="seo_description" rows="3" class="form-control @error('seo_description') is-invalid @enderror">{{ old('seo_description', $product->seo_description ?? '') }}</textarea>
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
                            <option value="{{ $cat->id }}" {{ (string) old('category_id', $product->category_id ?? '') === (string) $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
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
                        <div class="mb-3">
                            <label class="form-label">Ảnh đại diện</label>
                            <input type="file" id="thumbnail-input" name="thumbnail" class="d-none @error('thumbnail') is-invalid @enderror" accept="image/*">
                            <button type="button" id="thumbnail-dropzone" class="border rounded bg-light d-flex align-items-center justify-content-center overflow-hidden p-0 w-100 product-image-dropzone">
                                <img id="thumbnail-preview" src="{{ $thumbnailPreview }}" alt="Thumbnail" class="w-100 h-100 object-fit-cover {{ $thumbnailPreview ? '' : 'd-none' }}">
                                <div id="thumbnail-placeholder" class="text-center text-muted px-3 {{ $thumbnailPreview ? 'd-none' : '' }}">
                                    <div class="display-6 mb-2"><i class="ri-image-line"></i></div>
                                    <div class="fw-semibold">NO IMAGE</div>
                                    <div>Click hoặc drop ảnh vào đây</div>
                                </div>
                            </button>
                            @error('thumbnail')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-0">
                            <label class="form-label">Ảnh chi tiết</label>
                            <input type="file" id="gallery-input" name="images[]" class="d-none @error('images.*') is-invalid @enderror" accept="image/*" multiple>
                            <div class="border rounded p-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-semibold">Thêm ảnh chi tiết</div>
                                    <button type="button" id="gallery-picker-trigger" class="btn btn-light border rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 product-gallery-picker-button">
                                        <i class="ri-add-line product-gallery-picker-icon"></i>
                                    </button>
                                </div>
                                <div id="gallery-preview-grid" class="d-flex align-items-start gap-2 flex-wrap mt-3">
                                    @if (!empty($product) && $product->relationLoaded('images') && $product->images->count())
                                        @foreach ($product->images as $image)
                                            <label class="position-relative border rounded overflow-hidden bg-light product-gallery-item product-gallery-item-thumb mb-0">
                                                <img src="{{ asset($image->path) }}" alt="Gallery" class="w-100 h-100 object-fit-cover">
                                                <span class="position-absolute top-0 start-0 m-1 badge bg-dark bg-opacity-75">Đã có</span>
                                                <span class="position-absolute bottom-0 start-0 end-0 bg-white p-1 small d-flex align-items-center gap-1">
                                                    <input type="checkbox" name="remove_images[]" value="{{ $image->id }}">
                                                    <span>Xóa</span>
                                                </span>
                                            </label>
                                        @endforeach
                                    @endif
                                </div>
                                <div id="gallery-selection-note" class="form-text mt-2">Có thể chọn nhiều ảnh cùng lúc.</div>
                            </div>
                            @error('images.*')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="custom-control custom-switch">
                    <input class="custom-control-input" type="checkbox" id="status" name="status" value="1" {{ old('status', $product->status ?? 1) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="status">Hiển thị sản phẩm</label>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .product-image-dropzone {
        min-height: 205px;
        transition: .2s ease;
    }

    .product-image-dropzone:hover {
        border-color: rgba(64, 81, 137, .35) !important;
        background: #f8fafc !important;
    }

    .product-gallery-picker-button {
        width: 42px;
        height: 42px;
    }

    .product-gallery-picker-icon {
        font-size: 1.4rem;
        line-height: 1;
    }

    .product-gallery-item-thumb {
        width: 92px;
        height: 92px;
    }

    .product-gallery-remove-button {
        width: 22px;
        height: 22px;
        padding: 0;
        border: 0;
        border-radius: 999px;
        position: absolute;
        top: 4px;
        right: 4px;
        background: rgba(220, 53, 69, .95);
        color: #fff;
        font-size: 14px;
        line-height: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const thumbnailInput = document.getElementById('thumbnail-input');
        const thumbnailDropzone = document.getElementById('thumbnail-dropzone');
        const thumbnailPreview = document.getElementById('thumbnail-preview');
        const thumbnailPlaceholder = document.getElementById('thumbnail-placeholder');
        const galleryInput = document.getElementById('gallery-input');
        const galleryTrigger = document.getElementById('gallery-picker-trigger');
        const galleryGrid = document.getElementById('gallery-preview-grid');
        const gallerySelectionNote = document.getElementById('gallery-selection-note');
        let selectedGalleryFiles = [];

        if (thumbnailDropzone && thumbnailInput) {
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
        }

        if (galleryTrigger && galleryInput) {
            galleryTrigger.addEventListener('click', function () {
                galleryInput.click();
            });

            galleryInput.addEventListener('change', function () {
                const incomingFiles = Array.from(galleryInput.files || []);
                if (!incomingFiles.length) {
                    return;
                }

                selectedGalleryFiles = selectedGalleryFiles.concat(incomingFiles);
                syncGalleryInputFiles();
                renderGalleryPreviews(selectedGalleryFiles);
            });
        }

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

        function renderGalleryPreviews(files) {
            galleryGrid.querySelectorAll('[data-new-gallery-item]').forEach(function (item) {
                item.remove();
            });

            if (!files.length) {
                gallerySelectionNote.textContent = 'Có thể chọn nhiều ảnh cùng lúc.';
                return;
            }

            files.forEach(function (file, index) {
                if (!file.type.startsWith('image/')) {
                    return;
                }

                const reader = new FileReader();
                reader.onload = function (event) {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'position-relative border rounded overflow-hidden bg-light product-gallery-item product-gallery-item-thumb';
                    wrapper.setAttribute('data-new-gallery-item', '1');
                    wrapper.innerHTML =
                        '<img src="' + event.target.result + '" alt="New gallery" class="w-100 h-100 object-fit-cover">' +
                        '<button type="button" class="product-gallery-remove-button" data-remove-gallery-index="' + index + '">&times;</button>' +
                        '<span class="position-absolute bottom-0 start-0 end-0 bg-primary text-white text-center small py-1">Ảnh mới</span>';
                    galleryGrid.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });

            gallerySelectionNote.textContent = 'Đã chọn ' + files.length + ' ảnh mới.';
        }

        function syncGalleryInputFiles() {
            const dataTransfer = new DataTransfer();
            selectedGalleryFiles.forEach(function (file) {
                dataTransfer.items.add(file);
            });
            galleryInput.files = dataTransfer.files;
        }

        if (galleryGrid) {
            galleryGrid.addEventListener('click', function (event) {
                const removeButton = event.target.closest('[data-remove-gallery-index]');
                if (!removeButton) {
                    return;
                }

                const index = Number(removeButton.getAttribute('data-remove-gallery-index'));
                if (Number.isNaN(index)) {
                    return;
                }

                selectedGalleryFiles.splice(index, 1);
                syncGalleryInputFiles();
                renderGalleryPreviews(selectedGalleryFiles);
            });
        }
    });
</script>
