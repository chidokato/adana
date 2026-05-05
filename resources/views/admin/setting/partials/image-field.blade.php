<div class="col-lg-4">
    <div class="border rounded p-3 h-100">
        <div class="mb-3">
            <label class="form-label d-block">{{ $title }}</label>
            <input type="file" id="{{ $field }}" name="{{ $field }}" class="d-none setting-image-input" accept="image/*" data-preview-target="{{ $field }}_preview" data-placeholder-target="{{ $field }}_placeholder">
            <button type="button" class="border rounded bg-light d-flex align-items-center justify-content-center overflow-hidden p-0 w-100 setting-image-dropzone" data-input-trigger="{{ $field }}">
                <img
                    id="{{ $field }}_preview"
                    src="{{ !empty($image) ? asset($image) : '' }}"
                    alt="{{ $title }}"
                    class="w-100 h-100 object-fit-cover {{ !empty($image) ? '' : 'd-none' }}"
                >
                <div id="{{ $field }}_placeholder" class="text-center text-muted px-3 {{ !empty($image) ? 'd-none' : '' }}">
                    <div class="display-6 mb-2"><i class="ri-image-line"></i></div>
                    <div class="fw-semibold">NO IMAGE</div>
                    <div>Click hoặc drop ảnh vào đây</div>
                </div>
            </button>
        </div>
    </div>
</div>
