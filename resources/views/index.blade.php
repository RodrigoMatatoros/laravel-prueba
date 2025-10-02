<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div style="border: 3px solid black;">
        <h1>Register</h1>
        
        <form action="/registrar" method="POST">
            @csrf
            <input type="text" placeholder="nombre">
            <input type="text" placeholder="email">
            <input type="text" placeholder="password">
            <input type="submit">
        </form>
        

    </div>
</body>
</html>