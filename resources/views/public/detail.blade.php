@extends('public.layouts.main')

@section('navbar')
  @include('public.partials.navbar')
@endsection

@section('main')
  <section class="movie-detail">
    <div class="container row">
      <div class="col-lg-3">
        <div class="cover">
          <img src="{{ env('APP_URL') . '/storage/covers/' . $movie->cover }}" class="card-img-top">
          @if (auth()->check())
            @if ($movie->favoritedBy->contains($user->id))
              <a href="javascript:favorite({{ $movie->id }})" class="favorite fill" data-movie-id="{{ $movie->id }}">
                <i class="fas fa-heart"></i>
              </a>                    
            @else
              <a href="javascript:favorite({{ $movie->id }})" class="favorite" data-movie-id="{{ $movie->id }}">
                <i class="far fa-heart"></i>
              </a>
            @endif
          @endif
        </div>
        <div class="genres">
          @foreach ($movie->genres as $genre)
            <div class="item">
              <a href="/movies?genre={{ $genre->slug }}">{{ $genre->name }}</a>
            </div>
          @endforeach
        </div>
      </div>
      <div class="col-lg-9">
        <h1 class="m-0">{{ $movie->title }}</h1>
        <div class="director mb-2">
          <span>Directed by {{ $movie->director }}</span>
        </div>
        <div class="info">
          <span>{{ $movie->release_date }}</span>
          <div class="dot"></div>
          <span>{{ $movie->duration }} min</span>
          <div class="dot"></div>
          <span>{{ $movie->rating }} <i class="fas fa-star"></i></span>
        </div>
        <div class="trailer my-4">
          <lite-youtube videoid="{{ $video_id }}"></lite-youtube>
        </div>
        <div class="synopsis">
          <p>{{ $movie->synopsis }}</p>
        </div>
      </div>
    </div>
  </section>
@endsection

@if (auth()->check())
  @section('script')
    <script>
      const baseUrl = '{{ env('APP_URL') }}';
      function favorite(movieId) {
        const favBtn = $(`.favorite[data-movie-id="${movieId}"]`);
        let endpoint, icon, method;
        
        if (favBtn.hasClass('fill')) {
          endpoint = `/api/favorite/${movieId}`;
          icon = `<i class="far fa-heart"></i>`;
          method = 'delete';
        } else {
          endpoint = `/api/favorite/${movieId}`;
          icon = `<i class="fas fa-heart"></i>`;
          method = 'post';
        }

        const formData = new FormData();
        formData.append('movie_id', movieId);
        $.ajax({
          url: baseUrl + endpoint,
          method,
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
@endif