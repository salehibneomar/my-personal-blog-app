@extends('backend.layout')

@section('page_title')
{{ 'Setting' }}
@endsection

@section('main')

<div class="page-header no-gutters has-tab">
    <h2 class="font-weight-normal">Setting</h2>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#general-information">General</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#logo">Logo</a>
        </li>
    </ul>
</div>

<div class="container">
    
    <div class="tab-content m-t-15">
        <div class="tab-pane fade show active" id="general-information">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">General Information</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('author.setting.general') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="font-weight-semibold" for="fullSiteName">Full Site Name:</label>
                                <input type="text" class="form-control" id="fullSiteName" placeholder="Full Site Name" name="name" value="{{ $settings->name }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label class="font-weight-semibold" for="siteInitial">Site Initial:</label>
                                <input type="text" class="form-control" id="siteInitial" placeholder="Site Initial" name="initial_name" value="{{ $settings->initial_name }}">
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-tone btn-primary">SAVE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane fade show" id="logo">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Logo</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('author.setting.logo') }}" class="row" enctype="multipart/form-data">
                        <div class="media align-items-center form-group col-md-12">
                            <div class="avatar avatar-image  m-h-10 m-r-15 avatar-image-custom" >
                                <img src="{{ asset($settings->logo) }}" id="image-preview">
                            </div>
                            <div class="m-l-20 m-r-20">
                                <h5 class="m-b-5 font-size-15">Change Logo</h5>
                                <p class="opacity-07 font-size-13 m-b-0">
                                    Recommended Dimensions: <br>
                                    32x32 Max fil size: 128KB
                                </p>
                            </div>
                        </div>
                        @csrf
                        <div class="form-group col-md-10 col-sm-12">
                            <input type="file" name="logo" id="selected-image" class="form-control" accept=".png">
                            <span class="form-text opacity-07 font-size-13" id="image-size"></span>
                        </div>
                        <div class="form-group col-md-2 col-sm-12">
                            <button type="submit" class="btn btn-tone btn-primary">SAVE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection

@section('extra_script')

<script>
    $(document).ready(function(){
        $('#selected-image').change(function(e){
            let reader    = new FileReader();
            reader.onload = function(e){
                $('#image-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
            $('#image-size').text('Selected Logo size: '+
            ((e.target.files[0].size)/1024).toFixed(2).toString() + ' KB');
        });
    });
</script>

@endsection