@extends('frontend.layout.main')

@section('content')
<section class="py-100">
    <div class="container">
        <h1 class="mb-20">{{ $news->title }}</h1>
        @if($news->thumbnail)
            <div class="mb-4">
                <img src="{{ asset($news->thumbnail) }}" alt="{{ $news->title }}">
            </div>
        @endif
        <div>{!! $news->content !!}</div>
    </div>
</section>
@endsection
