<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=h1, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bienvenido Registro</h1>
    @foreach($empleados as $empleado) 
        {{ $empleado->empleado }}
    @endforeach
</body>
</html>