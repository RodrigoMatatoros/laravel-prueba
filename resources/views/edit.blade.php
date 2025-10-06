<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
        <h1>Editar tarea</h1>
        <form action="/update/{{$tarea->id}}" method="POST">
        @csrf
            <x-formulario/>
            <button type="submit">Editar tarea</button>
        </form>
    
        <form action="/principal" method="POST">
          @csrf
        <button>Ir a principal</button>
        </form>
</body>
</html>