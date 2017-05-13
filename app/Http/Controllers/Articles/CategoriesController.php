<?php
/**
 *  ____  _             _     _ _
 * |  _ \| | __ _ _   _| |__ (_) |_   ___  ___
 * | |_) | |/ _` | | | | '_ \| | __| / _ \/ __|
 * |  __/| | (_| | |_| | |_) | | |_ |  __/\__ \
 * |_|   |_|\__,_|\__, |_.__/|_|\__(_)___||___/
 *                |___/
 *
 * TODOS LOS DERECHOS RESERVADOS ÁLVARO PESO GARCÍA
 * WWW.PLAYBIT.ES
 * CONTACTO@PLAYBIT.ES
 * ALVARO.PESO@PLAYBIT.ES
 * @PlaybitES
 * 2017
 *
 */

namespace App\Http\Controllers;


use App\Article;
use App\Category;
use App\Exceptions\CategoriaNoEncontradaException;
use Illuminate\Routing\Controller;
use DB;

class CategoriesController extends Controller
{
    /**
     * Recibe el alias de la categoria/plataforma, si es una plataforma redirige a /plataforma/alias y si no lo es
     * muestra todos los artículos de la categoría ordenados por fecha
     * @param $alias de la categoría/plataforma
     * @return redirección a /plataforma/alias | vista con todos los artículos paginados de la categoría
     * @throws CategoriaNoEncontradaException si no encuentra la categoría asociada con el alias
     */
    public static function mostrarCategoria($alias)
    {
        //Obtener la categoría/plataforma a partir de su alias
        $categoria = Category::where('alias', $alias)->first();
        if (!$categoria) {
            throw new CategoriaNoEncontradaException;
        } else {
            if ($categoria->esplataforma == 1) {
                //Redirigir a /plataforma/alias
                return redirect("/plataforma/$alias");
            } else {
                //Obtener los artículos pertenecientes a esta categoría
                $cons = Article::whereRaw('id in (select cod_art from categorias_articulos where id_cat=' . $categoria->id . ')')
                    ->orderBy('id', 'desc')->paginate(9);
                return view('layouts.paginas.categoria', ['categoria' => $categoria, 'cons' => $cons]);
            }
        }
    }

    /**
     * Recibe el alias de la categoría/plataforma, si es una plataforma muestra todos los artículos de la misma ordenados
     * por fecha, si no lo es redirige a /categoria/alias
     * @param $alias de la categoría/plataforma
     * @return vista con todos los artículos paginados de la plataforma | redirección a /categoria/alias
     * @throws CategoriaNoEncontradaException si no encuentra la categoría asociada con el alias
     */
    public static function mostrarPlataforma($alias)
    {
        //Obtener la categoría/plataforma a partir de su alias
        $categoria = Category::where('alias', $alias)->first();
        if (!$categoria) {
            throw new CategoriaNoEncontradaException;
        } else {
            if ($categoria->esplataforma == 1) {
                //Obtener los artículos pertenecientes a esta plataforma
                $cons = Article::whereRaw('id in (select cod_art from categorias_articulos where id_cat=' . $categoria->id . ')')
                    ->orderBy('id', 'desc')->paginate(9);
                return view('layouts.paginas.categoria', ['categoria' => $categoria, 'cons' => $cons]);
            } else {
                //Redirigir a /categoria/alias
                return redirect("/categoria/$alias");
            }
        }
    }

    /**
     * Recibe el alias de la categoria/plataforma, si es una plataforma redirige a /plataforma/alias y si no lo es
     * muestra todos los artículos de la categoría ordenados por el parametro $orden
     * @param $alias de la categoría/plataforma
     * @param $orden orden de los artículos
     * @return redirección a /plataforma/alias | vista con todos los artículos paginados de la categoría
     * @throws CategoriaNoEncontradaException si no encuentra la categoría asociada con el alias
     */
    public static function mostrarPlataformaAZ($alias, $orden)
    {
        //Obtener la categoría/plataforma a partir de su alias
        $categoria = Category::where('alias', $alias)->first();
        if (!$categoria) {
            throw new CategoriaNoEncontradaException;
        } else {
            if ($categoria->esplataforma == 1) {
                if ($orden == "a-z") {
                    $cons = Article::whereRaw('id in (select cod_art from categorias_articulos where id_cat=' . $categoria->id . ')')->orderBy('titulo', 'asc')->paginate(9);
                }
                return view('layouts.paginas.categoria', ['categoria' => $categoria, 'cons' => $cons]);
            } else {
                return redirect("/categoria/$alias");
            }
        }
    }

    /**
     * Recibe el alias de la categoría/plataforma, si es una plataforma muestra todos los artículos de la misma ordenados
     * por titulo, si no lo es redirige a /categoria/alias
     * @param $alias de la categoría/plataforma
     * @param $orden orden de los artículos
     * @return vista con todos los artículos paginados de la plataforma | redirección a /categoria/alias
     * @throws CategoriaNoEncontradaException si no encuentra la categoría asociada con el alias
     */
    public static function mostrarCategoriaAZ($alias, $orden)
    {
        //Obtener la categoría/plataforma a partir de su alias
        $categoria = Category::where('alias', $alias)->first();
        if (!$categoria) {
            throw new CategoriaNoEncontradaException;
        } else {
            if ($categoria->esplataforma == 1) {
                return redirect("/plataforma/$alias/a-z");
            } else {
                if ($orden == "a-z") {
                    $cons = \App\Article::whereRaw('id in (select cod_art from categorias_articulos where id_cat=' . $categoria->id . ')')->orderBy('titulo', 'asc')->paginate(9);
                }
                return view('layouts.paginas.categoria', ['categoria' => $categoria, 'cons' => $cons]);
            }
        }
    }
}