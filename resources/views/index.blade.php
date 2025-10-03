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
        <form action="/registrar" method="POST">
            @csrf
            <input name="name" type="text" placeholder="nombre">
            <input name="email" type="text" placeholder="email">
            <input name="password" type="password" placeholder="password">
            <button>Registrarse</button>
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