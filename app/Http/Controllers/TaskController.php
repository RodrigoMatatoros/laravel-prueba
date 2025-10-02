<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function registrar(Request $request){
        $valores = $request->validate([
            'name'=>['required', Rule::unique('users','name')],
            'email'=>'required',
            'password'=>'required'
        ]);
        $valores['password']= bcrypt($valores['password']);
        $user = User::create($valores);
        auth()->login();

        return redirect('/');
    }
}
