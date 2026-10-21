<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaludoController extends Controller
{
    public function index()
    {
        $mensaje = 'Hola, este saludo viene del SaludoController';
        return view('saludo', ['mensaje' => $mensaje]);
    }
}