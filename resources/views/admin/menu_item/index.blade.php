@extends('admin.layout.main')

@section('title', 'Menu item')
@section('page_title', 'Menu item')
@section('breadcrumb', 'Menu item')

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Quan ly menu item: ' . $menu->name,
        'heroSubtitle' => 'Danh sach lien ket, cap con va target hien thi trong menu.',
        'heroPrimaryRoute' => route('admin.menus.items.create', $menu),
        'heroPrimaryLabel' => 'Them menu item',
    ])

    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">Card Tables</h4>
        </div>

        <div class="live-preview px-3 py-3">
            <div class="table-responsive table-card">
                <table class="table align-middle table-nowrap table-striped-columns mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 46px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="menuItemTableCheck" disabled>
                                    <label class="form-check-label" for="menuItemTableCheck"></label>
                                </div>
                            </th>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Target</th>
                            <th scope="col">Status</th>
                            <th scope="col" style="width: 150px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            @include('admin.menu_item.row', ['item' => $item, 'level' => 0, 'menu' => $menu])
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No data found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
