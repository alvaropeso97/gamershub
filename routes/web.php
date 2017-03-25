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

Route::get('/test', function()
{
    $img = Image::make('http://img.gamershub.es/noticias/1484315979Packs.jpg')->resize(942, 530);

    return $img->response('jpg');
});
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

Route::get('usuario/{nombre}/editar', 'UsuariosController@mostrarEditarPerfilUsuario')->middleware('auth');
Route::post('usuario/{nombre}/editar/guardar-privacidad', 'Privacidad_usuariosController@actualizar');
Route::post('usuario/{nombre}/editar/guardar-info', 'UsuariosController@actualizarInfo');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes();

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

/**
 * RUTAS PARA LA ADMINISTRACIÓN
 */
Route::group(['middleware' => 'auth'], function()
{
    Route::group(['middleware' => 'App\Http\Middleware\ModeradorMiddleware'], function()
    {
    /* GESTIÓN DE USUARIOS */
    //Listar usuarios
    Route::get ('/panel/usuarios', 'UsuariosController@mostrarUsuarios');
    //Eliminar un usuario en concreto
    Route::get ('/panel/usuarios/eliminar/{id}', 'UsuariosController@eliminarUsuario');
    });
    //Modificar un usuario
    Route::get ('/panel/usuarios/editar-usuario/{id}', 'UsuariosController@mostrarEditarUsuario');
    //Actualizar al usuario en la base de datos
    Route::post ('/panel/usuarios/editar-usuario/{id}/modificar', 'UsuariosController@modificarUsuario');

    //Eliminar un comentario
    Route::get ('/articulo/{id}/{comentario}/eliminar', 'ComentariosController@destroy');

    Route::group(['middleware' => 'App\Http\Middleware\RedactorMiddleware'], function()

    {
    /* GESTIÓN DE ARTÍCULOS */
    //Listar artículos
    Route::get ('/panel/articulos', 'ArticulosController@mostrarArticulos');
    //Eliminar un artículo en concreto
    Route::get ('/panel/articulos/eliminar/{id}', 'ArticulosController@destroy');
    //Redactar nuevo artículo
    Route::get ('/panel/articulos/nuevo-articulo', 'ArticulosController@nuevoArticulo');
    //Modificar un artículo
    Route::get ('/panel/articulos/editar-articulo/{id}', 'ArticulosController@mostrarEditarArticulo');
    //Subir a la base de datos el artículo creado
    Route::post ('/panel/articulos/nuevo-articulo/add-not', 'ArticulosController@store');
    //Actualizar el artículo en la base de datos
    Route::post ('/panel/articulos/editar-articulo/{id}/modificar', 'ArticulosController@update');

    /* GESTIÓN DE JUEGOS */
    //Listar juegos
    Route::get('/panel/juegos', function () {
        return view('layouts.paginas.administracion.juegos');
    });
    //Eliminar un juego en concreto
    Route::get ('/panel/juegos/eliminar/{id}', 'JuegosController@eliminarJuego');
    //Redactar un nuevo juego
    Route::get ('/panel/juegos/nuevo-juego', 'JuegosController@nuevoJuego');
    //Subir a la base de datos el juego creado
    Route::post ('/panel/juegos/nuevo-juego/add-juego', 'JuegosController@store');
    //Modificar un juego
    Route::get ('/panel/juegos/editar-juego/{id}', 'JuegosController@mostrarEditarJuego');
    //Actualizar el juego en la base de datos
    Route::post ('/panel/juegos/editar-juego/{id}/modificar', 'JuegosController@modificarJuego');
});
});