@extends('admin.layout.main')

@section('title', 'Cap nhat menu item')
@section('page_title', 'Cap nhat menu item')
@section('breadcrumb', 'Cap nhat menu item')

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Cap nhat menu item',
        'heroSubtitle' => 'Chinh sua lien ket cho menu: ' . $menu->name,
        'heroPrimaryForm' => 'menu-item-form',
        'heroPrimaryType' => 'submit',
        'heroPrimaryLabel' => 'Cap nhat menu item',
        'heroSecondaryRoute' => route('admin.menus.items.index', $menu),
        'heroSecondaryLabel' => 'Quay lai',
    ])

    <form id="menu-item-form" method="POST" action="{{ route('admin.menus.items.update', [$menu, $item]) }}">
        @csrf
        @method('PUT')
        @include('admin.menu_item.form', ['item' => $item, 'menu' => $menu, 'parents' => $parents])
    </form>
@endsection
