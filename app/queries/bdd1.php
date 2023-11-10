<?php

    require("../config/conexion.php");
    include('../templates/header.html');

    $query = "";
    $result = $db -> prepare($query);
    $result -> execute();
    // $datos_deseado = $result -> fetchAll();

?>

    <body>
    </body>
</html>