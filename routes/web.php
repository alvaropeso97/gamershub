<?php

/**
 *           ___                       _  _ _   _ ___
 *          / __|__ _ _ __  ___ _ _ __| || | | | | _ )
 *         | (_ / _` | '  \/ -_) '_(_-< __ | |_| | _ \
 *          \___\__,_|_|_|_\___|_| /__/_||_|\___/|___/
 *
 * TODOS LOS DERECHOS RESERVADOS, ÁLVARO PESO GARCÍA y GAMERSHUB
 *
 */

/**
 * Página principal
 */
Route::get('/', function () {
    return view('main.index');
});

Route::get('/videos', function () {
    return view('layouts.paginas.videos');
});

/**
 *  ACCESO DE USUARIOS
 */
Route::get('/login', function () {
    return view('layouts.paginas.login');
});
Route::post ('/autenticar', 'Users\UsersController@autenticar');

/**
 * Búsqueda de artículos, juegos, usuarios...
 */
Route::get ('/busqueda/{tipo}/{tag}', 'ArticlesController@mostrarBusqueda');

/**
 * Página para mostrar un artículo / review / avance...
 */
Route::get('articulo/{id}/{nombre}', 'Articles\ArticlesController@mostrarArticulo');
Route::get('articulo/{id}', 'Articles\ArticlesController@mostrarArticuloDos');
Route::post ('articulo/{id}/add-comentario', 'Articles\CommentsController@store')->middleware('auth');

Route::get('noticias', 'Articles\ArticlesController@mostrarNoticias');
Route::get('noticias/a-z', 'Articles\ArticlesController@mostrarNoticiasAZ');

Route::get('/analisis', function () {
    return view('layouts.paginas.analisis');
});

/**
 * Página para mostrar un juego...
 */
Route::get('juego/{id}/{titulo}', 'Games\GamesController@mostrarJuego');
Route::get('juego/{id}', 'Games\GamesController@mostrarJuegoDos');
//Mostrar análisis
Route::get('juego/{id}/{titulo}/analisis', 'Games\GamesController@mostrarAnalisis');
Route::get('juego/{id}/{titulo}/noticias', 'Games\GamesController@mostrarNoticias');

/**
 * Página para mostrar una categoría/plataforma
 */
Route::get('categoria/{alias}', 'Articles\CategoriesController@mostrarCategoria');
Route::get('plataforma/{alias}', 'Articles\CategoriesController@mostrarPlataforma');

Route::get('categoria/{alias}/{orden}', 'Articles\CategoriesController@mostrarCategoriaAZ');
Route::get('plataforma/{alias}/{orden}', 'Articles\CategoriesController@mostrarPlataformaAZ');

/**
 * USUARIOS
 */
Route::get('usuario/{nombre}', 'UsersController@mostrarUsuario');
Route::get('confirmar_email/{id}/{token}', 'Users\UsersController@confirmarEmail');

Route::get('usuario/{nombre}/editar', 'UsersController@mostrarEditarPerfilUsuario')->middleware('auth');
Route::post('usuario/{nombre}/editar/guardar-privacidad', 'UsersPrivacyController@actualizar');
Route::post('usuario/{nombre}/editar/guardar-info', 'UsersController@actualizarInfo');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes();

/**
 * FOROS
 */
//Route::get('foro/{id}', 'ForumsController@mostrarForo');
//Route::get('plataforma/{alias}/foro', 'ForumsController@mostrarForoCategoria');
//Route::get('juego/{id}/foro', 'ForumsController@mostrarForoJuego');
//
//Route::get('foro/{foro_id}/{tema_id}', 'ForumsTopicsController@mostrarTema');

/**
 * PÁGINAS SIMPLES
 */
Route::get('/aviso-legal', function () {
    return view('layouts.paginas_simples.aviso_legal');
});
Route::get('/contacto', function () {
    return view('layouts.paginas_simples.contacto');
});
Route::get('/sobre-nosotros', function () {
    return view('layouts.paginas_simples.sobre-nosotros');
});