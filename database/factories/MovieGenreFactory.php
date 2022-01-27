<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MovieGenreFactory extends Factory {
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition() {
    return [
      'movie_id' => mt_rand(1, 20),
      'genre_id' => mt_rand(1, 5)
    ];
  }
}
