<?php

use App\Http\Controllers\commentsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\postsController;
use App\Models\User;


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

Route::get('posts', [postsController::class,'index'])
->name('posts.index')
->middleware('auth');
Route::get('posts/create',[postsController::class, 'create'])
->name('posts.create')
->middleware('auth');
Route::get('/posts/{post}', [postsController::class, 'show'])
->name('posts.show')
->middleware('auth');
Route::get('/posts/edit/{post}', [postsController::class, 'edit'])
->name('posts.edit')
->middleware('auth');
Route::post('posts', [postsController::class, 'store'])
->name('posts.store')
->middleware('auth');
Route::put('posts/{post}', [postsController::class, 'update'])
->name('posts.update')
->middleware('auth');
Route::delete('posts/{post}', [postsController::class, 'destroy'])
->name('posts.destroy')
->middleware('auth');
// Route::get('posts', [PostController::class, 'index'])->name('posts.index');


// Comments Routes
Route::get('/posts/{post}/comments', [commentsController::class, 'index'])
->name('posts.comment')
->middleware('auth');
Route::post('/posts/{post}/comments', [commentsController::class, 'store'])
->name('posts.comment.store')
->middleware('auth');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


use Laravel\Socialite\Facades\Socialite;
 
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('auth.github');
 
Route::get('/auth/callback', function () {
  $githubUser = Socialite::driver('github')->stateless()->user();
 
  $user = User::updateOrCreate([
    'email' => $githubUser->email,
  ], [
      'name' => $githubUser->name,
      'email' => $githubUser->email,
      'github_token' => $githubUser->token,
      'github_refresh_token' => $githubUser->refreshToken,
  ]);

  Auth::login($user);

  return redirect()->route('posts.index');
 
    // $user->token
});


Route::get('/auth/google/redirect', function () {
  return Socialite::driver('google')->redirect();
})->name('auth.google');

Route::get('/auth/google/callback', function () {
$googlehubUser = Socialite::driver('google')->stateless()->user();

$user = User::updateOrCreate([
  'email' => $googlehubUser->email,
], [
    'name' => $googlehubUser->name,
    'email' => $googlehubUser->email,
    'github_token' => $googlehubUser->token,
    'github_refresh_token' => $googlehubUser->refreshToken,
]);

Auth::login($user);

return redirect()->route('posts.index');

  // $user->token
});