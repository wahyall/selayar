@extends('public.layouts.main')

@section('navbar')
  @include('public.partials.navbar')
@endsection

@section('main')
  <div class="container movies-list">
    <div class="row mb-3">
      @foreach ($user->favorites as $movie)
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
  </div>
@endsection

@section('script')
  <script>
    const baseUrl = '{{ env('APP_URL') }}';
    
    function favorite(movieId) {
      const favBtn = $(`.favorite[data-movie-id="${movieId}"]`);
      let endpoint, icon;
      if (favBtn.hasClass('fill')) {
        endpoint = `/api/favorite/{{ $user->id }}?_method=PUT`;
        icon = `<i class="far fa-heart"></i>`;
      } else {
        endpoint = `/api/favorite/{{ $user->id }}`;
        icon = `<i class="fas fa-heart"></i>`;
      }

      const formData = new FormData();
      formData.append('movie_id', movieId);
      $.ajax({
        url: baseUrl + endpoint,
        method: 'post',
        data: formData,
        contentType: false,
        processData: false
      }).then(() => {
        favBtn.toggleClass('fill');
        favBtn.html(icon);
      });
    }
  </script>
@endsection