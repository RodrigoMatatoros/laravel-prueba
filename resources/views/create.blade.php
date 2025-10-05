<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @auth

    @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                    <li style='color: red'>{{ $error }}</li>
                @endforeach
            </ul>
    @endif
    
        <h1>Nueva tarea</h1>
        <form action="/store" method="POST">
        @csrf
            <label for="name">Título</label>
            <input type="text" id="name" name="name" required>
            </br>
            <label for="description">Descripción</label>
            <textarea id="description" name="description" required></textarea>
            </br>
            <label for="due_date">Fecha de vencimiento</label>
            <input type="date" id="due_date" name="due_date" required>
            </br>
            <label for="status">Estado</label>
            <select id="status" name="status" required>
                <option value="pending">Pendiente</option>
                <option value="in_progress">En progreso</option>
                <option value="completed">Completada</option>
            </select>
            </br>
            <label for="categories">Categorías</label>
            <select id="categories" name="categories[]" multiple>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            </br>
            <button type="submit">Crear tarea</button>
        </form>
    
    <form action="/principal" method="POST">
        @csrf
        <button>Ir a principal</button>
    </form>
    @else
    <p>No estas logeado</p>
    @endauth
</body>