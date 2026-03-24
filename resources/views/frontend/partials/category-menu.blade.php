@foreach($items as $item)
    <li class="menu-item">
        <a href="#">{{ $item->name }}</a>
        @if($item->children && $item->children->count())
            <ul class="sub-menu sub-menu--container">
                @include('frontend.partials.category-menu', ['items' => $item->children->where('type', $item->type)])
            </ul>
        @endif
    </li>
@endforeach

