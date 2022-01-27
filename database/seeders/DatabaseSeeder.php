<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\MovieGenre;

class DatabaseSeeder extends Seeder {
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run() {
    User::factory(5)->create();
    Movie::factory(20)->create();
    // MovieGenre::factory(20)->create();

    for ($i = 1; $i <= 20; $i++) {
      MovieGenre::create([
        'movie_id' => $i,
        'genre_id' => mt_rand(1, 6)
      ]);
    }

    Genre::create([
      'name' => 'Sci-fi',
      'slug' => 'scifi'
    ]);

    Genre::create([
      'name' => 'Action',
      'slug' => 'action'
    ]);

    Genre::create([
      'name' => 'Comedy',
      'slug' => 'comedy'
    ]);

    Genre::create([
      'name' => 'Romance',
      'slug' => 'romance'
    ]);

    Genre::create([
      'name' => 'Adventure',
      'slug' => 'adventure'
    ]);

    Genre::create([
      'name' => 'Fantasy',
      'slug' => 'fantasy'
    ]);
  }
}
