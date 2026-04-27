<!DOCTYPE html>
<html>
<head>
    <title>Completar perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Completar perfil</h2>

<form method="POST" action="{{ route('perfil.store') }}">
    @csrf

    <div class="mb-3">
        <label>Escuela</label>
        <input type="text" name="escuela" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Rol en la escuela</label>
        <input type="text" name="rol_en_escuela" class="form-control" required>
    </div>

    <button class="btn btn-primary">Guardar</button>
</form>

</body>
</html>