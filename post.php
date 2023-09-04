<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Inserción de Empleados</title>
</head>
<body>
    <h1>Formulario de Inserción de Empleados</h1>
    
    <form action="post2.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>
        
        <input type="submit" value="Insertar">
    </form>
</body>
</html>



