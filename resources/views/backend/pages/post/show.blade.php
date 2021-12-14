@extends('backend.layout')

@section('page_title')
{{ 'Post Details' }}
@endsection

@section('main')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4>Post Details</h4>
                <div class="m-t-35">
                    @if ($post->type==3)
                    <div class="row">
                        <div class="col-12 border-bottom pb-3">
                            <strong>{{ $post->title }}</strong>
                        </div>
                        <div class="col-12 mt-3 text-center">
                            <img src="{{ asset($post->image) }}" alt="blog-picture" class="img-thumbnail">
                        </div>
                        <div class="col-12 mt-3 border-bottom pb-3 text-center">
                            <span class="mb-1 mr-1 badge badge-pill badge-primary">
                                Posted: {{ date('d M y', strtotime($post->created_at)) }}
                            </span>
                            <span class="badge badge-pill badge-success">
                                Updated: {{ date('d M y', strtotime($post->created_at)) }}
                            </span>
                        </div>
                        <div class="col-12 mt-3">
                            {!! $post->details !!}
                        </div>
                    </div>
                    @elseif($post->type==2)
                    <div class="row">
                        <div class="col-12 mt-3 text-center">
                            <img src="{{ asset($post->image) }}" alt="blog-picture" class="img-thumbnail" style="width: 320px;">
                        </div>
                        <div class="col-12 mt-3 border-bottom pb-3 text-center">
                            <span class="mb-1 mr-1 badge badge-pill badge-primary">
                                Posted: {{ date('d M y', strtotime($post->created_at)) }}
                            </span>
                            <span class="badge badge-pill badge-success">
                                Updated: {{ date('d M y', strtotime($post->created_at)) }}
                            </span>
                        </div>
                        <div class="col-12 mt-3 text-justify">
                            {{ $post->title }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


