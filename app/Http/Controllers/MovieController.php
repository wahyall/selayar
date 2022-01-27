<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieGenre;
use Illuminate\Http\Request;

class MovieController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    return ['data' => Movie::all()];
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    if (is_null($request->cover)) {
      return 0;
    }

    $filename = str_replace(' ', '-', strtolower($request->title . ' ' . $request->release_date)) . '.' . $request->cover->getClientOriginalExtension();
    $request->cover->storeAs('covers', $filename, 'public');
    $request->request->add(['cover' => $filename]);

    $response = Movie::create($request->post());
    collect($request->genres)->map(function ($item) use ($response) {
      return MovieGenre::create([
        'movie_id' => $response->id,
        'genre_id' => $item
      ]);
    });
    return $response;
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Movie  $movie
   * @return \Illuminate\Http\Response
   */
  public function show(Movie $movie) {
    return $movie;
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Movie  $movie
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Movie $movie) {
    $filename = null;
    if (is_null($request->cover)) {
      $filename = $request->current_cover;
    } else {
      $filename = str_replace(' ', '-', strtolower($request->title . ' ' . $request->release_date)) . '.' . $request->cover->getClientOriginalExtension();
      $request->cover->storeAs('covers', $filename, 'public');
    }

    $request->request->add(['cover' => $filename]);
    $response = $movie->update($request->post());

    MovieGenre::query()
      ->where('movie_id', $request->id)
      ->delete();
    collect($request->genres)->map(function ($item) use ($request) {
      return MovieGenre::create([
        'movie_id' => $request->id,
        'genre_id' => $item
      ]);
    });
    return $response;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Movie  $movie
   * @return \Illuminate\Http\Response
   */
  public function destroy(Movie $movie) {
    return $movie->delete();
  }
}
