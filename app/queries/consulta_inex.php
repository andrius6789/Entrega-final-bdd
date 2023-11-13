<?php

require("../config/conexion.php");

function sanitizeInput($input)
{
    return htmlspecialchars(trim($input));
}

// Validar y sanitizar el input
$attributes = isset($_GET['attributes']) ? sanitizeInput($_GET['attributes']) : '';
$tableName = isset($_GET['table']) ? sanitizeInput($_GET['table']) : '';
$criteria = isset($_GET['criteria']) ? sanitizeInput($_GET['criteria']) : '';

// Ver si se entrega todo lo que se pide
if (empty($attributes) || empty($tableName) || empty($criteria)) {
    echo "Error: Missing required parameters";
    exit();
}

// Crear el query
$selectQuery = "SELECT $attributes FROM $tableName WHERE $criteria";

// Ejecutarlo
try {
    $result = $db->query($selectQuery);
    $rows = $result->fetchAll(PDO::FETCH_ASSOC);

    $filename = "consulta.txt";
    $file = fopen($filename, "w");

    if (!$file) {
        echo "Error: Unable to open file";
        exit();
    }

    foreach ($rows as $row) {
        fwrite($file, implode(', ', $row) . PHP_EOL);
    }

    fclose($file);

    echo "Results saved to consulta.txt";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
