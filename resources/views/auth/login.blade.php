<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Login</title>

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
                                <div class="d-flex align-items-center justify-content-between m-b-30">
                                    <h3 class="m-b-0">Sign In</h3>
                                </div>
                                @if (session('status'))
                                    <div class="d-flex align-items-center justify-content-between m-b-30 text-success">Your password has been reset, login with your email and new password
                                    </div>
                                @endif    
                                <form class="row" method="POST" action="{{ route('login.store') }}">
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
                                        <label class="font-weight-semibold" for="password">Password:</label>
                                        <div class="input-affix m-b-10">
                                            <i class="prefix-icon anticon anticon-lock"></i>
                                            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="font-size-13 text-muted">
                                                @if (Route::has('password.request'))
                                                <a class="float-right font-size-13 text-muted" href="{{ route('password.request') }}">Forget Password?</a>
                                                @endif
                                            </span>
                                            <button type="submit" class="btn btn-primary">Sign In</button>
                                        </div>
                                    </div>
                                </form>
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
