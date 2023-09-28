<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubicacione;

class UbicacionesController extends Controller
{
    public function registrar_ubicaciones(Request $request){
        $ubicacion = new Ubicacione();
        $ubicacion->ruta_id = $request->input('id_ruta');
        $ubicacion->posX = $request->input('posX');
        $ubicacion->posY = $request->input('posY');
        $ubicacion->nombre = $request->input('nombre_ruta');
        $ubicacion->save();

        return response()->json($ubicacion);
    }

    public function cargarUbicaciones(){

        $ubicacion = Ubicacione::get();
        $data = [
            'estado' => true,
            'ubicacion' => $ubicacion
        ];

        return response()->json($data);
    }
}
