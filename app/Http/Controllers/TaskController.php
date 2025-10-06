<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\Category;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * 
     * Maneja el Login para los usuarios
     * Validacion de creedenciales con error por pantalla
     */
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
    /**
     * 
     * Registra el usuario en la base de datos
     * Crea el usuario e inicia sesion instataneamente
     */
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
    /** 
     * 
     * Muestra la página principal después del login
     * 
    */
    public function principal(){
        if (!auth()->check()) {
        return redirect('/'); 
        }
        $tareas = Task::where('user_id', auth()->id())
                  ->with('categories')
                  ->latest()
                  ->get();
    
        $filtro = 'all';
        return view('principal', compact('tareas','filtro'));
    }

    /**
     * 
     * Saca el formulario por pantalla para crear una nueva tarea
     * Coge todas la categorias de la tabla categories
     */
    public function create(){

        return view('create');
    }

    /**
     * 
     * Guarda la tarea que es creada en el formulario sacado por create()
     * Validado con StoreRequest
     * Nos redirige a principal
     */
    public function store(StoreRequest $request) {

        $valores = $request->validated();
        $tarea = Task::create([
            'name' => $valores['name'],
            'description' => $valores['description'],
            'due_date' => $valores['due_date'],
            'status' => $valores['status'],
            'user_id' => auth()->id()
        ]);

        if (isset($valores['categories']) && !empty($valores['categories'])) {
            $tarea->categories()->attach($valores['categories']);
        }

    return redirect('/principal')->with('success','Tarea creada');
    }

    /**
     * 
     * Muestra la lista de tareas hechas por el usuario que esta loggeado
     * Se puede flitrar por su estatus
     */
    public function index(Request $request)
    {
        if (!auth()->check()) {
            return redirect('/'); 
        }
        $filtro = $request->get('filtro', 'all');

        $tareas = Task::where('user_id',auth()->id())->FiltrarStatus($filtro)->with('categories')->get();
        
        return view('principal', compact('tareas', 'filtro'));
    }

    /**
     * Nos busca la tarea que le pasamos por parametro y nos lleva al formulario para que la editemos
     * No deja que otros usuarios que no sea su creador la edite
     */
    public function edit($id){

        $tarea = Task::findOrFail($id);
        if ($tarea->user_id !== auth()->id()){
            return redirect('/principal')->with('error', 'No puedes editar una tarea que no es tuya');
        }
        $categorias=Category::all();
        return view('edit', compact('tarea', 'categorias'));
    }
    /**
     * 
     * Coger los valores que le pasamos con el formulario de edit($id) y le hacce update
     * tambien modifica la tabla pivot para que no se sobreescreiba y queden mal
     * Validacion con UpdateRequest
     * Redirige a principal
     */
    public function update(UpdateRequest $request, $id){
         $tarea = Task::findOrFail($id);
         if ($tarea->user_id !== auth()->id()) {
            return redirect('/principal')->with('error', 'No puedes editar una tarea que no es tuya');
         }
         $valores = $request->validated();
         $tarea->update([
            'name' => $valores['name'],
            'description' => $valores['description'],
            'due_date' => $valores['due_date'],
            'status' => $valores['status']
         ]);
         if (isset($valores['categories'])) {
            $tarea->categories()->sync($valores['categories']);
         }else {
            $tarea->categories()->detach();
         }

         return redirect('/principal')->with('success', 'Tarea actualizada correctamente');
    }

    /**
     * 
     * Destruye la tarea en la que se clicka($id) y borra todo en la tabla tipo
     * Redirige a principal
     */
    public function destroy($id){

        $tarea = Task::findOrFail($id);
        if ($tarea->user_id !== auth()->id()){
            return redirect('/principal')->with('error', 'No puedes borrar una tarea que no es tuya');
        }
        $tarea->categories()->detach();
        $tarea->delete();
        return redirect('/principal')->with('success', 'Tarea eliminada perfectamente');

    }
    /**
     * Logout 
     * Redirige a registro y login de usuarios
     */
    public function logout(){
        auth()->logout();
        return redirect('/');
    }
    
}
