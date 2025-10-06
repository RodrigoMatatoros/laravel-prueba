<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <x-mensajes />
    @auth
    <p>Esta loggeado en este momento</p>
    <form action="/create" method="POST">
        @csrf
        <p>Para crear una nueva actividad</p>
        <button>Crear</button>
    </form>

    <form action="" method="GET">
        <label for="filtro">Filtrar tareas por estado:</label>
        <select name="filtro" id="filtro" onchange="this.form.submit()">
            <option value="all"{{ $filtro=='all' ? 'selected' : ''}}>Todas las tareas</option>
            <option value="pending"{{$filtro=='pending' ? 'selected' : ''}}>Pendientes</option>
            <option value="in_progress"{{$filtro =='in_progress' ? 'selected' : '' }}>En progreso</option>
            <option value="completed"{{ $filtro =='completed' ? 'selected' : ''}}>Completadas</option>
        </select>
    </form>
    @if($tareas->count() > 0)
        @foreach($tareas as $tarea)
            <div style="border: 3px solid black;"">
                <h1>{{$tarea->name}}</h1>
                <p>Descripción:{{ $tarea->description}}</p>
                <p>Estado:
                    @if($tarea->status== 'pending')Pendiente
                    @elseif($tarea->status =='in_progress')En progreso
                    @elseif($tarea->status=='completed')Completada
                    @endif
                </p>
                <p>Fecha de vencimiento:{{$tarea->due_date}}</p>
                <p>Categorías: 
                    @foreach($tarea->categories as $categoria)
                        {{$categoria->name}}
                        @if($categoria != $tarea->categories->last()), 
                        @endif
                    @endforeach
                </br>
                </br>
                <a href="/edit/{{$tarea->id}}" class="button">Editar esta tarea</a>

                <form action="/destroy/{{$tarea->id}}" method="POST">
                    @csrf
                    <button type="submit">Borrar esta tarea</button>
                </form>
            </div>
        </BR>
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
</html>