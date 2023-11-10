<?php

    require("../config/conexion.php");
    include('../templates/header.html');

    $query = "";
    $result = $db2 -> prepare($query);
    $result -> execute();
    // $datos = $result -> fetchAll();

?>

    <body>  
    </body>
</html>