<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Empleados</title>
</head>
<body>
    <h1>Formulario de Empleados</h1>
    
    <form action="procesar.php" method="POST">
        <?php
        // Conexión a la base de datos utilizando PDO
        $dsn = 'mysql:host=localhost;dbname=test';
        $usuario = 'root';
        $contraseña = '';
        try {
            $pdo = new PDO($dsn, $usuario, $contraseña);
        } catch (PDOException $e) {
            die('Error de conexión: ' . $e->getMessage());
        }
        
        // Consulta para obtener los nombres y apellidos de los empleados
        $queryEmpleados = 'SELECT id, nombre, apellido, id_empresa FROM empleados';
        $stmtEmpleados = $pdo->query($queryEmpleados);
        ?>
        
        <label for="id_empleado">Empleado:</label>
        <select name="id_empleado" required>
            <?php
            // Generar opciones para el select de empleados
            while ($row = $stmtEmpleados->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row['id'] . "' data-id_empresa='" . $row['id_empresa'] . "'>" . $row['nombre'] . " " . $row['apellido'] . "</option>";
            }
            ?>
        </select>
        
        <label for="nombre_empresa">Empresa:</label>
        <span id="nombre_empresa"></span>
        
        <input type="submit" value="Guardar">
    </form>
    
    <script>
    // JavaScript para mostrar el nombre de la empresa en función de la selección del empleado
    document.querySelector('select[name="id_empleado"]').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        var idEmpresa = selectedOption.getAttribute('data-id_empresa');
        var nombreEmpresaElement = document.getElementById('nombre_empresa');
        
        // Obtener el nombre de la empresa desde la base de datos
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                nombreEmpresaElement.textContent = xhr.responseText;
            }
        };
        xhr.open('GET', 'obtener_nombre_empresa.php?id_empresa=' + idEmpresa, true);
        xhr.send();
    });
    </script>
</body>
</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" defer></script>