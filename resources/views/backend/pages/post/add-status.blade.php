@extends('backend.layout')

@section('page_title')
{{ 'Add Status' }}
@endsection

@section('main')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4>Post a status</h4>
                <div class="m-t-25">
                    <form action="{{ route('author.post.store', ['type'=>'status']) }}" method="POST" class="row">
                        @csrf
                        <div class="form-group col-md-10">
                            <input class="form-control" type="text" max="250" name="title" id="title" autocomplete="off">
                            <span class="form-text opacity-07 font-size-13" id="title-length"></span>
                        </div>
                        <div class="form-group col-md-2">
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
            $("#title").keyup(function() {
                let textChars = ($(this).val().trim()).length;
                $('#title-length').text(textChars+' /250');
            });
        });
    </script>
@endsection