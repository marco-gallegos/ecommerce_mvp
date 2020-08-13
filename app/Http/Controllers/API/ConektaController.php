<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConektaController extends Controller
{
    public function llavepublica(){
        $data = [
            'llave' => env('CONEKTA_PUBLIC_KEY','no hay crack')
        ];
        return response()->json($data, 200);
    }
}
