@extends('frontend.layout')

@section('page_title')
{{ 'Blog - '.$post->title }}
@endsection

@section('main')

<div class="post">
    <!-- Heading -->
    <h1 class="pt-2">{{ $post->title }}</h1>
    <hr>
    <div class="in-content">
        @if(!is_null($post->image))
        <img class="img-thumbnail rounded-0" src="{{ asset($post->image) }}" alt="blog_picture" title="{{ $post->title }}">
        @endif
        <div class="text-justify my-3 " style="overflow-wrap: break-word !important;">
            {!! $post->details !!}
        </div>
    </div>
    <div class="foot-post">
        <div class="units-row">
            <div class="unit-100">
                <strong>POSTED:</strong>
                {{ $post->created_at->diffForHumans() }}
            </div>
        </div>
    </div>
</div>

@endsection