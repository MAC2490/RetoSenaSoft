<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RutasController extends Controller {
    
	public function index(){
		return view('RegistroRutas/index');
	}

	public function consultarDatosRutas(){
		#...
	}
}
