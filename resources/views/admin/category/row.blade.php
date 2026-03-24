<tr>
    <td>{{ $category->id }}</td>
    <td>
        <span style="padding-left: {{ $level * 16 }}px;">
            @if($level > 0)
                └
            @endif
            {{ $category->name }}
        </span>
    </td>
    <td>{{ $category->type === 'news' ? 'Tin tức' : 'Sản phẩm' }}</td>
    <td>{{ $category->slug }}</td>
    <td class="text-center">
        <div class="custom-control custom-switch d-inline-block">
            <input type="checkbox"
                   class="custom-control-input js-toggle-category-status"
                   id="catStatus{{ $category->id }}"
                   data-url="{{ route('admin.categories.toggleStatus', $category) }}"
                   {{ $category->status ? 'checked' : '' }}>
            <label class="custom-control-label" for="catStatus{{ $category->id }}"></label>
        </div>
    </td>
    <td class="text-center">
        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-warning">Sửa</a>
        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa danh mục này?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
        </form>
    </td>
</tr>
@if($category->children && $category->children->count())
    @foreach($category->children->where('type', $category->type) as $child)
        @include('admin.category.row', ['category' => $child, 'level' => $level + 1])
    @endforeach
@endif
