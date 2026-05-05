@extends('admin.layout.main')

@section('title', 'Cap nhat danh muc')
@section('page_title', 'Cap nhat danh muc')
@section('breadcrumb', 'Cap nhat danh muc')

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Cap nhat danh muc',
        'heroSubtitle' => 'Chinh sua ten, loai, danh muc cha va trang thai hien thi.',
        'heroPrimaryForm' => 'category-form',
        'heroPrimaryType' => 'submit',
        'heroPrimaryLabel' => 'Cap nhat danh muc',
        'heroSecondaryRoute' => route('admin.categories.index'),
        'heroSecondaryLabel' => 'Quay lai',
    ])

    <form id="category-form" method="POST" action="{{ route('admin.categories.update', $category) }}">
        @csrf
        @method('PUT')
        @include('admin.category.form', ['category' => $category])
    </form>
@endsection

@section('js')
<script>
    function filterParentOptions() {
        var type = $('#type').val();
        $('#parent_id option').each(function() {
            var optType = $(this).data('type');
            if (!optType) return;
            $(this).toggle(optType === type);
        });
        if ($('#parent_id option:selected').data('type') && $('#parent_id option:selected').data('type') !== type) {
            $('#parent_id').val('');
        }
    }

    function toSlug(text) {
        return text
            .toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .replace(/đ|Ä‘/g, 'd')
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '')
            || 'slug-tu-dong-theo-ten-danh-muc';
    }

    $(document).ready(function() {
        filterParentOptions();
        $('#type').on('change', filterParentOptions);
        $('#name').on('input', function() {
            $('#slug_preview_text').text(toSlug($(this).val()));
        }).trigger('input');
    });
</script>
@endsection
