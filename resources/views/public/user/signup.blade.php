@extends('public.layouts.main')

@section('main')
  <div class="container d-flex align-items-center justify-content-center" style="height: 100vh">
    <div class="card o-hidden border-0 shadow-lg" style="width: 500px">
      <div class="card-body p-0">
        <div class="row">
          <div class="col">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" action="/user/signup" method="post">
                @csrf
                <div class="form-group row">
                  <div class="mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Full Name" autocomplete="off" required value="{{ old('name') }}">
                    @error('name')
                      <small class="form-text text-danger ms-1" style="font-size: 0.8rem">{{ $message }}</small>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <div class="mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username" autocomplete="off" required value="{{ old('username') }}">
                    @error('username')
                      <small class="form-text text-danger ms-1" style="font-size: 0.8rem">{{ $message }}</small>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email Address" autocomplete="off" required value="{{ old('email') }}">
                  @error('email')
                      <small class="form-text text-danger ms-1" style="font-size: 0.8rem">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user @error('email') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                  </div>
                  @error('password')
                    <small class="form-text text-danger ms-1" style="font-size: 0.8rem">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <button type="submit" name="signup" class="btn btn-primary btn-user btn-block fs-6">
                    Signup
                  </button>
                </div>
                <div>
                  <span class="text-secondary">Already have an Account?</span> <a class="text-primary" href="/user/login">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection