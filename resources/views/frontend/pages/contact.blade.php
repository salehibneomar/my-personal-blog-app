@extends('frontend.layout')

@section('page_title')
Contact
@endsection

@section('main')
<div class="post">
    <!-- Heading -->
    <a ><h1>Send Me Messages</h1></a>
    <hr>
    <div class="in-content">
        <form action="" method="post" class="row">
            <div class="form-group col-md-6">
                <label>Name</label>
                <input type="text" name="sender_name" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label>Email</label>
                <input type="email" name="sender_email" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label>Subject</label>
                <input type="text" name="email_subject" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label>Message</label>
                <textarea name="message" rows="10" class="w-100"></textarea>
            </div>
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-black">SEND&ensp;<i class="fa fa-paper-plane"></i></button>
            </div>
        </form>
    </div>
    
</div>
@endsection