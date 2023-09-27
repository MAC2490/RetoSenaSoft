<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CargaDatosController extends Controller {
    
	public function index(){
		return view('CargaDatos/index');
	}

}
