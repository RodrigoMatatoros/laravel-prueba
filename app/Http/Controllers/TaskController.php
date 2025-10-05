<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\Category;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function login(LoginRequest $request){
        $valores = $request->validated();

        if(auth()->attempt(['name' => $valores['loginname'], 'password' => $valores['loginpassword']])){
            $request->session()->regenerate();
            return redirect('/principal');
        }

        return back()->withErrors([
            'loginname' => 'El usuario o la contraseña no es la correcta'
        ]);
    }
    public function registrar(RegisterRequest $request){
        $valores = $request->validated();

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

    public function store(StoreRequest $request) {

        \Log::info('=== STORE METHOD CALLED ===');
    \Log::info('URL: ' . $request->url());
    \Log::info('Method: ' . $request->method());
    \Log::info('All data: ', $request->all());
    
        $valores = $request->validated();
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

    return redirect('/principal')->with('success','Tarea creada');
    }

    public function index(Request $request)
    {
        if (!auth()->check()) {
            return redirect('/'); 
        }
        $filtro = $request->get('filtro', 'all');
        $query=Task::where('user_id',auth()->id())->with('categories');
        if ($filtro !== 'all') {
            $query->where('status', $filtro);
        }
        $tasks = $query->latest()->get();
        
        return view('principal', compact('tasks', 'filtro'));
    }

    public function edit($id){
        $tarea = Task::find($id);
        if ($tarea->user_id !== auth()->id()){
            return redirect('/principal')->with('error', 'No puedes editar una tarea que no es tuya');
        }
        $categoria=Category::all();
        return view('edit', compact('tarea', 'categoria'));
    }
    public function destroy($id){
        $tarea = Task::find($id);
        if ($tarea->user_id !== auth()->id()){
            return redirect('/principal')->with('error', 'No puedes borrar una tarea que no es tuya');
        }
        $tarea->categories()->detach();
        $tarea->delete();
        return redirect('/principal')->with('success', 'Tarea eliminada perfectamente');

    }
    public function logout(){
        auth()->logout();
        return redirect('/');
    }
    
}
