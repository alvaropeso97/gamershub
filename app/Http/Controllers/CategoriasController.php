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

namespace App\Http\Controllers;


use App\Categoria;
use Illuminate\Routing\Controller;
use DB;

class CategoriasController extends Controller
{
    public static function mostrarCategoria($alias) {
        $categoria = DB::table('categorias')->where('alias', $alias)->first();
        if ($categoria->esplataforma == 1) {
            return redirect("/plataforma/$alias");
        } else {
            $cons =  \App\Articulo::whereRaw('id in (select cod_art from categorias_articulos where id_cat='.$categoria->id.')')->orderBy('id','desc')->paginate(9);
            return view('layouts.paginas.categoria', ['id' => Categoria::findOrFail($categoria->id), 'cons' => $cons]);
        }
    }

    public static function mostrarPlataforma($alias) {
        $categoria = DB::table('categorias')->where('alias', $alias)->first();
        if ($categoria->esplataforma == 1) {
            $cons =  \App\Articulo::whereRaw('id in (select cod_art from categorias_articulos where id_cat='.$categoria->id.')')->orderBy('id','desc')->paginate(9);
            return view('layouts.paginas.categoria', ['id' => Categoria::findOrFail($categoria->id), 'cons' => $cons]);
        } else {
            return redirect("/categoria/$alias");
        }
    }

    public static function mostrarPlataformaAZ($alias, $orden) {
        $categoria = DB::table('categorias')->where('alias', $alias)->first();
        if ($categoria->esplataforma == 1) {
            if ($orden == "a-z") {
                $cons =  \App\Articulo::whereRaw('id in (select cod_art from categorias_articulos where id_cat='.$categoria->id.')')->orderBy('titulo','asc')->paginate(9);
            }
            return view('layouts.paginas.categoria', ['id' => Categoria::findOrFail($categoria->id), 'cons' => $cons]);
        } else {
            return redirect("/categoria/$alias");
        }
    }

    public static function mostrarCategoriaAZ($alias, $orden) {
        $categoria = DB::table('categorias')->where('alias', $alias)->first();
        if ($categoria->esplataforma == 1) {
            return redirect("/plataforma/$alias/a-z");
        } else {
            if ($orden == "a-z") {
                $cons =  \App\Articulo::whereRaw('id in (select cod_art from categorias_articulos where id_cat='.$categoria->id.')')->orderBy('titulo','asc')->paginate(9);
            }
            return view('layouts.paginas.categoria', ['id' => Categoria::findOrFail($categoria->id), 'cons' => $cons]);
        }
    }

    public static function devolverIdCategorias ($id) {
        return $categorias = DB::select("select id from categorias where id in (select id_cat from categorias_articulos where cod_art=".$id.")");
    }
}