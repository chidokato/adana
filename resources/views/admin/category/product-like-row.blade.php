<tr>
    <td>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="categoryTreeCheck{{ $category->id }}">
            <label class="form-check-label" for="categoryTreeCheck{{ $category->id }}"></label>
        </div>
    </td>
    <td><a href="{{ route('admin.categories.edit', $category) }}" class="fw-medium">#CT{{ str_pad((string) $category->id, 4, '0', STR_PAD_LEFT) }}</a></td>
    <td>
        <div class="fw-semibold">{{ str_repeat('-- ', $level) . $category->name }}</div>
        <div class="text-muted small">{{ $category->slug }}</div>
    </td>
    <td>{{ optional($category->updated_at ?? $category->created_at)->format('d M, Y') ?? '-' }}</td>
    <td>{{ $category->type === 'news' ? 'Tin tuc' : 'San pham' }}</td>
    <td>
        <span class="badge {{ $category->status ? 'bg-success' : 'bg-danger' }}">
            {{ $category->status ? 'Paid' : 'Refund' }}
        </span>
    </td>
    <td>
        <div class="d-flex align-items-center justify-content-center gap-3">
            <a href="{{ route('admin.categories.edit', $category) }}" class="text-primary" title="View">
                <i class="ri-eye-fill fs-16"></i>
            </a>
            <a href="{{ route('admin.categories.edit', $category) }}" class="text-primary" title="Sua">
                <i class="ri-pencil-fill fs-16"></i>
            </a>
            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Ban co chac muon xoa category nay?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-link p-0 text-danger" title="Xoa">
                    <i class="ri-delete-bin-5-fill fs-16"></i>
                </button>
            </form>
        </div>
    </td>
</tr>

@foreach ($category->children as $child)
    @include('admin.category.product-like-row', ['category' => $child, 'level' => $level + 1])
@endforeach
