<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @auth
    <p>Esta loggeado en este momento</p>
    <form action="/create" method="POST">
        @csrf
        <p>Para crear una nueva actividad</p>
        <button>Crear</button>
    </form>

    <form action="" method="GET">
        @csrf
        <label for="filtro">Filtrar tareas por estado:</label>
        <select name="filtro" id="filtro" onchange="this.form.submit()">
            <option value="all"{{ $filtro=='all' ? 'selected' : ''}}>Todas las tareas</option>
            <option value="pending"{{$filtro=='pending' ? 'selected' : ''}}>Pendientes</option>
            <option value="in_progress"{{$filtro =='in_progress' ? 'selected' : '' }}>En progreso</option>
            <option value="completed"{{ $filtro =='completed' ? 'selected' : ''}}>Completadas</option>
        </select>
    </form>
    @if($tasks->count() > 0)
        @foreach($tasks as $task)
            <div>
                <h1>{{$task->name}}</h1>
                <p>Descripción:{{ $task->description}}</p>
                <p>Estado:
                    @if($task->status== 'pending')Pendiente
                    @elseif($task->status =='in_progress')En progreso
                    @elseif($task->status=='completed')Completada
                    @endif
                </p>
                <p>Fecha de vencimiento:{{$task->due_date}}</p>
                <p>Categorías: 
                    @foreach($task->categories as $category)
                        {{$category->name}}
                        @if($category != $task->categories->last()), 
                        @endif
                    @endforeach
                </p>
        </div>
        <hr>
        @endforeach
    @else
        <p>No hay tareas</p>
    @endif
   
    */
    <form action="/logout" method="POST">
        @csrf
        <button>Log out</button>
    </form>
    @else
    <p>No estas logeado</p>
    @endauth
</body> 