@extends('admin.layout.main')

@section('title', 'Them danh muc')
@section('page_title', 'Them danh muc')
@section('breadcrumb', 'Them danh muc')

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Them danh muc',
        'heroSubtitle' => 'Tao danh muc moi cho san pham hoac tin tuc.',
        'heroPrimaryForm' => 'category-form',
        'heroPrimaryType' => 'submit',
        'heroPrimaryLabel' => 'Luu danh muc',
        'heroSecondaryRoute' => route('admin.categories.index'),
        'heroSecondaryLabel' => 'Quay lai',
    ])

    <form id="category-form" method="POST" action="{{ route('admin.categories.store') }}">
        @include('admin.category.form')
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
