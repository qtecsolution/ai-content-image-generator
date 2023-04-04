@extends('auth.app')

@section('title', 'Login')

@section('content')
    <form method="POST" class="authentication-form needs-validation" action="{{ route('login') }}" novalidate>
        @csrf
        <div class="authentication-form-header">
            <h3 class="logo-name"> <a href="{{route('/')}}"> {{readConfig('type_name')}} </a> </h3>
            <h3 class="section-title">Log in to your account</h3>
            <p class="form-des">{{readConfig('type_login_title')}}</p>
        </div>

        <div class="authentication-form-body">

            <!-- Email    -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control custom-input @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ old('email') }}" required autocomplete="off" placeholder="Enter your Email">
                <div class="valid-feedback">
                    Awesome! You're one step closer to greatness.
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- password -->

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control custom-input @error('password') is-invalid @enderror"
                    name="password" id="password" required autocomplete="off" placeholder="Enter your Password">
                <div class="valid-feedback">
                    Awesome! You're one step closer to greatness.
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- remember and forget -->
            <div class="remember-forgot">
                <div class="checkWithLable mb-2">
                    <input type="checkbox" id="useCaseTitle" class="checkWithLable-box"name="remember" {{ old('remember') ? 'checked' : '' }}
                        hidden>
                    <label for="useCaseTitle" class="checkWithLable-label gray-600 font-500"> Remember Me </label>
                </div>
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-pass">Forgot password</a>
                @endif
            </div>

            <!-- get started  -->
            <button class="gradient-btn">Sign in </button>


            @if(env('GOOGLE_CLIENT_ID') != '' && env('GOOGLE_CLIENT_SECRET') != '')
            <!-- google  -->
            <button onclick="redirectUrl('{{ route('auth.google') }}')" class="social-btn" type="button">
                <span class="icon">
                    <img src="{{asset('/assets/images/icons/google.svg')}}" width="25">
                </span>
                <span class="text">Sign in with Google</span>
            </button>
            @endif


            <p class="authentication-bottom">Don’t have an account? <a href="{{ route('register') }}">Sign up</a> </p>

        </div>
    </form>
@endsection
