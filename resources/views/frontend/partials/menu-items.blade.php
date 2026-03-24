@foreach($items as $item)
    @php
        $children = \App\Models\MenuItem::where('menu_id', $item->menu_id)
            ->where('parent_id', $item->id)
            ->where('status', 1)
            ->orderBy('position')
            ->get();
        $hasChildren = $children->count() > 0;
        $url = $item->url ?: '#';
        $url = str_starts_with($url, 'http') || str_starts_with($url, '/') ? $url : '/' . ltrim($url, '/');
    @endphp
    <li class="menu-item {{ $hasChildren ? 'menu-item-has-children' : '' }}">
        <a href="{{ $url }}" target="{{ $item->target ?: '_self' }}">
            {{ $item->label }}
            @if($hasChildren)
                <svg class="chevron-down" width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6.5L8 10.5L12 6.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            @endif
        </a>
        @if($hasChildren)
            <ul class="sub-menu sub-menu--container">
                @include('frontend.partials.menu-items', ['items' => $children])
            </ul>
        @endif
    </li>
@endforeach

