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
        $conexion->ruta_id = $request->input('id_ruta');
        $conexion->save();

        $data = [
                    'status' => true,
                    'conexion' => $conexion,
                ];

        return response()->json($data);
	}


	public function cargarConexiones(){
        $conexion = Conexione::get();
        $data = [
            'estado' => true,
            'conexion' => $conexion 
        ];

        return response()->json($data);
    }
	

    public function editarConexion(Request $request){
        $conexion = Conexione::find( $request->input('conexionId') );
        
        $conexion->ubicacion1 = $request->input('conexionUbicacion1');
        $conexion->ubicacion2 = $request->input('conexionUbicacion2');
        $conexion->peso = $request->input('conexionPeso');
        $conexion->save();

        $data = [
                    'status' => true,
                    'conexion' => $conexion,
                ];

        return response()->json($data);
    }
}
