<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruta;

class RutasController extends Controller {
    
	public function index(){
		return view('RegistroRutas/index');
	}


	public function cargarRutas(){
		$ruta = Ruta::get();

		$data = [

			'estado' => true,
			'ruta' => $ruta
		];

		return response()->json($data);
	}

	public function guardar_ruta(Request $request){
		$ruta = new Ruta();
		$ruta->user_id = 1;
		$ruta->nombre_ruta = $request->input('rutas');
		$ruta->save();

		return response()->json($ruta);
	}
    
}
