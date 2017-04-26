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
    return view('layouts.paginas.index');
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
Route::post ('/autenticar', 'UsuariosController@autenticar');

/**
 * Búsqueda de artículos, juegos, usuarios...
 */
Route::get ('/busqueda/{tipo}/{tag}', 'ArticulosController@mostrarBusqueda');

/**
 * Página para mostrar un artículo / review / avance...
 */
Route::get('articulo/{id}/{nombre}', 'ArticulosController@mostrarArticulo');
Route::get('articulo/{id}', 'ArticulosController@mostrarArticuloDos');
Route::post ('articulo/{id}/add-comentario', 'ComentariosController@store')->middleware('auth');

Route::get('noticias', 'ArticulosController@mostrarNoticias');
Route::get('noticias/a-z', 'ArticulosController@mostrarNoticiasAZ');

Route::get('/analisis', function () {
    return view('layouts.paginas.analisis');
});

/**
 * Página para mostrar un juego...
 */
Route::get('juego/{id}/{titulo}', 'JuegosController@mostrarJuego');
Route::get('juego/{id}', 'JuegosController@mostrarJuegoDos');
//Mostrar análisis
Route::get('juego/{id}/{titulo}/analisis', 'JuegosController@mostrarAnalisis');
Route::get('juego/{id}/{titulo}/noticias', 'JuegosController@mostrarNoticias');

/**
 * Página para mostrar una categoría/plataforma
 */
Route::get('categoria/{alias}', 'CategoriasController@mostrarCategoria');
Route::get('plataforma/{alias}', 'CategoriasController@mostrarPlataforma');

Route::get('categoria/{alias}/{orden}', 'CategoriasController@mostrarCategoriaAZ');
Route::get('plataforma/{alias}/{orden}', 'CategoriasController@mostrarPlataformaAZ');

/**
 * USUARIOS
 */
Route::get('usuario/{nombre}', 'UsuariosController@mostrarUsuario');
Route::get('confirmar_email/{id}/{token}', 'UsuariosController@confirmarEmail');

Route::get('usuario/{nombre}/editar', 'UsuariosController@mostrarEditarPerfilUsuario')->middleware('auth');
Route::post('usuario/{nombre}/editar/guardar-privacidad', 'Privacidad_usuariosController@actualizar');
Route::post('usuario/{nombre}/editar/guardar-info', 'UsuariosController@actualizarInfo');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes();

/**
 * FOROS
 */
Route::get('foro/{id}', 'ForosController@mostrarForo');
Route::get('plataforma/{alias}/foro', 'ForosController@mostrarForoCategoria');
Route::get('juego/{id}/foro', 'ForosController@mostrarForoJuego');

Route::get('foro/{foro_id}/{tema_id}', 'ForosTemasController@mostrarTema');

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

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
