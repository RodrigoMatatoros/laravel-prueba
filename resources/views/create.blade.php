<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @auth
    <div style="border: 3px solid black;">
        <h1>Nueva tarea</h1>
        <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <label for="title">Título</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Descripción</label>
        <textarea id="description" name="description" required></textarea>

        <label for="due_date">Fecha de vencimiento</label>
        <input type="date" id="due_date" name="due_date" required>

        <label for="status">Estado</label>
        <select id="status" name="status" required>
            <option value="pending">Pendiente</option>
            <option value="in_progress">En progreso</option>
            <option value="completed">Completada</option>
        </select>

        <label for="categories">Categorías</label>
        <select id="categories" name="categories[]" multiple>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
            <button type="submit">Crear tarea</button>
        </form>
    </div>
    @else
    <p>No estas logeado</p>
    @endauth
</body>