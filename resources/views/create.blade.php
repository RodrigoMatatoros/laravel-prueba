<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @auth

        <x-mensajes />
    
        <h1>Nueva tarea</h1>
        <form action="/store" method="POST">
        @csrf
            <x-formulario />
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
</html>