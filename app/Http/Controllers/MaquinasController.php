<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maquinas;

class MaquinasController extends Controller
{
    //
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $maquina= Maquinas::all();
        return $maquina;
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $maquina = new Maquinas();
        $maquina->maquina = $request->maquina;
        $maquina->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $maquina = Maquinas::findOrFail($request->id);
        $maquina->maquina = $request->maquina;
        $maquina->save();
    }
}
