<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estacion;

class EstacionController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        // $estaciones = Articulo::join('categorias', 'articulos.idcategoria', '=', 'categorias.id')
        // ->select('articulos.id', 'articulos.idcategoria', 'articulos.codigo', 'articulos.nombre', 
        // 'categorias.nombre as nombre_categoria', 'articulos.precio_venta', 'articulos.stock','articulos.descripcion', 'articulos.condicion');
        // return $estaciones;
        $estaciones = Estacion::join('cliente','estacion.idCompania','=','cliente.id')
            ->select('estacion.id','estacion.idCompania','cliente.compania','estacion.estacion','estacion.condicion')
            ->get();
            

        // $estaciones = Articulo::all();
        // return $estaciones;
        return  $estaciones;
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $estaciones = new Estacion();
        $estaciones->idCompania = $request->idCompania;
        $estaciones->estacion = $request->estacion;
        $estaciones->condicion = '1';
        $estaciones->save();
    }

   

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $estaciones = Estacion::findOrFail($request->id);
        $estaciones->idCompania = $request->idCompania;
        $estaciones->estacion = $request->estacion;
        $estaciones->condicion = '1';
        $estaciones->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $estaciones = Estacion::findOrFail($request->id);
        $estaciones->condicion = '0';
        $estaciones->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $estaciones = Estacion::findOrFail($request->id);
        $estaciones->condicion = '1';
        $estaciones->save();
    }

}
