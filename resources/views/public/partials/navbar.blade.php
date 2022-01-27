<nav class="navbar static-top">
  <div class="container">
    <a class="navbar-brand" href="/">SELAYAR</a>
    <div class="navbar-expand static-top">
      @auth
        <ul class="navbar-nav topbar ml-auto">
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="mr-2 d-none d-lg-inline text-white">{{ auth()->user()->name }}</span>
              <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
              <a href="/user" class="dropdown-item">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
              </a>
              @can('admin')
                <a href="/admin" class="dropdown-item">
                  <i class="fas fa-table fa-sm fa-fw mr-2 text-gray-400"></i>
                  Admin
                </a>
              @endcan
              <div class="dropdown-divider"></div>
              <form action="/user/logout" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </button>
              </form>
            </div>
          </li>
        </ul>
      @else
        <ul class="navbar-nav ms-auto d-flex flex-row">
          <li class="nav-item">
            <a class="login nav-link px-3 py-2" href="/user/login">Login</a>
          </li>
          <li class="nav-item">
            <a class="signup nav-link px-3 py-2" href="/user/signup">Signup</a>
          </li>
        </ul>
      @endauth
    </div>
  </div>
</nav>