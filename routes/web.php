<?php

use App\Http\Controllers\AtelierController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\RoutesController;
use App\Http\Controllers\RythmController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UsersController;
use App\Models\Atelier;
use App\Models\Music;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [RoutesController::class,'index'])->name('home');

Route::get('/login', [RoutesController::class,'login'])->name('login');

Route::get('/register', [RoutesController::class,'register'])->name('register');

Route::post('/authenticate', [AuthController::class,'authenticate'])->name('authenticate');

Route::get('/role-test', [RolesController::class,'test']);

Route::resource('role',RolesController::class);
Route::resource('user', UsersController::class);

Route::get('no-profile',[SessionController::class,'no_profile'])->name('no_profile');

Route::middleware(['auth','no_profile'])->prefix('dashboard')->group(function(){

    Route::get('/',[SessionController::class,'index'])->name('dashboard.index');

    Route::resources([
        'playlist' => PlaylistController::class,
        'music' => MusicController::class,
        'rythm' => RythmController::class,
        'atelier' => AtelierController::class,
    ]);

    Route::get('download-music/{music_id}',[MusicController::class,'download_music'])->name('music.download');

    Route::get('download-rythm/{rythm_id}',[MusicController::class,'download_rythm'])->name('rythm.download');

    Route::get('/logout', [AuthController::class,'logout'])->name('logout');

    // Playlist action

    Route::get('download-rythm/{rythm_id}',[RythmController::class,'download_rythm'])->name('rythm.download');

    Route::post('play-music',[MusicController::class,'play_music'])->name('music.play');

    Route::post('consult-playlist',[PlaylistController::class,'consult_playlist'])->name('playlist.consult');

    Route::get('playlist/explore/{playlist}',[PlaylistController::class,'explore'])->name('playlist.explore');

    Route::post('download-music-action',[MusicController::class,'download_action'])->name('music.download.action');

});

Route::middleware('auth')->prefix('dashboard')->group(function(){
    Route::post('user/set-profile', [UsersController::class,'set_profile'])->name('profile.set');
});
