<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Models\Favorite;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//   return $request->user();
// });

Route::resource('movie', MovieController::class, ['except' => ['create', 'edit']])->middleware(['auth:sanctum', 'auth.admin']);

// Favorite api routes
Route::middleware(['auth:sanctum'])->group(function () {
  Route::post('favorite/{movie}', function (Request $request, $movie) {
    if (Favorite::where('user_id', $request->user()->id)->where('movie_id', $movie)->get()->isNotEmpty()) {
      return 0;
    }

    return Favorite::create([
      'user_id' => $request->user()->id,
      'movie_id' => $movie
    ]);
  });

  Route::get('favorite', function (Request $request) {
    return $request->user()->favorites;
  });

  Route::delete('favorite/{movie}', function (Request $request, $movie) {
    return $request->user()->favorites->find($movie)->pivot->delete();
  });
});
