@csrf
@php($category = $category ?? null)

<div class="row">
    <div class="col-xl-9">
        <div class="card border">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên danh mục</label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name ?? '') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <div class="form-control bg-light text-muted d-flex align-items-center">
                                <span id="slug_preview_text">{{ old('slug', $category->slug ?? 'slug-tu-dong-theo-ten-danh-muc') }}</span>
                            </div>
                            <div class="form-text">Slug tự động theo tên danh mục.</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-0">
                            <label class="form-label">Ghi chú</label>
                            <div class="form-control bg-light text-muted" style="min-height: 96px;">
                                Category trong Adana hiện dùng trường cơ bản để quản lý cây danh mục giống cấu trúc backend của trang mẫu.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3">
        <div class="card border">
            <div class="card-body">
                <div class="mb-3">
                    <label for="type" class="form-label">Loại danh mục</label>
                    <select id="type" name="type" class="form-select @error('type') is-invalid @enderror" required>
                        <option value="product" {{ old('type', $category->type ?? request('type', 'product')) === 'product' ? 'selected' : '' }}>Danh mục sản phẩm</option>
                        <option value="news" {{ old('type', $category->type ?? request('type')) === 'news' ? 'selected' : '' }}>Danh mục tin tức</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="parent_id" class="form-label">Danh mục cha</label>
                    <select id="parent_id" name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                        <option value="">Không có</option>
                        @foreach ($parents as $parent)
                            <option value="{{ $parent->id }}" data-type="{{ $parent->type }}" {{ old('parent_id', $category->parent_id ?? '') == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="custom-control custom-switch">
                    <input class="custom-control-input" type="checkbox" id="status" name="status" value="1" {{ old('status', $category->status ?? 1) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="status">Hiển thị danh mục</label>
                </div>
            </div>
        </div>
    </div>
</div>
