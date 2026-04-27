<!DOCTYPE html>
<html>
<head>
    <title>Consultar inscripción</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Consultar inscripción</h2>

<form method="POST" action="/consultar-inscripcion">
    @csrf

    <div class="mb-3">
        <label>DNI</label>
        <input type="text" name="dni" class="form-control" required>
    </div>

    <button class="btn btn-primary">Buscar</button>
</form>

</body>
</html>