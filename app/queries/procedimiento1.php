<?php
require("../config/conexion.php");
include('../templates/header.html');

// Obtener usuarios (PORFAVOR ACTUALICEN)
$query = "SELECT * FROM usuarios;";
$result = $db2->prepare($query);
$result->execute();
$users = $result->fetchAll();

foreach ($users as $user) {
    // Build the query for moving users to the target database (group impar)
    $query = "INSERT INTO usuarios (id_usuario, username, nombre, email, fecha_nacimiento, contraseña) 
              VALUES (:id_usuario, :username, :nombre, :email, :fecha_nacimiento, :contraseña);";

    // Execute the query to insert users into the target database
    $result = $db->prepare($query);
    $result->bindValue(':id_usuario', $user['id_usuario'], PDO::PARAM_INT);
    $result->bindValue(':username', $user['username'], PDO::PARAM_STR);
    $result->bindValue(':nombre', $user['nombre'], PDO::PARAM_STR);
    $result->bindValue(':email', $user['email'], PDO::PARAM_STR);
    $result->bindValue(':fecha_nacimiento', $user['fecha_nacimiento'], PDO::PARAM_STR);
    $result->bindValue(':contraseña', $user['contraseña'], PDO::PARAM_STR);
    $result->execute();
}

// Mostrar los cambios
$query = "SELECT * FROM usuarios ORDER BY id_usuario DESC;";
$result = $db->prepare($query);
$result->execute();
$importedUsers = $result->fetchAll();
?>

<body>
    <table class='table'>
        <thead>
            <tr>
                <th>ID Usuario</th>
                <th>Username</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Fecha Nacimiento</th>
                <th>Contraseña</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($importedUsers as $importedUser) {
                echo "<tr>";
                for ($i = 0; $i < 6; $i++) {
                    echo "<td>{$importedUser[$i]}</td> ";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
