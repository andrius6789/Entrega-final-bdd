<?php
require("../config/conexion.php");
include('../templates/header.html');

// Obtener info de pagos (PORFAVOR ACTUALICEN)
$query = "SELECT * FROM pagos_par???;";
$result = $db2->prepare($query);
$result->execute();
$payments = $result->fetchAll();

foreach ($payments as $payment) {
    // Determine the type of payment (arriendo or suscripcion) and build the corresponding query
    if ($payment['tipo_pago'] == 'arriendo') {
        $query = "INSERT INTO pago_peliculas_arrendadas (id_arriendo, id_usuario, id_pelicula, valor_arriendo, fecha_arriendo) 
                  VALUES (:id_arriendo, :id_usuario, :id_pelicula, :valor_arriendo, :fecha_arriendo);";
    } elseif ($payment['tipo_pago'] == 'suscripcion') {
        $query = "INSERT INTO pago_suscripcion (id_ps, id_usuario, id_proveedor, estado, valor, fecha_inicio, fecha_termino) 
                  VALUES (:id_ps, :id_usuario, :id_proveedor, :estado, :valor, :fecha_inicio, :fecha_termino);";
    }

    // Execute the query to insert payments into the target database
    $result = $db->prepare($query);
    $result->bindValue(':id_arriendo', $payment['id_arriendo'], PDO::PARAM_INT);
    $result->bindValue(':id_usuario', $payment['id_usuario'], PDO::PARAM_INT);
    $result->bindValue(':id_pelicula', $payment['id_pelicula'], PDO::PARAM_INT);
    $result->bindValue(':valor_arriendo', $payment['valor_arriendo'], PDO::PARAM_INT);
    $result->bindValue(':fecha_arriendo', $payment['fecha_arriendo'], PDO::PARAM_STR);

    $result->bindValue(':id_ps', $payment['id_ps'], PDO::PARAM_INT);
    $result->bindValue(':id_proveedor', $payment['id_proveedor'], PDO::PARAM_INT);
    $result->bindValue(':estado', $payment['estado'], PDO::PARAM_STR);
    $result->bindValue(':valor', $payment['valor'], PDO::PARAM_INT);
    $result->bindValue(':fecha_inicio', $payment['fecha_inicio'], PDO::PARAM_STR);
    $result->bindValue(':fecha_termino', $payment['fecha_termino'], PDO::PARAM_STR);

    $result->execute();
}

// Mostrar los cambios
$queryArriendo = "SELECT * FROM pago_peliculas_arrendadas ORDER BY id_arriendo DESC;";
$querySuscripcion = "SELECT * FROM pago_suscripcion ORDER BY id_ps DESC;";

$resultArriendo = $db->prepare($queryArriendo);
$resultSuscripcion = $db->prepare($querySuscripcion);

$resultArriendo->execute();
$resultSuscripcion->execute();

$importedPaymentsArriendo = $resultArriendo->fetchAll();
$importedPaymentsSuscripcion = $resultSuscripcion->fetchAll();
?>

<body>
    <h2>Pago Películas Arrendadas</h2>
    <table class='table'>
        <thead>
            <tr>
                <th>ID Arriendo</th>
                <th>ID Usuario</th>
                <th>ID Película</th>
                <th>Valor Arriendo</th>
                <th>Fecha Arriendo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($importedPaymentsArriendo as $importedPayment) {
                echo "<tr>";
                for ($i = 0; $i < 5; $i++) {
                    echo "<td>{$importedPayment[$i]}</td> ";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <h2>Pago Suscripción</h2>
    <table class='table'>
        <thead>
            <tr>
                <th>ID Pago Suscripción</th>
                <th>ID Usuario</th>
                <th>ID Proveedor</th>
                <th>Estado</th>
                <th>Valor</th>
                <th>Fecha Inicio</th>
                <th>Fecha Término</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($importedPaymentsSuscripcion as $importedPayment) {
                echo "<tr>";
                for ($i = 0; $i < 7; $i++) {
                    echo "<td>{$importedPayment[$i]}</td> ";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <footer>
        <p>
            IIC2413 - Ayudantía 4 BDD
        </p>
    </footer>
</body>
</html>
