@php($item = $item ?? null)
@php($imagePreview = !empty($item->image) ? asset($item->image) : asset('data/no_image.jpg'))

<div class="row">
    <div class="col-xl-8">
        <div class="card border">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Tieu de</label>
                            <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $item->title ?? '') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="type" class="form-label">Loai</label>
                            <select id="type" name="type" class="form-select @error('type') is-invalid @enderror">
                                <option value="slider" {{ old('type', $item->type ?? 'slider') === 'slider' ? 'selected' : '' }}>Slider</option>
                                <option value="banner" {{ old('type', $item->type ?? 'slider') === 'banner' ? 'selected' : '' }}>Banner</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label for="link" class="form-label">Link</label>
                            <input type="text" id="link" name="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link', $item->link ?? '') }}" placeholder="/duong-dan">
                            @error('link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="position" class="form-label">Vi tri</label>
                            <input type="number" id="position" name="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position', $item->position ?? 0) }}">
                            @error('position')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="custom-control custom-switch">
                            <input class="custom-control-input" type="checkbox" id="status" name="status" value="1" {{ old('status', $item->status ?? 1) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="status">Hien thi slider/banner</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card border">
            <div class="card-header">
                <h5 class="card-title mb-0">Hinh anh</h5>
            </div>
            <div class="card-body">
                <div class="mb-0">
                    <label class="form-label">Anh slider/banner</label>
                    <input type="file" id="media-image-input" name="image" class="d-none @error('image') is-invalid @enderror" accept="image/*">
                    <button type="button" id="media-image-dropzone" class="border rounded bg-light d-flex align-items-center justify-content-center overflow-hidden p-0 w-100 media-image-dropzone">
                        <img id="media-image-preview" src="{{ $imagePreview }}" alt="Media banner" class="w-100 h-100 object-fit-cover">
                    </button>
                    <div class="form-text mt-2">Click hoac drop anh vao day.</div>
                    @error('image')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .media-image-dropzone {
        min-height: 280px;
        transition: .2s ease;
    }

    .media-image-dropzone:hover {
        border-color: rgba(64, 81, 137, .35) !important;
        background: #f8fafc !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const imageInput = document.getElementById('media-image-input');
        const dropzone = document.getElementById('media-image-dropzone');
        const preview = document.getElementById('media-image-preview');

        if (!imageInput || !dropzone || !preview) {
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
            renderPreview(event.dataTransfer.files[0]);
        });

        imageInput.addEventListener('change', function () {
            if (!imageInput.files.length) {
                return;
            }

            renderPreview(imageInput.files[0]);
        });

        function renderPreview(file) {
            if (!file || !file.type.startsWith('image/')) {
                return;
            }

            const reader = new FileReader();
            reader.onload = function (loadEvent) {
                preview.src = loadEvent.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
