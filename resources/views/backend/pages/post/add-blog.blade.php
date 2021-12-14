@extends('backend.layout')

@section('page_title')
{{ 'Add Blog' }}
@endsection

@section('main')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4>Post a blog</h4>
                <div class="m-t-25">
                    <form action="{{ route('author.post.store', ['type'=>'blog']) }}" method="POST" class="row" enctype="multipart/form-data">
                        @csrf
                        <div class="media align-items-center form-group col-md-12">
                            <div class="row">
                                <div class="m-b-15 col-12">
                                    <img src="{{ asset('images/no-image.jpg') }}" id="image-preview" class="img-fluid">
                                </div>
                                <div class="col-12">
                                    <h5 class="m-b-5 font-size-15">Picture</h5>
                                    <p class="opacity-07 font-size-13 m-b-0">
                                        Recommended Dimensions: <br>
                                        622x342 Max file size: 5MB
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <input class="form-control" type="file" name="image" id="selected-image" accept=".png, .jpg, .jpeg" autocomplete="off" value="">
                            <span class="form-text opacity-07 font-size-13" id="image-size"></span>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="title">Title</label>
                            <input class="form-control" type="text" name="title" id="title" max="250" value="{{ old('title') }}" required>
                            <span class="form-text opacity-07 font-size-13" id="title-length"></span>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="editor">Details</label>
                            <textarea name="details" id="editor" rows="10" class="form-control" required>{{ old('details') }}</textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary btn-tone m-r-5">POST</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('extra_script')
<script src="{{ asset('backend/assets/vendors/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function(){

            $("#title").keyup(function() {
                let textChars = ($(this).val().trim()).length;
                $('#title-length').text(textChars+' /250');
            });

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
                $('#image-size').text('Selected image size: '+imageSize);
            });

            CKEDITOR.replace('editor');

        });
    </script>
@endsection

