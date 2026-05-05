<div class="row">
    <div class="col-xl-9">
        <div class="card border">
            <div class="card-body">
                <div class="mb-3">
                    <label for="label" class="form-label">Ten hien thi</label>
                    <input type="text" id="label" name="label" class="form-control @error('label') is-invalid @enderror" value="{{ old('label', $item->label ?? '') }}" required>
                    @error('label')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-0">
                    <label for="url" class="form-label">Duong link</label>
                    <input type="text" id="url" name="url" class="form-control @error('url') is-invalid @enderror" value="{{ old('url', $item->url ?? '') }}" placeholder="/san-pham, https://..., #">
                    @error('url')
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
                    <label for="parent_id" class="form-label">Menu cha</label>
                    <select id="parent_id" name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                        <option value="">Khong co</option>
                        @foreach ($parents as $parent)
                            <option value="{{ $parent->id }}" {{ (string) old('parent_id', $item->parent_id ?? '') === (string) $parent->id ? 'selected' : '' }}>
                                {{ $parent->label }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="target" class="form-label">Target</label>
                    <select id="target" name="target" class="form-select @error('target') is-invalid @enderror">
                        <option value="_self" {{ old('target', $item->target ?? '_self') === '_self' ? 'selected' : '' }}>_self</option>
                        <option value="_blank" {{ old('target', $item->target ?? '_self') === '_blank' ? 'selected' : '' }}>_blank</option>
                    </select>
                    @error('target')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="position" class="form-label">Vi tri</label>
                    <input type="number" id="position" name="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position', $item->position ?? 0) }}">
                    @error('position')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="custom-control custom-switch">
                    <input class="custom-control-input" type="checkbox" id="status" name="status" value="1" {{ old('status', (string) ($item->status ?? 1)) == '1' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="status">Hien thi menu item</label>
                </div>
            </div>
        </div>
    </div>
</div>
