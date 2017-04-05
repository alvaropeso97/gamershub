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
use Illuminate\View\View;

/**
 * Esta clase contiene lo necesario para mostrar, añadir, modificar o eliminar categorías o plataformas desde el
 * backend
 * Class CategoriasController
 * @package App\Http\Controllers\Backend
 */
class CategoriasController extends Controller
{
    /**
     * Almacena todas las categorías en la variable $categirias y las envía a la vista backend.categorias para
     * mostrarlas
     * @return View de backend.categorias
     */
    public function show() {
        $categorias = Categoria::all();
        return view('backend.categorias')->with(['categorias' => $categorias]);
    }

    /**
     * Recibe la información de un formulario y crea una nuevo registro en la base de datos (categorías)
     * @param Request $request datos del formulario
     * @return \Illuminate\Http\RedirectResponse página del backend de categorías con un mensaje de confirmación
     */
    public function store(Request $request) {
        $categoria = new Categoria();
        $categoria->nombre = $request->get('nombre');
        $categoria->color = $request->get('color');
        $categoria->alias = $request->get('alias');
        $categoria->esplataforma = $request->get('esplataforma');
        $categoria->save();
        return redirect('/backend/categorias')->with('mensaje', 'Categoría creada correctamente');
    }

    /**
     * Recibe la información de un formulario y actualiza un registro existente en la base de datos (categorías)
     * @param Request $request datos del formulario
     * @return \Illuminate\Http\RedirectResponse página del backend de categorías con un mensaje de confirmación
     */
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

    /**
     * Recibe la información de un formulario y elimina una categoría de la base de datos (categorías)
     * @param Request $request datos del formulario
     * @return \Illuminate\Http\RedirectResponse página del backend de categorías con un mensaje de confirmación
     */
    public function destroy(Request $request) {
        $id = $request->get('id');
        $categoria = Categoria::find($id);
        $categoria->delete();
        return redirect('/backend/categorias')->with('mensaje', 'Categoría/Plataforma eliminada correctamente');
    }

    /**
     * Muestra la vista de confirmación para proceder a eliminar una categoría en concreto
     * @param $id categoría a eliminar
     * @return vista backend.eliminar_categoria con información de la categoría
     */
    public function mostrarEliminarCategoria($id) {
        $categoria = Categoria::find($id);
        return view('backend.eliminar_categoria')->with(['categoria' => $categoria]);
    }

    /**
     * Muestra la vista que contiene un formulario para modificar una categoría en concreto
     * @param $id categoría a modificar
     * @return vista backend.modificar_categoria con información de la categoría
     */
    public function mostrarModificarCategoria($id) {
        $categoria = Categoria::find($id);
        return view('backend.modificar_categoria')->with(['categoria' => $categoria]);
    }
}