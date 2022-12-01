<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register (Request $request){
        $validatedata = $request->validate([
            'email' => 'required',
            'name' => 'required',
            'password' => 'required'
        ]);

        $validatedata['password'] = bcrypt($validatedata['password']);

        User::create($validatedata);

        return back()->with('berhasil', 'Register Berhasil');
    }
}
