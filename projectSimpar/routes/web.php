<?php

use Illuminate\Support\Facades\Route;
use \App\Models\Artist;
use App\Http\Controllers\ArtistsController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\LanguageController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/login',"login")->name("login");

Route::view('/register',"register")->name("register");

Route::view('/private',"private")->middleware('auth')->name("private");

#Validar Registro
Route::post("/validate-register", [LoginController::class,'register'])
    ->name("validate-register");

#Iniciar Sesion
Route::post("/login-sesion", [LoginController::class,'login'])
    ->name("login-sesion");

#Salir de Sesion
Route::post("/logout", [LoginController::class,'logout'])
    ->name("logout");

# Cuando se solicita la url /, es decir, la raíz
Route::get('/', [ArtistsController::class, 'index'])->middleware('auth')
    ->name("inicio");

# Cuando se solicita la url /, es decir, la raíz
Route::get('/private-artist', [ArtistsController::class, 'privateArtistView'])->middleware('auth')
    ->name("private_artist");

# Mostrar el formulario para agregar
Route::view("/agregar", "nuevo_artista")
    ->name("formAgregar");

# Cuando se envía el formulario y se debe guardar la canción
Route::post("/agregar", [ArtistsController::class,'createNewArtist'])
    ->name("createNewArtist");

# Cuando se guardan los cambios en la base de datos
Route::post("/updateArtist", [ArtistsController::class,'updateArtist'])
    ->name("updateArtist");

# Mostrar el formulario para editar la canción, algo como editar/1
Route::get("/editar/{id}", [ArtistsController::class,'editarArtista'])
    ->name("editarArtista");

Route::post("/updateAlbum", [AlbumController::class,'updateAlbum'])
    ->name("updateAlbum");

# Mostrar el formulario para editar la canción, algo como editar/1
Route::get("/editarAlbum/{id}", [AlbumController::class,'editarAlbum'])
    ->name("editarAlbum");

# URL que es llamada para eliminar canción, algo como eliminar/1
Route::get("/eliminar/{id}", [ArtistsController::class,'eliminarArtista'])
    ->name("eliminarArtista");

Route::get("/eliminarAlbum/{id}", [AlbumController::class,'eliminarAlbum'])
    ->name("eliminarAlbum");

Route::delete("/eliminarCanción/{id}", [SongController::class,'deleteSong'])
    ->name("deleteSong");

Route::get("/ver/{id}", [ArtistsController::class,'verArtista'])
    ->name("verArtista");

Route::get("/verTodosArtista", [ArtistsController::class,'verTodosArtista'])
    ->name("verTodosArtista");

Route::get("/verAlbum/{id}",[AlbumController::class, 'verAlbum'])
    ->name("verAlbum");

Route::get("/verTodosAlbum", [AlbumController::class,'verTodosAlbum'])
    ->name("verTodosAlbum");

Route::get("/verCancionesPorGenero/{id}",[SongController::class, 'verCancionesPorGenero'])
    ->name("verCancionesPorGenero");

Route::view("/agregarAlbum/{artist}", "nuevo_album")
    ->name("formAgregarAlbum");

# Cuando se envía el formulario y se debe guardar la canción
Route::post("/agregarAlbum", [AlbumController::class,'agregarAlbum'])
    ->name("agregarAlbum");

# Cuando se guardan los cambios en la base de datos
Route::post("/guardarCambiosAlbum", [AlbumController::class,'guardarCambiosDeAlbum'])
    ->name("guardarCambiosDeAlbum");

# Cuando se envía el formulario y se debe guardar la canción
Route::post("/addSong", [SongController::class,'addSong'])
    ->name("addSong");

Route::get("/eliminarCanción/{id}", [SongController::class,'deleteSong'])
    ->name("deleteSong");

#idiomas
Route::post("/change-language", [LanguageController::class,'change'])
    ->name("languageChange");

