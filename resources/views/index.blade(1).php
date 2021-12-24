@extends('frontend.layout')

@section('page_title')
Home
@endsection

@section('banner')
    <div class="intro" style="background: url({{ asset($site_info->banner) }}) #F7F7F7 center top;">
        <div class="container">
            <div class="units-row">
                <div class="unit-10">
                    <img class="img-intro" src="{{ asset($site_info->image) }}" alt="Image" title="Image">
                </div>
                <div class="unit-90">
                    <p class="p-intro" title="BIO">
                        {{ $site_info->bio }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main')
    <!-- Posts -->
    @forelse ($posts as $post)

        @if ($post->type==1)

        <div class="post pt-4">
            <h1 class="pt-3">{{ $post->title }}</h1>
            <div class="foot-post">
                <div class="units-row ">
                    <div class="unit-100">
                        <strong>Posted:</strong>
                        {{ $post->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>

        @elseif ($post->type==2)

        <div class="post">
            <div class="row">
                <div class="col-12">
                    <hr class="pb-4">
                </div>
                <div class="col-12">
                    <div class="in-content p-0 m-0">
                        <img class="img-thumbnail rounded-0" src="{{ asset($post->image) }}" alt="picture" >
                        <p>
                            {{ $post->title }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="foot-post-blog-picture">
                <div class="units-row ">
                    <div class="unit-100">
                        <strong>Posted:</strong>
                        {{ $post->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>

        @elseif ($post->type==3)

        <div class="post">
            <h1 class="pt-3">{{ $post->title }}</h1>
            <hr>
            <div class="in-content">
                @if(!is_null($post->image))
                <img class="img-thumbnail rounded-0" src="{{ asset($post->image) }}" alt="blog_picture" >
                @endif
                <p class="text-justify">
                    {{ Str::limit(strip_tags(html_entity_decode($post->details, ENT_QUOTES)), 200, '...') }}
                </p>
                <a class="read-more" href="{{ route('single.post', ['slug'=>$post->slug, 'uuid'=>$post->uniq_code]) }}">Read more</a>
            </div>
            <div class="foot-post">
                <div class="units-row ">
                    <div class="unit-100">
                        <strong>Posted:</strong>
                        {{ $post->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>
        
        @endif

    @empty
    
        <div class="alert alert-info rounded-0 text-center">
            I'll be posting soon 😃
        </div>

    @endforelse
    <!-- /posts -->

@endsection

@section('main_pagination')
<div class="units-row my-5">
    <div class="unit-60 my-3">
        {{ $posts->links('vendor.pagination.custom') }}
    </div>
</div>
@endsection