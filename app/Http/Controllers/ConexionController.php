<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conexion;

class ConexionController extends Controller
{
    public function registrar(Request $request){
		$ruta = new Conexion();
		
		return $request;
	}
}
