@extends('public.layouts.main')

@section('navbar')
  @include('public.partials.navbar')
@endsection

@section('main')
  <!-- Jumbotron -->
  <header class="jumbotron m-0" style="background: transparent;">
    <div class="container">
      <div class="wrapper">
        <h1>Temukan berbagai informasi menarik Film favorit Anda.</h1>
        <h2>Mudah, Cepat, dan Nyaman.</h2>
        <h6>Cari Film favoritmu disini.</h6>
        <form class="search-movies" action="/movies" method="get">
          <div class="dropdown">
            <button class="btn dropdown-toggle rounded-0" type="button" data-toggle="dropdown">
              Genre: All
            </button>
            <div class="dropdown-menu">
              <div class="dropdown-item">
                <input type="radio" name="genre" id="all" value="">
                <label for="all">All</label>
              </div>
              <div class="dropdown-item">
                <input type="radio" name="genre" id="scifi" value="scifi">
                <label for="scifi">Sci-fi</label>
              </div>
              <div class="dropdown-item">
                <input type="radio" name="genre" id="action" value="action">
                <label for="action">Action</label>
              </div>
              <div class="dropdown-item">
                <input type="radio" name="genre" id="comedy" value="comedy">
                <label for="comedy">Comedy</label>
              </div>
              <div class="dropdown-item">
                <input type="radio" name="genre" id="romance" value="romance">
                <label for="romance">Romance</label>
              </div>
              <div class="dropdown-item">
                <input type="radio" name="genre" id="adventure" value="adventure">
                <label for="adventure">Adventure</label>
              </div>
              <div class="dropdown-item">
                <input type="radio" name="genre" id="fantasy" value="fantasy">
                <label for="fantasy">Fantasy</label>
              </div>
            </div>
          </div>
          <input type="text" name="search" placeholder="Masukkan judul film..." autocomplete="off">
          <button type="submit">Cari</button>
        </form>
      </div>
    </div>
  </header>
  <!-- End Jumbotron -->
@endsection

@section('script')
  <script>
    document.querySelectorAll('.search-movies .dropdown-item').forEach(item => {
      item.addEventListener('click', function () {
        this.firstElementChild.checked = true
        document.querySelector('form.search-movies .dropdown-toggle').innerText = `Genre: ${this.lastElementChild.innerText}`
      })
    })
  </script>
@endsection