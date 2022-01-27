<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Models\Movie;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Admin routes
Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth', 'auth.admin']);
Route::get('/admin/create', [AdminController::class, 'create'])->middleware(['auth', 'auth.admin']);
Route::get('/admin/edit/{movie}', [AdminController::class, 'edit'])->middleware(['auth', 'auth.admin']);
Route::get('/admin/login', [AdminController::class, 'login'])->middleware(['auth', 'auth.admin']);


// Public routes
Route::get('/', function () {
  return view('public.index', [
    'title' => 'Selayar - Dapatkan Informasi Menarik Seputar Film'
  ]);
});

Route::get('/movies', function () {
  return view('public.movies', [
    'title' => 'Movies',
    'user' => auth()->user(),
    'results' => Movie::filter(request(['search']))->filter(request(['genre']))
      ->orderBy('created_at', 'desc')
      ->paginate(10)->withQueryString()
  ]);
});

Route::get('/movie/{movie}', function (Movie $movie) {
  preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/", $movie->trailer, $matches);
  return view('public.detail', [
    'title' => $movie->title,
    'user' => auth()->user(),
    'movie' => $movie,
    'video_id' => $matches[1] ?? ''
  ]);
});

// User routes
Route::get('/user', [UserController::class, 'index'])->middleware('auth');

Route::get('/user/login', [UserController::class, 'login'])->name('user.login')->middleware('guest');
Route::post('/user/login', [UserController::class, 'auth']);

Route::get('/user/signup', [UserController::class, 'signup'])->middleware('guest');
Route::post('/user/signup', [UserController::class, 'store']);

Route::post('/user/logout', [UserController::class, 'logout'])->middleware('auth');
