<tr>
    <td>
        <div class="form-check">
            <input class="form-check-input" type="checkbox">
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center">
            <span class="text-muted me-2">{{ str_repeat('- ', $level) }}</span>
            <div class="fw-semibold">{{ $category->name }}</div>
        </div>
    </td>
    <td>{{ $category->slug }}</td>
    <td>
        <span class="badge {{ $category->status ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
            {{ $category->status ? 'Hien thi' : 'An' }}
        </span>
    </td>
    <td class="text-end">
        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-light btn-sm">Sua</a>
        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Ban co chac muon xoa category nay?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-light btn-sm">Xoa</button>
        </form>
    </td>
</tr>

@foreach ($category->children as $child)
    @include('admin.category.row', ['category' => $child, 'level' => $level + 1])
@endforeach
