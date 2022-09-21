<?php

namespace App\Http\Controllers;

use App\Models\User as ModelsUser;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Inertia\Inertia;

class user extends Controller
{
    //
    public function index()
    {
        $usuarios = ModelsUser::all();
        return Inertia::render('Inversionistas/registroUsers',['usuarios' => $usuarios]);
    }

    public function store(Request $request)
    {
        ModelsUser::create(
            $request->validate([
                'name' => ['required', 'max:50'],
                'email' => ['required', 'max:50'],
                'password' =>['required', 'max:50'],
                'rol' =>['required', 'max:50']
            ])
        );
        return  redirect()->back();
    }
}


