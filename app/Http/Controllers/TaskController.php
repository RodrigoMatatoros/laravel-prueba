<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
   
    public function create()
    {
        return view('create');
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }

    public function login(Request $request){
    $valores = $request->validate([
        'loginname' => 'required',
        'loginpassword' => 'required'
    ]);

    if(auth()->attempt(['name' => $valores['loginname'], 'password' => $valores['loginpassword']])){
        $request->session()->regenerate();
        return redirect('/create');
    }

    return back()->withErrors([
        'loginname' => 'Las credenciales no son correctas.',
    ]);
}


    public function registrar(Request $request){
        $valores = $request->validate([
            'name'=>['required', Rule::unique('users','name')],
            'email'=>'required',
            'password'=>'required'
        ]);
        $valores['password']= bcrypt($valores['password']);
        $user = User::create($valores);
        auth()->login($user);

        return redirect('/create');
    }
    
}
