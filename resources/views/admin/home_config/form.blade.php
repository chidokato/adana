@php($item = $item ?? null)
@php($imagePreview = !empty($item->image) ? asset($item->image) : null)
@php($subImagePreview = !empty($item->sub_image) ? asset($item->sub_image) : null)

<div class="row">
    <div class="col-xl-8">
        <div class="card border">
            <div class="card-header">
                <h5 class="card-title mb-0">Nội dung section</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="mb-3">
                            <label for="section_key" class="form-label">Khóa section</label>
                            <input
                                type="text"
                                id="section_key"
                                name="section_key"
                                class="form-control @error('section_key') is-invalid @enderror"
                                value="{{ old('section_key', $item->section_key ?? '') }}"
                                placeholder="Ví dụ: intro_section"
                                required
                            >
                            @error('section_key')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu đề</label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $item->title ?? '') }}"
                                placeholder="Nhập tiêu đề section"
                            >
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả ngắn</label>
                            <textarea
                                id="description"
                                name="description"
                                rows="3"
                                class="form-control @error('description') is-invalid @enderror"
                                placeholder="Mô tả ngắn cho section"
                            >{{ old('description', $item->description ?? '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="content" class="form-label">Nội dung chi tiết</label>
                            <textarea
                                id="content"
                                name="content"
                                rows="8"
                                class="form-control editor @error('content') is-invalid @enderror"
                            >{{ old('content', $item->content ?? '') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-0">
                            <label for="note" class="form-label">Ghi chú</label>
                            <textarea
                                id="note"
                                name="note"
                                rows="4"
                                class="form-control @error('note') is-invalid @enderror"
                                placeholder="Thông tin nội bộ hoặc hướng dẫn sử dụng section"
                            >{{ old('note', $item->note ?? '') }}</textarea>
                            @error('note')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card border">
            <div class="card-header">
                <h5 class="card-title mb-0">Thông tin nhanh</h5>
            </div>
            <div class="card-body">
                <div class="border rounded-3 p-3 bg-light-subtle mb-3">
                    <div class="text-muted text-uppercase fs-12 fw-semibold mb-1">Khóa section</div>
                    <div class="fw-semibold">{{ old('section_key', $item->section_key ?? 'Chưa thiết lập') }}</div>
                </div>

                <div class="border rounded-3 p-3 bg-light-subtle">
                    <div class="text-muted text-uppercase fs-12 fw-semibold mb-1">Trạng thái hình ảnh</div>
                    <div class="fw-semibold">{{ !empty($item->image) ? 'Đã có ảnh chính' : 'Chưa có ảnh chính' }}</div>
                    <div class="text-muted small mt-1">{{ !empty($item->sub_image) ? 'Đã có ảnh phụ' : 'Chưa có ảnh phụ' }}</div>
                </div>
            </div>
        </div>

        <div class="card border">
            <div class="card-header">
                <h5 class="card-title mb-0">Hình ảnh</h5>
            </div>
            <div class="card-body">
                <div class="mb-0">
                    <label class="form-label">Ảnh section</label>
                    <input type="file" id="home-config-image-input" name="image" class="d-none @error('image') is-invalid @enderror" accept="image/*">
                    <button type="button" id="home-config-image-dropzone" class="border rounded bg-light d-flex align-items-center justify-content-center overflow-hidden p-0 w-100 home-config-image-dropzone">
                        <img id="home-config-image-preview" src="{{ $imagePreview }}" alt="Home config" class="w-100 h-100 object-fit-cover {{ $imagePreview ? '' : 'd-none' }}">
                        <div id="home-config-image-placeholder" class="text-center text-muted px-3 {{ $imagePreview ? 'd-none' : '' }}">
                            <div class="display-6 mb-2"><i class="ri-image-add-line"></i></div>
                            <div class="fw-semibold">CHƯA CÓ ẢNH</div>
                            <div>Nhấp hoặc kéo thả ảnh vào đây</div>
                        </div>
                    </button>
                    <div class="form-text mt-2">Hỗ trợ JPG, PNG, WEBP tối đa 4MB.</div>
                    @error('image')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card border">
            <div class="card-header">
                <h5 class="card-title mb-0">Hình ảnh phụ</h5>
            </div>
            <div class="card-body">
                <div class="mb-0">
                    <label class="form-label">Ảnh phụ section</label>
                    <input type="file" id="home-config-sub-image-input" name="sub_image" class="d-none @error('sub_image') is-invalid @enderror" accept="image/*">
                    <button type="button" id="home-config-sub-image-dropzone" class="border rounded bg-light d-flex align-items-center justify-content-center overflow-hidden p-0 w-100 home-config-image-dropzone">
                        <img id="home-config-sub-image-preview" src="{{ $subImagePreview }}" alt="Home config sub image" class="w-100 h-100 object-fit-cover {{ $subImagePreview ? '' : 'd-none' }}">
                        <div id="home-config-sub-image-placeholder" class="text-center text-muted px-3 {{ $subImagePreview ? 'd-none' : '' }}">
                            <div class="display-6 mb-2"><i class="ri-image-add-line"></i></div>
                            <div class="fw-semibold">CHƯA CÓ ẢNH PHỤ</div>
                            <div>Nhấp hoặc kéo thả ảnh phụ vào đây</div>
                        </div>
                    </button>
                    <div class="form-text mt-2">Dùng cho ảnh minh họa bổ sung của section.</div>
                    @error('sub_image')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .home-config-image-dropzone {
        min-height: 280px;
        transition: .2s ease;
    }

    .home-config-image-dropzone:hover {
        border-color: rgba(64, 81, 137, .35) !important;
        background: #f8fafc !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        setupImagePicker(
            'home-config-image-input',
            'home-config-image-dropzone',
            'home-config-image-preview',
            'home-config-image-placeholder'
        );

        setupImagePicker(
            'home-config-sub-image-input',
            'home-config-sub-image-dropzone',
            'home-config-sub-image-preview',
            'home-config-sub-image-placeholder'
        );

        function setupImagePicker(inputId, dropzoneId, previewId, placeholderId) {
            const imageInput = document.getElementById(inputId);
            const dropzone = document.getElementById(dropzoneId);
            const preview = document.getElementById(previewId);
            const placeholder = document.getElementById(placeholderId);

            if (!imageInput || !dropzone || !preview || !placeholder) {
                return;
            }

            dropzone.addEventListener('click', function () {
                imageInput.click();
            });

            dropzone.addEventListener('dragover', function (event) {
                event.preventDefault();
            });

            dropzone.addEventListener('drop', function (event) {
                event.preventDefault();
                if (!event.dataTransfer.files.length) {
                    return;
                }

                imageInput.files = event.dataTransfer.files;
                renderPreview(event.dataTransfer.files[0], preview, placeholder);
            });

            imageInput.addEventListener('change', function () {
                if (!imageInput.files.length) {
                    return;
                }

                renderPreview(imageInput.files[0], preview, placeholder);
            });
        }

        function renderPreview(file, preview, placeholder) {
            if (!file || !file.type.startsWith('image/')) {
                return;
            }

            const reader = new FileReader();
            reader.onload = function (loadEvent) {
                preview.src = loadEvent.target.result;
                preview.classList.remove('d-none');
                placeholder.classList.add('d-none');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
