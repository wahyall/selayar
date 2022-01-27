@extends('public.layouts.main')

@section('navbar')
  @include('public.partials.navbar')
@endsection

@section('main')
  <section class="movies-list">
    <div class="container">
      <div class="row mb-5">
        <form class="search-movies" action="/movies" method="get">
          <div class="dropdown">
            <button class="btn dropdown-toggle rounded-0" type="button" data-toggle="dropdown">
              Genre: All
            </button>
            <div class="dropdown-menu">
              <div class="dropdown-item">
                <input type="radio" name="genre" id="all" value="" {{ request('genre') === '' ? 'checked' : null }}>
                <label for="all">All</label>
              </div>
              <div class="dropdown-item">
                <input type="radio" name="genre" id="scifi" value="scifi" {{ request('genre') === 'scifi' ? 'checked' : null }}>
                <label for="scifi">Sci-fi</label>
              </div>
              <div class="dropdown-item">
                <input type="radio" name="genre" id="action" value="action" {{ request('genre') === 'action' ? 'checked' : null }}>
                <label for="action">Action</label>
              </div>
              <div class="dropdown-item">
                <input type="radio" name="genre" id="comedy" value="comedy" {{ request('genre') === 'comedy' ? 'checked' : null }}>
                <label for="comedy">Comedy</label>
              </div>
              <div class="dropdown-item">
                <input type="radio" name="genre" id="romance" value="romance" {{ request('genre') === 'romance' ? 'checked' : null }}>
                <label for="romance">Romance</label>
              </div>
              <div class="dropdown-item">
                <input type="radio" name="genre" id="adventure" value="adventure" {{ request('genre') === 'adventure' ? 'checked' : null }}>
                <label for="adventure">Adventure</label>
              </div>
              <div class="dropdown-item">
                <input type="radio" name="genre" id="fantasy" value="fantasy" {{ request('genre') === 'fantasy' ? 'checked' : null }}>
                <label for="fantasy">Fantasy</label>
              </div>
            </div>
          </div>
          <input type="text" name="search" placeholder="Masukkan judul film..." autocomplete="off" value="{{ request('search') }}">
          <button type="submit">Cari</button>
        </form>
      </div>
      <div class="row mb-3">
        <h5>Hasil pencarian untuk {{ request('search') }} :</h5>
      </div>
      <div class="row">
        @foreach ($results as $movie)
          <div class="col-lg-3 col-md-4 col-sm-6 mb-5">
            <div class="card border-0">
              <div class="cover">
                <img src="{{ env('APP_URL') . '/storage/covers/' . $movie->cover }}" class="card-img-top">
                <h6 class="duration px-3 py-2">{{ $movie->duration }} min</h6>
                <div class="genre">
                  <a href="/movies?genre={{ $movie->genres->first()->slug }}">{{ $movie->genres->first()->name }}</a>
                </div>
              </div>
              <div class="card-body px-0">
                <a href="/movie/{{ $movie->id }}">
                  <h5 class="card-title">{{ $movie->title }}</h5>
                  <div class="d-flex justify-content-between align-items-center mt-3">
                    <h6 class="release-date mb-0">{{ $movie->release_date }}</h6>
                    <div class="rating">
                      <i class="fas fa-star"></i>
                      <h6 class="mb-0 d-inline-block">{{ number_format((float)$movie->rating, 1, '.', '') }}</h6>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="row mb-5">
        {{ $results->links('public.partials.pagination', ['paginator' => $results]) }}
      </div>
    </div>
  </section>
@endsection

@section('script')
  <script>
    document.querySelector('form.search-movies .dropdown-toggle').innerText = 'Genre: ' + document.querySelector(`.dropdown-item input[value="{{ request('genre') }}"]`).nextElementSibling.innerText
    document.querySelectorAll('form.search-movies .dropdown-item').forEach(item => {
      item.addEventListener('click', function () {
        this.firstElementChild.checked = true
        document.querySelector('form.search-movies .dropdown-toggle').innerText = `Genre: ${this.lastElementChild.innerText}`
      })
    })
  </script>
@endsection