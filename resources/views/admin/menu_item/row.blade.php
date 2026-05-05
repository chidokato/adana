<tr>
    <td>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="menuItemTableCheck{{ $item->id }}">
            <label class="form-check-label" for="menuItemTableCheck{{ $item->id }}"></label>
        </div>
    </td>
    <td><a href="{{ route('admin.menus.items.edit', [$menu, $item]) }}" class="fw-medium">#MI{{ str_pad((string) $item->id, 4, '0', STR_PAD_LEFT) }}</a></td>
    <td>
        <div class="fw-semibold">{{ str_repeat('-- ', $level) . $item->label }}</div>
        <div class="text-muted small">{{ $item->url ?: '-' }}</div>
    </td>
    <td>{{ optional($item->updated_at ?? $item->created_at)->format('d M, Y') ?? '-' }}</td>
    <td>{{ $item->target ?: '_self' }}</td>
    <td>
        <span class="badge {{ $item->status ? 'bg-success' : 'bg-danger' }}">
            {{ $item->status ? 'Paid' : 'Refund' }}
        </span>
    </td>
    <td>
        <div class="d-flex align-items-center justify-content-center gap-3">
            <a href="{{ route('admin.menus.items.edit', [$menu, $item]) }}" class="text-primary" title="View">
                <i class="ri-eye-fill fs-16"></i>
            </a>
            <a href="{{ route('admin.menus.items.edit', [$menu, $item]) }}" class="text-primary" title="Sua">
                <i class="ri-pencil-fill fs-16"></i>
            </a>
            <form action="{{ route('admin.menus.items.destroy', [$menu, $item]) }}" method="POST" class="d-inline" onsubmit="return confirm('Ban co chac muon xoa menu item nay?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-link p-0 text-danger" title="Xoa">
                    <i class="ri-delete-bin-5-fill fs-16"></i>
                </button>
            </form>
        </div>
    </td>
</tr>
@foreach ($item->children as $child)
    @include('admin.menu_item.row', ['item' => $child, 'level' => $level + 1, 'menu' => $menu])
@endforeach
