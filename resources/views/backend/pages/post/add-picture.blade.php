@extends('backend.layout')

@section('page_title')
{{ 'Add Picture' }}
@endsection

@section('main')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4>Post a picture</h4>
                <div class="m-t-25">
                    <form action="{{ route('author.post.store', ['type'=>'picture']) }}" method="POST" class="row" enctype="multipart/form-data">
                        @csrf
                        <div class="media align-items-center form-group col-md-12">
                            <div class="row">
                                <div class="m-b-15 col-12">
                                    <img src="{{ asset('images/no-image.jpg') }}" id="image-preview" style="max-width: 280px; min-width: 280px; max-height: 280px; min-height: 280px;">
                                </div>
                                <div class="col-12">
                                    <h5 class="m-b-5 font-size-15">Picture</h5>
                                    <p class="opacity-07 font-size-13 m-b-0">
                                        Recommended Dimensions: <br>
                                        622x622 Max file size: 5MB
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <input class="form-control" type="file" name="image" id="selected-image" accept=".png, .jpg, .jpeg" autocomplete="off" value="">
                            <span class="form-text opacity-07 font-size-13" id="image-size"></span>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="caption">Caption</label>
                            <input class="form-control" type="text" name="title" id="caption" max="100" value="{{ old('title') }}">
                            <span class="form-text opacity-07 font-size-13" id="caption-length"></span>
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
    <script>
        $(document).ready(function(){
            $("#caption").keyup(function() {
                let textChars = ($(this).val().trim()).length;
                $('#caption-length').text(textChars+' /100');
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
        });
    </script>
@endsection

