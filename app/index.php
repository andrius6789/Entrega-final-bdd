<?php
// Index is really just the homepage
session_start();
include('./templates/header.html');

// Check if the user is not logged in, redirect to login
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: ./queries/login.php");
    exit();
}

// Handle logout if the user clicks on "Cerrar Sesión"
if (isset($_GET['logout'])) {
    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header("Location: ./queries/login.php");
    exit();
}
?>

<body>
    <div class='main'>
        <h1 class='title'>META DATABASES </h1>

        <!-- Nav Bar -->
        <nav>
            <ul>
                <?php
                // Check if a user is logged in
                if (isset($_SESSION['username'])) {
                    // User is logged in, display "Mi Perfil" and "Cerrar Sesión"
                    echo "<li><a href='./queries/profile.php'>Mi Perfil</a></li>";
                    echo "<li><a href='?logout=1'>Cerrar Sesión</a></li>";
                }
                ?>
            </ul>
        </nav>

        <?php
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
        ?>

    </div>
</body>
</html>
