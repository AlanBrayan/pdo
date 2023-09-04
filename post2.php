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
    
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    
    // Consulta SQL para insertar un nuevo registro en la tabla empleados
    $query = "INSERT INTO empleados (nombre, apellido) VALUES (:nombre, :apellido)";
    
    // Preparar la consulta
    $stmt = $pdo->prepare($query);
    
    // Bind de los parámetros
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
    
    // Ejecutar la consulta
    $stmt->execute();
    
    echo "Inserción exitosa.";
} catch (PDOException $e) {
    // Manejar errores de conexión o consulta
    echo "Error: " . $e->getMessage();
}
?>
