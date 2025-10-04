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
    <p>Fitrar por tareas</p>
    <form action="" method="POST">
    </form>

    <form action="/logout" method="POST">
        @csrf
        <button>Log out</button>
    </form>
    @else
    <p>No estas logeado</p>
    @endauth
</body>