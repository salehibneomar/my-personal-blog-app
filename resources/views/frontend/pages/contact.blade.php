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
        @if (Session::has('alertMsg'))
            <div class="alert rounded-0 text-center 
            @if (Session::get('alertType')=='success')
                {{ 'alert-success' }}
            @else
            {{ 'alert-danger' }}
            @endif " >
                <b>{{ Session::get('alertMsg') }}</b>
            </div>
        @endif
        <form action="{{ route('contact.store') }}" method="post" class="row">
            @csrf
            <div class="form-group col-md-6">
                <label>Name</label>
                <input type="text" name="sender_name" class="form-control" required value="{{ old('sender_name') }}">
                @error('sender_name')
                <small class="text-danger form-text">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label>Email</label>
                <input type="email" name="sender_email" class="form-control" required value="{{ old('sender_email') }}">
                @error('sender_email')
                <small class="text-danger form-text">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-12">
                <label>Subject</label>
                <input type="text" name="subject" class="form-control" required value="{{ old('subject') }}">
                @error('subject')
                <small class="text-danger form-text">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-12">
                <label>Message</label>
                <textarea name="body" rows="10" class="w-100" required>{{ old('body') }}</textarea>
                @error('body')
                <small class="text-danger form-text">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-black">SEND&ensp;<i class="fa fa-paper-plane"></i></button>
            </div>
        </form>
    </div>
    
</div>
@endsection