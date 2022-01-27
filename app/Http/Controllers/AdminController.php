<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class AdminController extends Controller {
  public function index() {
    return view('admin.index', [
      'title' => 'Selayar Admin\'s Dashboard',
      'movies' => Movie::all()
    ]);
  }

  public function create() {
    return view('admin.create', [
      'title' => 'Add New Movie - Selayar Admin\'s Dashboard'
    ]);
  }

  public function edit(Movie $movie) {
    return view('admin.update', [
      'title' => 'Edit Movie - Selayar Admin\'s Dashboard',
      'movie' => $movie
    ]);
  }

  public function login() {
    return view('admin.login', [
      'title' => 'Login - Selayar Admin\'s Dashboard'
    ]);
  }
}
