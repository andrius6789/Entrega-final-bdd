<?php
session_start();
include('./templates/header.html');

require("../config/conexion.php");

if (!isset($_SESSION['username'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

try {
    // Get user information
    $username = $_SESSION['username'];
    $getUserQuery = "SELECT nombre, email, fecha_nacimiento FROM usuarios WHERE username = :username";
    $getUserResult = $db->prepare($getUserQuery);
    $getUserResult->bindParam(':username', $username);
    $getUserResult->execute();
    $user = $getUserResult->fetch(PDO::FETCH_ASSOC);

    // Get list of subscriptions ordered by date of purchase
    // $getSubscriptionsQuery = "SELECT subscription_name, purchase_date FROM subscriptions WHERE username = :username ORDER BY purchase_date";
    // $getSubscriptionsResult = $db->prepare($getSubscriptionsQuery);
    // $getSubscriptionsResult->bindParam(':username', $username);
    // $getSubscriptionsResult->execute();
    // $subscriptions = $getSubscriptionsResult->fetchAll(PDO::FETCH_ASSOC);

    // Get the sum of hours used for content viewing and gaming separately
    // $getHoursQuery = "SELECT SUM(hours_viewed) as total_hours_viewed, SUM(hours_played) as total_hours_played FROM user_activity WHERE username = :username";
    // $getHoursResult = $db->prepare($getHoursQuery);
    // $getHoursResult->bindParam(':username', $username);
    // $getHoursResult->execute();
    // $hours = $getHoursResult->fetch(PDO::FETCH_ASSOC);

    // Calculate age based on birthdate
    $birthdate = new DateTime($user['fecha_nacimiento']);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthdate)->y;

} catch (PDOException $e) {
    // Handle any database-related errors
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<body>
    <div class='main'>
        <h1 class='title'>Mi Perfil</h1>

        <div>
            <h2>Información Personal</h2>
            <p>Nombre: <?php echo $user['nombre']; ?></p>
            <p>Email: <?php echo $user['email']; ?></p>
            <p>Username: <?php echo $username; ?></p>
            <p>Edad: <?php echo $age; ?></p>
        </div>

        <div>
        </div>
    </div>
</body>
</html>
