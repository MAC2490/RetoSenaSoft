<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conexione;

class ConexionController extends Controller
{
    public function registrar(Request $request){
		$conexion = new Conexione();
		$conexion->ubicacion1 = $request->input('ubicacion1');
		$conexion->ubicacion2 = $request->input('ubicacion2');
		$conexion->peso = $request->input('peso');
		$conexion->save();

		return response()->json($request);
	}


	public function cargarConexiones(){
        $conexion = Conexione::get();
        $data = [
            'estado' => true,
            'conexion' => $conexion 
        ];

        return response()->json($data);
    }
	
}
