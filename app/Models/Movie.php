<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Genre;

class Movie extends Model {
  use HasFactory;

  protected $guarded = ['id'];
  protected $with = ['favoritedBy', 'genres'];

  public function scopeFilter($query, array $filters) {
    $query->when($filters['search'] ?? false, function ($query, $search) {
      $query->where('title', 'LIKE', "%{$search}%")
        ->orWhere('synopsis', 'LIKE', "%{$search}%");
    });

    $query->when($filters['genre'] ?? false, function ($query, $genre) {
      $query->whereHas('genres', function ($query) use ($genre) {
        $query->where('slug', $genre);
      });
    });
  }

  public function favoritedBy() {
    return $this->belongsToMany(User::class, 'favorites');
  }

  public function genres() {
    return $this->belongsToMany(Genre::class, 'movie_genres');
  }
}
