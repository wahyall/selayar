<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;

class Genre extends Model {
  use HasFactory;

  protected $guraded = ['id'];

  public function movies() {
    return $this->belongsToMany(Movie::class, 'movie_genres');
  }
}
