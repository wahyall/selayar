<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory {
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition() {
    return [
      'title' => $this->faker->name() . ' The Movie',
      'duration' => mt_rand(60, 180),
      'release_date' => $this->faker->date('j F Y'),
      'rating' => mt_rand(1, 10),
      'director' => $this->faker->name(),
      'synopsis' => $this->faker->paragraph(4),
      'trailer' => 'https://youtu.be/dQw4w9WgXcQ',
      'cover' => 'placeholder.jpg'
    ];
  }
}
