<?php
// Index is really just the homepage
session_start();
include('./templates/header.html');
?>

<body>
    <div class='main'>
        <h1 class='title'>META DATABASES </h1>

        <!-- Nav Bar? -->
        <nav>
            <ul>
                <?php
                // Check if a user is logged in
                if (isset($_SESSION['username'])) {
                    // User is logged in, display "Mi Perfil"
                    echo "<li><a href='./queries/profile.php'>Mi Perfil</a></li>";
                }
                ?>
            </ul>
        </nav>

        <?php
        // Check if a user is logged in
        if (isset($_SESSION['username'])) {
            // User is logged in, display main content
            echo "
            <div class='container'>
                <h3>Ver peliculas y series</h3>
                <form  action='./queries/bdd1.php' method='GET'>
                    <input class='btn' type='submit' value='Consultar'>
                </form>
            </div>
            <div class='container'>
                <h3>Ver juegos</h3>
                <form  action='./queries/bdd2.php' method='GET'>
                    <input class='btn' type='submit' value='Consultar'>
                </form>
            </div>
            <div class='container'>
                <h3>Consulta Inestructurada</h3>
                <form  action='./queries/consulta_inex.php' method='GET'>
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
            // No session, display login form
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
