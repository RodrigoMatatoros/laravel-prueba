<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function login(Request $request){
        $valores = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);

        if(auth()->attempt(['name' => $valores['loginname'], 'password' => $valores['loginpassword']])){
            $request->session()->regenerate();
            return redirect('/principal');
        }

        return back()->withErrors([
            'loginname' => 'El usuario o la contraseña no es la correcta'
        ]);
    }
    public function registrar(Request $request){


        $valores = $request->validate([
            'name'=>['required', Rule::unique('users','name')],
            'email'=>['required', Rule::unique('users', 'email')],
            'password'=>['required', 'min:8', 'max:200']
        ]);

        $user = User::create([
                'name' => $valores['name'],
                'email' => $valores['email'],
                'password' => bcrypt($valores['password']),
            ]);
        auth()->login($user);

        return redirect('/principal');
    }

    public function principal(){
        if (!auth()->check()) {
        return redirect('/'); 
        }
        return view('principal');
    }

    
    public function create(){

        $categories = Category::all();
        return view('create', compact('categories'));
    }

    public function store(Request $request) {
        // Validar los datos
        $valores = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'status' => 'required|in:pending,in_progress,completed',
            'categories' => 'sometimes|array',
            'categories.*' => 'exists:categories,id'
        ]);

        // Crear la tarea
        $task = Task::create([
            'name' => $valores['name'],
            'description' => $valores['description'],
            'due_date' => $valores['due_date'],
            'status' => $valores['status'],
            'user_id' => auth()->id()
        ]);

        if (isset($valores['categories']) && !empty($valores['categories'])) {
            $task->categories()->attach($valores['categories']);
        }

    return redirect('/principal')->with('success', 'Tarea creada');
    }
    public function logout(){
        auth()->logout();
        return redirect('/');
    }
    
}
