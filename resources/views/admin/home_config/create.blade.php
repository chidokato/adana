@extends('admin.layout.main')

@section('content')
<form method="POST" action="{{ route('admin.home-configs.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm cấu hình trang chủ</h1>
        <div>
            <a href="{{ route('admin.home-configs.index') }}" class="btn btn-secondary">Quay lại</a>
            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
    </div>

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
