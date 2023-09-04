<?php
// Obtener el id del empleado seleccionado
$id_empleado = $_POST['id_empleado'];

// Conexión a la base de datos utilizando PDO
$dsn = 'mysql:host=localhost;dbname=test';
$usuario = 'root';
$contraseña = '';
try {
    $pdo = new PDO($dsn, $usuario, $contraseña);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Error de conexión: ' . $e->getMessage());
}

// Consulta para obtener los datos de nombre y apellido del empleado seleccionado
$queryDatosEmpleado = 'SELECT nombre, apellido, id_empresa FROM empleados WHERE id = :id_empleado';
$stmtDatosEmpleado = $pdo->prepare($queryDatosEmpleado);
$stmtDatosEmpleado->bindParam(':id_empleado', $id_empleado, PDO::PARAM_INT);
$stmtDatosEmpleado->execute();
$datosEmpleado = $stmtDatosEmpleado->fetch(PDO::FETCH_ASSOC);

$nombre = $datosEmpleado['nombre'];
$apellido = $datosEmpleado['apellido'];
$id_empresa = $datosEmpleado['id_empresa'];

// Insertar datos en la tabla empleadosTest
$queryInsert = 'INSERT INTO empleadosTest (nombre, apellido, id_empresa) VALUES (:nombre, :apellido, :id_empresa)';
$stmtInsert = $pdo->prepare($queryInsert);
$stmtInsert->bindParam(':nombre', $nombre, PDO::PARAM_STR);
$stmtInsert->bindParam(':apellido', $apellido, PDO::PARAM_STR);
$stmtInsert->bindParam(':id_empresa', $id_empresa, PDO::PARAM_INT);

if ($stmtInsert->execute()) {
    echo 'Datos insertados correctamente en la tabla empleadosTest.';
} else {
    echo 'Error al insertar los datos en la tabla empleadosTest.';
}
?>