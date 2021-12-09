@extends('backend.layout')

@section('page_title')
{{ 'Profile' }}
@endsection

@section('main')

<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-md-flex align-items-center">
                        <div class="text-center text-sm-left ">
                            <div class="avatar avatar-image" style="min-width: 150px; max-width: 150px; min-height:150px; max-height:150px;">
                                <img src="{{ asset(Auth::user()->image) }}">
                            </div>
                        </div>
                        <div class="text-center text-sm-left m-v-15 p-l-30">
                            <h2 class="m-b-5">{{ Auth::user()->name }}</h2>
                            <p class="text-opacity font-size-13">
                                #{{ Auth::user()->id }}
                            </p>
                            <p class="text-dark m-b-20">
                                Author
                            </p>
                            <a href="{{ route('author.profile.edit') }}" class="btn btn-primary btn-tone">
                                EDIT
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="d-md-block d-none border-left col-1"></div>
                        <div class="col">
                            <ul class="list-unstyled m-t-10">
                                <li class="row">
                                    <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                        <i class="m-r-10 text-primary anticon anticon-mail"></i>
                                        <span>Email: </span> 
                                    </p>
                                    <p class="col font-weight-semibold"> 
                                        {{ Auth::user()->email }}
                                    </p>
                                </li>
                                <li class="row">
                                    <p class="col-sm-4 col-5 font-weight-semibold text-dark m-b-5">
                                        <i class="m-r-10 text-primary anticon anticon-calendar"></i>
                                        <span>Joined: </span> 
                                    </p>
                                    <p class="col font-weight-semibold">
                                        {{ 
                                           date('d M Y', 
                                           strtotime(Auth::user()->created_at)) 
                                        }}
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5>Bio</h5>
                    <p>
                        {{ Auth::user()->bio }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection