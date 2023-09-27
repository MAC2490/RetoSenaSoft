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
		
	}
    
}
