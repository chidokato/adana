@php($seo = $seo ?? null)

<div class="row">
    <div class="col-xl-8">
        <div class="card border">
            <div class="card-body">
                <div class="mb-3">
                    <label for="url" class="form-label">URL</label>
                    <input type="text" id="url" name="url" class="form-control @error('url') is-invalid @enderror" value="{{ old('url', $seo->url ?? '') }}" placeholder="/, /gioi-thieu, /lien-he" required>
                    <div class="form-text">Nhap duong dan can cau hinh SEO cho trang nay.</div>
                    @error('url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">SEO title</label>
                    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $seo->title ?? '') }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-0">
                    <label for="description" class="form-label">SEO description</label>
                    <textarea id="description" name="description" rows="6" class="form-control @error('description') is-invalid @enderror">{{ old('description', $seo->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card border">
            <div class="card-header">
                <h5 class="card-title mb-0">Huong dan</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="fw-semibold mb-2">Cach nhap URL</div>
                    <div class="text-muted small">Su dung "/" cho trang chu va duong dan dang "/ten-trang" cho cac trang con.</div>
                </div>
                <div class="mb-3">
                    <div class="fw-semibold mb-2">SEO title</div>
                    <div class="text-muted small">Nen gon, ro nghia va phu hop noi dung trang.</div>
                </div>
                <div class="mb-0">
                    <div class="fw-semibold mb-2">SEO description</div>
                    <div class="text-muted small">Mo ta ngan gon de hien thi tren cong cu tim kiem.</div>
                </div>
            </div>
        </div>
    </div>
</div>
