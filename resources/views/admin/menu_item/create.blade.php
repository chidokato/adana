@extends('admin.layout.main')

@section('title', 'Them menu item')
@section('page_title', 'Them menu item')
@section('breadcrumb', 'Them menu item')

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Them menu item',
        'heroSubtitle' => 'Tao lien ket moi cho menu: ' . $menu->name,
        'heroPrimaryForm' => 'menu-item-form',
        'heroPrimaryType' => 'submit',
        'heroPrimaryLabel' => 'Luu menu item',
        'heroSecondaryRoute' => route('admin.menus.items.index', $menu),
        'heroSecondaryLabel' => 'Quay lai',
    ])

    <form id="menu-item-form" method="POST" action="{{ route('admin.menus.items.store', $menu) }}">
        @csrf
        @include('admin.menu_item.form', ['item' => null, 'menu' => $menu, 'parents' => $parents])
    </form>
@endsection
