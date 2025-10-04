<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @auth
    <p>Esta loggeado en este momento</p>
    <form action="/logout" method="POST">
        @csrf
        <button>Log out</button>
    </form>
    @else
        <div style="border: 3px solid black;">
        <h1>Registrarse</h1>

        {{-- MOSTRAR ERRORES --}}
    @if($errors->any())
        <div style="color: red; background: #fee; padding: 10px; margin: 10px 0;">
            <h4>Errores de validación:</h4>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form action="/registrar" method="POST">
            @csrf
            <input name="name" type="text" placeholder="nombre">
            <input name="email" type="text" placeholder="email">
            <input name="password" type="password" placeholder="password">
            <input type="submit"></input>
        </form>
        

    </div>
    </br>
</br>
    <div style="border: 3px solid black;">
        <h1>Login</h1>
        <form action="/login" method="POST">
            @csrf
            <input name="loginname" type="text" placeholder="nombre"> 
            <input name="loginpassword" type="password" placeholder="password">
            <button>Login</button>
        </form>
        

    </div>
    @endauth
    
</body>
</html>