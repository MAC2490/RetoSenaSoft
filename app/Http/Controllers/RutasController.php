<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruta;
use App\Models\Ubicacione;
use App\Models\Conexione;

class RutasController extends Controller {
    
	public function index(){
		return view('RegistroRutas/index');
	}


	public function cargarRutas(){
		$user_id = 1;
		$rutas = Ruta::where('user_id','=',$user_id)->get();
		$listaRutas = [];

		foreach ($rutas as $key => $value) {
			$ubicaciones = Ubicacione::where("ruta_id","=",$value->id)->get();
			$conexiones = Conexione::where("ruta_id","=",$value->id)->get();
			
			$temporal = [
							"id" => $value->id,
							"ubicaciones" => $ubicaciones,
							"conexiones" => $conexiones,
							"inicio" => "",
							"nombre_ruta" => $value->nombre_ruta,
						];

			array_push($listaRutas, $temporal);
		}

		$data = [
			'estado' => true,
			'listaRutas' => $listaRutas
		];

		return response()->json($data);
	}

	public function guardar_ruta(Request $request){
		$ruta = new Ruta();
		$ruta->user_id = 1;
		$ruta->nombre_ruta = $request->input('rutas');
		$ruta->save();


		
		$user_id = 1;
		$rutas = Ruta::where('user_id','=',$user_id)->get();
		$listaRutas = [];

		foreach ($rutas as $key => $value) {
			$ubicaciones = Ubicacione::where("ruta_id","=",$value->id)->get();
			$conexiones = Conexione::where("ruta_id","=",$value->id)->get();
			
			$temporal = [
							"id" => $value->id,
							"ubicaciones" => $ubicaciones,
							"conexiones" => $conexiones,
							"inicio" => "",
							"nombre_ruta" => $value->nombre_ruta,
						];

			array_push($listaRutas, $temporal);
		}

		$data = [
			'estado' => true,
			'listaRutas' => $listaRutas
		];

		return response()->json($data);
	}
    
}
