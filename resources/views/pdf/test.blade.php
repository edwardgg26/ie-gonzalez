<!DOCTYPE html>
<html>
<head>
    <title>Registro {{ $grado->id }}</title>
</head>
<body>
    <h1>Detalles del Registro</h1>
    <p>ID: {{ $grado->id }}</p>
    <p>Grado: {{ $grado }}</p>
    <p>Grupo: {{ $grado->group }}</p>
    <p>Año: {{ $grado->year }}</p>
    <!-- Agrega otros campos según sea necesario -->
</body>
</html>