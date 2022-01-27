<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title }}</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
  <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sb-admin-2.min.css') }}">
</head>

<body>

  <div class="bg-gradient-primary d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="container" style="max-width: 576px;">

      <!-- Outer Row -->
      <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <div class="col">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">Login Admin Setoko</h1>
                    </div>
                    <form class="user" action="" method="post">
                      <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" autocomplete="off">
                      </div>
                      <div class="form-group">
                        <div class="mb-3 mb-sm-0">
                          <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                        </div>
                      </div>
                      <button type="submit" name="login" class="btn btn-primary btn-user btn-block fs-6">
                        Login
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>

</html>