@extends('public.layouts.main')

@section('main')
  <div class="container d-flex align-items-center justify-content-center" style="height: 100vh">
    <div class="card o-hidden border-0 shadow-lg" style="width: 500px">
      <div class="card-body p-0">
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Get In to Your Account!</h1>
              </div>
              @error('loginError')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{ $message }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @enderror
              <form class="user" action="/user/login" method="post">
                @csrf
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" autocomplete="off" required>
                </div>
                <div class="form-group row">
                  <div class="mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" required>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" name="login" class="btn btn-primary btn-user btn-block fs-6">
                    Login
                  </button>
                </div>
                <div>
                  <span class="text-secondary">Don't have an Account?</span> <a class="text-primary" href="/user/signup">Create Account</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection