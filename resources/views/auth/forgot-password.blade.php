<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Forgot Password</title>

<!-- Favicon -->
<link rel="shortcut icon" href="">
<link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet">
</head>

<body>

<div class="app">
    <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex" style="background-image: url('{{ asset('backend/assets/images/others/login-3.png') }}')">
        <div class="d-flex flex-column justify-content-between w-100">
            <div class="container d-flex h-100">
                <div class="row align-items-center w-100">
                    <div class="col-md-7 col-lg-5 m-h-auto">
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between m-b-15">
                                    <h3 class="m-b-0">Forgot Password</h3>
                                </div>

                                @if (!session('status'))
                                    <div class="d-flex align-items-center justify-content-between m-b-30">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                                    </div>
                                    <form class="row" method="POST" action="{{ route('password.email') }}">
                                        @csrf
                                        <div class="form-group col-12">
                                            <label class="font-weight-semibold" for="userName">Email:</label>
                                            <div class="input-affix">
                                                <i class="prefix-icon anticon anticon-user"></i>
                                                <input type="email" class="form-control @error('email')is-invalid @enderror" id="userName" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="off">
                                            </div>
                                            @error('email')
                                            <div class="text-danger mt-2">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-12">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="font-size-13 text-muted"></span>
                                                <button type="submit" class="btn btn-primary">
                                                    Send Reset Link
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                <div class="d-flex align-items-center justify-content-between m-b-30 text-success">
                                    A verification link has been sent to your email address!
                                </div>    
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

    
<!-- Core Vendors JS -->
<script src="{{ asset('backend/assets/js/vendors.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/app.min.js') }}"></script>

</body>

</html>
