<?php
// Parámetros de conexión a la base de datos
$dsn = 'mysql:host=localhost;dbname=test';
$usuario = 'root';
$contraseña = '';

try {
    // Crear una conexión a la base de datos
    $pdo = new PDO($dsn, $usuario, $contraseña);
    
    // Establecer el modo de error de PDO a excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Consulta SQL para obtener los campos id, nombre y apellido de la tabla empleados
    $query = "SELECT id, nombre, apellido FROM empleados";
    
    // Preparar la consulta
    $stmt = $pdo->prepare($query);
    
    // Ejecutar la consulta
    $stmt->execute();
    
    // Obtener los resultados como un arreglo asociativo
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Manejar errores de conexión o consulta
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla de Empleados</title>
</head>
<body>
    <h1>Tabla de Empleados</h1>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
        </tr>
        <?php foreach ($resultados as $empleado): ?>
        <tr>
            <td><?php echo $empleado['id']; ?></td>
            <td><?php echo $empleado['nombre']; ?></td>
            <td><?php echo $empleado['apellido']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
