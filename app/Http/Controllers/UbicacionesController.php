<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubicacione;

class UbicacionesController extends Controller
{
    public function registrar_ubicaciones(Request $request){

        $antecedente = Ubicacione::where("ruta_id", "=", $request->input('id_ruta'))
                                   ->where("nombre", "=", $request->input('nombre_ruta'))
                                   ->first();

        if ($antecedente==null) {
            $ubicacion = new Ubicacione();
            $ubicacion->ruta_id = $request->input('id_ruta');
            $ubicacion->posX = $request->input('posX');
            $ubicacion->posY = $request->input('posY');
            $ubicacion->nombre = $request->input('nombre_ruta');
            $ubicacion->save();

            $data = [
                        'status' => true,
                        'ubicacion' => $ubicacion,
                    ];
        }else{
            $data = [
                        'status' => false
                    ];
        }


        return response()->json($data);
    }

    public function Editar_ubicaciones(Request $request){
        $ubicacion = Ubicacione::find( $request->input('ubicacion_id') );
        
        $ubicacion->posX = $request->input('posX');
        $ubicacion->posY = $request->input('posY');
        $ubicacion->nombre = $request->input('nombre_ubicacion');
        $ubicacion->save();

        $data = [
                    'status' => true,
                    'ubicacion' => $ubicacion,
                ];

        return response()->json($data);
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
