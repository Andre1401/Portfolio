@extends('layouts.auth')

@section('content')
<div class="register-box">
  <div class="register-logo">
    <a href="{{ url('/') }}">
        <img src="{{ url($setting->path_logo) }}" style="width: 128px; height: 128px;">
    </a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">

      <form action="{{ route('register') }}" method="post">
        @csrf
        <div class="row mb-3">
            <div class="col-6">
                <a href="{{ route('login') }}" class="btn btn-info btn-block">Login</a>
            </div>
            <div class="col-6">
                <a href="{{ route('register') }}" class="btn btn-info btn-block">Register</a>
            </div>
        </div>
        <div class="input-group mb-3">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Full name" name="name" required value="{{ old('name') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
            </div>
            @error('name')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" required value="{{ old('email') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('email')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required>
            <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Retype password" name="password_confirmation" required>
            <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password_confirmation')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="row">
          <div class="col-8"></div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
@endsection