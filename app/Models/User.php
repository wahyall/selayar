<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Movie;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
  use HasFactory, HasApiTokens;

  protected $guarded = ['id'];

  protected $hidden = ['password'];

  public function favorites() {
    return $this->belongsToMany(Movie::class, 'favorites');
  }
}
