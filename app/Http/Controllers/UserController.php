<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $usuarios= User::all();
        return $usuarios;
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
           DB::beginTransaction();
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            // $user->usuarioTipo = $request->usuarioTipo;
            $user->usuarioTipo = 'Admin';
            $user->condicion = '1';
            $user->save();
           DB::commit();
        }catch ( Exception $e){

        }
        
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $user = User::findOrFail($request->id);
             $user->name = $request->name;
             $user->email = $request->email;
             $user->password = bcrypt($request->password);
            //  $user->usuarioTipo = $request->usuarioTipo;
            $user->usuarioTipo = 'Admin';
             $user->condicion = '1';
             $user->save();
            DB::commit();
         }catch ( Exception $e){
 
         }
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $user = User::findOrFail($request->id);
        $user->condicion = '0';
        $user->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $user = User::findOrFail($request->id);
        $user->condicion = '1';
        $user->save();
    }
}
