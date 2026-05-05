@extends('admin.layout.main')

@section('title', 'Them cau hinh trang chu')
@section('page_title', 'Them cau hinh trang chu')
@section('breadcrumb', 'Them cau hinh trang chu')

@section('content')
    @include('admin.partials.list-hero', [
        'heroTitle' => 'Them cau hinh trang chu',
        'heroSubtitle' => 'Tao section moi de hien thi noi dung tren trang chu.',
        'heroPrimaryForm' => 'home-config-form',
        'heroPrimaryType' => 'submit',
        'heroPrimaryLabel' => 'Luu cau hinh',
        'heroSecondaryRoute' => route('admin.home-configs.index'),
        'heroSecondaryLabel' => 'Quay lai',
    ])

    <form id="home-config-form" method="POST" action="{{ route('admin.home-configs.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.home_config.form')
    </form>
@endsection

@section('js')
<script>
function readHomeImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.file-upload-image-home').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
