<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        'loginname' => 'Las credenciales no son correctas.',
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

     public function principal()
    {
        return view('principal');
    }

    
    public function create(){

        $categories = Category::all();
        return view('tasks.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:225',
            'description' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'due_date' => 'required|date',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

    
        $task = Auth::user()->tasks()->create($validated);

        if ($request->has('categories')) {
            $task->categories()->attach($validated['categories']);
        }

        return redirect()->route('/principal')->with('success', 'Tarea creada correctamente');
    }
    public function logout(){
        auth()->logout();
        return redirect('/');
    }
    
}
