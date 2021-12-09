@extends('backend.layout')

@section('page_title')
{{ 'Profile Edit' }}
@endsection

@section('main')

<div class="page-header no-gutters has-tab">
    <h2 class="font-weight-normal">Profile Edit</h2>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#general-information">General</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#image">Image</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#banner">Banner</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#password">Password</a>
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
                    <form action="{{ route('author.profile.general') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="font-weight-semibold" for="Name">Name:</label>
                                <input type="text" class="form-control" id="Name" placeholder="Name" name="name" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label class="font-weight-semibold" for="email">Email:</label>
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ Auth::user()->email }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label class="font-weight-semibold" for="bio">Bio:</label>
                                <input type="text" class="form-control" id="bio" placeholder="Bio" name="bio" value="{{ Auth::user()->bio }}" max="150">
                                <span class="form-text opacity-07 font-size-13" id="bio-length"></span>
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-tone btn-primary">SAVE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane fade show" id="image">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Image</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('author.profile.image') }}" class="row" enctype="multipart/form-data">
                        <div class="media align-items-center form-group col-md-12">
                            <div class="avatar avatar-image  m-h-10 m-r-15 avatar-image-custom" >
                                <img src="{{ asset(Auth::user()->image) }}" id="image-preview">
                            </div>
                            <div class="m-l-20 m-r-20">
                                <h5 class="m-b-5 font-size-15">Change Image</h5>
                                <p class="opacity-07 font-size-13 m-b-0">
                                    Recommended Dimensions: <br>
                                    200x200 Max fil size: 3MB
                                </p>
                            </div>
                        </div>
                        @csrf
                        <div class="form-group col-md-10 col-sm-12">
                            <input type="file" name="image" id="selected-image" class="form-control" accept=".png, .jpg, .jpeg">
                            <span class="form-text opacity-07 font-size-13" id="image-size"></span>
                        </div>
                        <div class="form-group col-md-2 col-sm-12">
                            <button type="submit" class="btn btn-tone btn-primary">SAVE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane fade show" id="banner">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Banner</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('author.profile.banner') }}" class="row" enctype="multipart/form-data">
                        <div class="media align-items-center form-group col-md-12">
                            <div class="m-l-20 m-r-20">
                                <h5 class="m-b-5 font-size-15">Change Banner</h5>
                                <p class="opacity-07 font-size-13 m-b-0">
                                    Recommended Dimensions: <br>
                                    1350x272 Max fil size: 5MB
                                </p>
                            </div>
                        </div>
                        @csrf
                        <div class="form-group col-md-10 col-sm-12">
                            <input type="file" name="banner" class="form-control" accept=".png, .jpg, .jpeg">
                        </div>
                        <div class="form-group col-md-2 col-sm-12">
                            <button type="submit" class="btn btn-tone btn-primary">SAVE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane fade show" id="password">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Password</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('author.profile.password') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="font-weight-semibold" for="currentPass">Current Password:</label>
                                <input type="password" class="form-control" id="currentPass" placeholder="Current Password" name="current_password" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="font-weight-semibold" for="newPass">New Password:</label>
                                <input type="password" class="form-control" id="newPass" placeholder="New Password" name="new_password" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="font-weight-semibold" for="retypePass">Retype New Password:</label>
                                <input type="password" class="form-control" id="retypePass" placeholder="Retype New Password" name="new_password_confirmation" required>
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-tone btn-primary">SAVE</button>
                            </div>
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
            let imageSize = ((e.target.files[0].size)/1024).toFixed(2);
            if(imageSize>=1000){
                imageSize=(imageSize/1024).toFixed(2);
                imageSize = imageSize.toString()+' MB';
            }
            else{
                imageSize = imageSize.toString()+' KB';
            }
            $('#image-size').text('Selected Logo size: '+imageSize);
        });

        $( "#bio" ).keyup(function() {
            let textChars = ($(this).val().trim()).length;
            $('#bio-length').text(textChars+' /150');
        });
    });
</script>

@endsection