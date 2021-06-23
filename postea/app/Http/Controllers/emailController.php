<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\email;
use Illuminate\Support\Facades\Mail;

class emailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function enviar (Request $request, $numero)
    {
        $user = $request->user();
        $correo = New email($user, $numero);
        Mail::to($user)->send($correo);
        return "se encio el correo";
    }
}
