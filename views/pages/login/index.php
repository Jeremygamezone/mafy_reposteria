
<?php 
$usuario = "";
$contraseña = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLASIFICADO</title>
</head>
<body>
    <form method="POST" action="?c=usuario&a=Login">

    <div class="mb-3">
        <label>Usuario</label>
        <input
            type="text"
            name="usuario"
            class="form-control"
            required
        >
    </div>

    <div class="mb-3">
        <label>Contraseña</label>
        <input
            type="password"
            name="password"
            class="form-control"
            required
        >
    </div>

    <button type="submit" class="btn btn-primary">
        Iniciar sesión
    </button>
</form>
</body>
</html>