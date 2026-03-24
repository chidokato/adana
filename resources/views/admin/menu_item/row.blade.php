<tr>
    <td>{{ $item->id }}</td>
    <td>
        <span style="padding-left: {{ $level * 16 }}px;">
            @if($level > 0)
                └
            @endif
            {{ $item->label }}
        </span>
    </td>
    <td>{{ $item->url }}</td>
    <td>{{ $item->target }}</td>
    <td>{{ $item->position }}</td>
    <td>
        <span class="badge {{ $item->status ? 'badge-success' : 'badge-secondary' }}">
            {{ $item->status ? 'Hiển thị' : 'Ẩn' }}
        </span>
    </td>
    <td class="text-center">
        <a href="{{ route('admin.menus.items.edit', [$menu, $item]) }}" class="btn btn-sm btn-warning">Sửa</a>
        <form action="{{ route('admin.menus.items.destroy', [$menu, $item]) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa menu item này?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
        </form>
    </td>
</tr>
@if($item->children && $item->children->count())
    @foreach($item->children as $child)
        @include('admin.menu_item.row', ['item' => $child, 'level' => $level + 1, 'menu' => $menu])
    @endforeach
@endif

