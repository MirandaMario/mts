<?php

namespace App\Http\Controllers;

use App\Persona;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function verify($code)
    {
        $user = Persona::where('confirmation_code', $code)->first();

        if (!$user) {
            return redirect('/');
        }

        $user->confirmed = true;
        $user->confirmation_code = null;
        $user->save();

        return Redirect::to('./')->with('success', 'Has confirmado correctamente tu correo!');
    }
}
