@extends('layouts.app')
@section('title','Login')
@section('content')
<div class="container-fluid p-0">
    <div class="row m-0">
      <div class="col-12 p-0">    
        <div class="login-card login-dark">
          <div>
            <div>
              <a class="logo" href="{{ url('/') }}">
                  {{--  <img class="img-fluid for-light m-auto" src="{{ url('/assets') }}/images/logo/logo.png" alt="login page" style="width: 100px; height: 100px;">
                  <img class="img-fluid for-dark" src="{{ url('/assets') }}/images/logo/logo.png" alt="logo" style="width: 100px; height: 100px;">  --}}
                  <h1>{{ env('APP_NAME') }}</h1>
                </a>
            </div>
            <div class="login-main"> 
              <form method="POST" action="{{ route('login') }}" class="theme-form">
                  @csrf

                  <h2 class="text-center">Sign in to account</h2>
                  <p class="text-center">Enter your email & password to login</p>

                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif

                  @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul class="mb-0">
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif

                  <div class="form-group">
                      <label class="col-form-label">Email Address</label>
                      <input class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="test@gmail.com">
                  </div>

                  <div class="form-group">
                      <label class="col-form-label">Password</label>
                      <div class="form-input position-relative">
                          <input class="form-control" type="password" name="password" required placeholder="*********">
                          <div class="show-hide" onclick="togglePassword(this)"><span class="show"></span></div>
                      </div>
                  </div>

                  <div class="form-group mb-0 checkbox-checked">
                      <div class="form-check checkbox-solid-info">
                          <input class="form-check-input" id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                          <label class="form-check-label" for="remember">Remember me</label>
                      </div>
                      {{-- Optional forgot password link --}}
                      {{-- <a class="link float-end" href="{{ route('password.request') }}">Forgot password?</a> --}}
                  </div>

                  <div class="form-group mt-3">
                      <button class="btn btn-primary btn-block w-100" type="submit">Sign in</button>
                  </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- jquery-->
    <script src="{{ url('/admin/assets') }}/js/vendors/jquery/jquery.min.js"></script>
    <!-- bootstrap js-->
    <script src="{{ url('/admin/assets') }}/js/vendors/bootstrap/dist/js/bootstrap.bundle.min.js" defer=""></script>
    <script src="{{ url('/admin/assets') }}/js/vendors/bootstrap/dist/js/popper.min.js" defer=""></script>
    <!--fontawesome-->
    <script src="{{ url('/admin/assets') }}/js/vendors/font-awesome/fontawesome-min.js"></script>
    <!-- password_show-->
    {{--  <script src="{{ url('/admin/assets') }}/js/password.js"></script>  --}}
    <!-- custom script -->
    <script src="{{ url('/admin/assets') }}/js/script.js"></script>
    <script>
        function togglePassword(el) {
            const input = el.closest('.form-input').querySelector('input');
            if (input.type === 'password') {
                input.type = 'text';
                el.classList.add('active');
            } else {
                input.type = 'password';
                el.classList.remove('active');
            }
        }
    </script>
  
</div>
@endsection
