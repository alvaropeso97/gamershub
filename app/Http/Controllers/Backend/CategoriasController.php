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

namespace App\Http\Controllers\Backend;

use App\Categoria;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function show() {
        $categorias = Categoria::all();
        return view('backend.categorias')->with(['categorias' => $categorias]);
    }

    public function store(Request $request) {
        $categoria = new Categoria();
        $categoria->nombre = $request->get('nombre');
        $categoria->color = $request->get('color');
        $categoria->alias = $request->get('alias');
        $categoria->esplataforma = $request->get('esplataforma');
        $categoria->save();
        return redirect('/backend/categorias')->with('mensaje', 'Categoría creada correctamente');
    }

    public function update(Request $request) {
        $id = $request->get('id');
        $categoria = Categoria::find($id);
        $categoria->nombre = $request->get('nombre');
        $categoria->color = $request->get('color');
        $categoria->alias = $request->get('alias');
        $categoria->esplataforma = $request->get('esplataforma');
        $categoria->save();
        return redirect('/backend/categorias/'.$id.'/modificar')->with('mensaje', 'Categoría modificada correctamente');
    }

    public function destroy(Request $request) {
        $id = $request->get('id');
        $categoria = Categoria::find($id);
        $categoria->delete();
        return redirect('/backend/categorias')->with('mensaje', 'Categoría/Plataforma eliminada correctamente');
    }

    public function mostrarEliminarCategoria($id) {
        $categoria = Categoria::find($id);
        return view('backend.eliminar_categoria')->with(['categoria' => $categoria]);
    }

    public function mostrarModificarCategoria($id) {
        $categoria = Categoria::find($id);
        return view('backend.modificar_categoria')->with(['categoria' => $categoria]);
    }
}