<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel​\​Sanctum​\​PersonalAccessToken;

App::setLocale('en');

class UserController extends Controller {
  public function index() {
    return view('public.user.index', [
      'title' => 'Profile: ' . auth()->user()->name,
      'user' => auth()->user()
    ]);
  }

  public function login() {
    return view('public.user.login', [
      'title' => 'Login - Selayar'
    ]);
  }

  public function signup() {
    return view('public.user.signup', [
      'title' => 'Signup - Selayar'
    ]);
  }

  public function auth(Request $request) {
    $credentials = $request->validate([
      'email' => ['required', 'email:dns'],
      'password' => ['required'],
    ]);

    if (!Auth::attempt($credentials)) {
      return back()->withErrors([
        'loginError' => 'Invalid username / password!',
      ]);
    }

    $request->session()->regenerate();
    $token = User::where('email', $credentials['email'])->firstOrFail()->createToken('auth_token');

    if ($request->api) {
      return response()->json($token, 200);
    }
    return redirect()->intended('/');
  }

  public function store(Request $request) {
    $validatedData = $request->validate([
      'name' => ['required'],
      'username' => ['required', 'unique:users', 'min:5'],
      'email' => ['required', 'email:dns', 'unique:users'],
      'password' => ['required', 'confirmed'],
    ]);

    $validatedData['password'] = bcrypt($validatedData['password']);

    User::create($validatedData);
    return redirect('/user/login');
  }

  public function logout(Request $request) {
    // Jika user logout dari API
    if ($token = $request->bearerToken()) {
      $accessToken = PersonalAccessToken::findToken($token);
      if ($accessToken) {
        return $accessToken->delete();
      }
      return response()->json(['error' => 'Unauthorized'], 401);
    }

    // Jika user logout langsung dari web (tanpa API)
    $request->user()->tokens()->delete();
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
  }
}
