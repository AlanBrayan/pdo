<?php
// Obtener el id_empresa de la solicitud GET
$id_empresa = $_GET['id_empresa'];

// Conexión a la base de datos utilizando PDO
$dsn = 'mysql:host=localhost;dbname=test';
$usuario = 'root';
$contraseña = '';
try {
    $pdo = new PDO($dsn, $usuario, $contraseña);
} catch (PDOException $e) {
    die('Error de conexión: ' . $e->getMessage());
}

// Consulta para obtener el nombre de la empresa
$queryNombreEmpresa = 'SELECT nombre FROM empresa WHERE id_empresa = :id_empresa';
$stmtNombreEmpresa = $pdo->prepare($queryNombreEmpresa);
$stmtNombreEmpresa->bindParam(':id_empresa', $id_empresa, PDO::PARAM_INT);
$stmtNombreEmpresa->execute();
$nombreEmpresa = $stmtNombreEmpresa->fetchColumn();

echo $nombreEmpresa;
?>
