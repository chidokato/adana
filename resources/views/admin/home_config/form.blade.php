<div class="row">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label for="section_key">Key section</label>
                    <input type="text" class="form-control" id="section_key" name="section_key" value="{{ old('section_key', $item->section_key ?? '') }}" placeholder="vd: intro_section">
                </div>
                <div class="form-group">
                    <label for="title">Tiêu đề</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $item->title ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $item->description ?? '') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control editor" id="content" name="content" rows="6">{{ old('content', $item->content ?? '') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="note">Note</label>
                    <textarea class="form-control" id="note" name="note" rows="3">{{ old('note', $item->note ?? '') }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label>Hình ảnh</label>
                    <div style="display:flex;">
                        <span class="file-upload">
                            <span class="file-upload-content" onclick="$('.file-upload-input-home').trigger('click')">
                                <img class="file-upload-image file-upload-image-home" src="{{ !empty($item->image) ? asset($item->image) : asset('data/no_image.jpg') }}" alt="home-config">
                            </span>
                            <span class="image-upload-wrap">
                                <input name="image" class="file-upload-input file-upload-input-home" type="file" onchange="readHomeImage(this);" accept="image/*">
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
