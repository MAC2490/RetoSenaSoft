<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruta;

class RutasController extends Controller {
    
	public function index(){
		return view('RegistroRutas/index');
	}


	public function consultarDatosRutas(){
		#...
	}

	public function guardar_ruta(Request $request){
		$ruta = new Ruta();
		$ruta->user_id = 1;
		$ruta->nombre_ruta = $request->input('rutas');
		$ruta->save();

		return response()->json($ruta);
	}
    
}
