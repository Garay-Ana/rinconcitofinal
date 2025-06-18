<!DOCTYPE html>
<html>
<head>
    <title>Acceso - Rinconcito Chef</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="py-12" style="background-color: #f4eedb;">
<div class="container mt-5 text-center">
    <h2>Acceso para {{ ucfirst($rol) }}</h2>
    <p>¿Qué deseas hacer?</p>
    <a href="{{ route('login', ['rol' => $rol]) }}" class="btn btn-primary me-3">Iniciar Sesión</a>
    <a href="{{ route('register', ['rol' => $rol]) }}" class="btn btn-success">Registrarse</a>
</div>
</body>
</html>
