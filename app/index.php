<?php
session_start();
include('./templates/header.html');
?>

<body>
    <div class='main'>
        <h1 class='title'>META DATABASES </h1>

        <?php
        // Check if a user is logged in
        if (isset($_SESSION['username'])) {
            // User is logged in, display the main content
            echo "
            <form  action='./queries/login.php' method='GET'>
                <input class='btn' type='submit' value='Usuario'>
            </form>

            <div class='container'>
                <h3>Ver base de datos 1</h3>
                <form  action='./queries/bdd1.php' method='GET'>
                    <input class='btn' type='submit' value='Consultar'>
                </form>
            </div>
            <div class='container'>
                <h3>Ver base de datos 2</h3>
                <form  action='./queries/bdd2.php' method='GET'>
                    <input class='btn' type='submit' value='Consultar'>
                </form>
            </div>
            <div class='container'>
                <h3>Procedimiento almacenado 1</h3>
                <form  action='./queries/procedimiento1.php' method='GET'>
                    <input class='btn' type='submit' value='Consultar'>
                </form>
            </div>
            <div class='container'>
                <h3>Procedimiento almacenado 2</h3>
                <form  action='./queries/procedimiento2.php' method='POST'>
                    <input class='btn' type='submit' value='Consultar'>
                </form>
            </div>";
        } else {
            // No esta en una sesion, redirect
            echo "
            <p>Por favor, inicia sesión para acceder a las funciones.</p>
            <form  action='./queries/login.php' method='GET'>
                <input class='btn' type='submit' value='Iniciar Sesión'>
            </form>";
        }
        ?>

    </div>
</body>
</html>
