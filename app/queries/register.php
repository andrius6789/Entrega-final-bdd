
<?php
session_start();
include('./templates/header.html');

require("../config/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate inputs
    $username = htmlspecialchars($_POST['username']);
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $birthdate = htmlspecialchars($_POST['birthdate']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (!$email) {
        // Handle invalid email address
        echo "Invalid email address";
        exit();
    }

    try {
        // Check if the username already exists
        $checkQuery = "SELECT COUNT(*) FROM usuarios WHERE username = :username";
        $result = $db->prepare($checkQuery);
        $result->bindParam(':username', $username);
        $result->execute();

        $count = $result->fetchColumn();

        if ($count > 0) {
            echo "Username already exists. Please choose another.";
            exit();
        }

        // Insert the user into the database
        $insertQuery = "INSERT INTO usuarios (username, nombre, email, fecha_de_nacimiento, password) VALUES (:username, :name, :email, :birthdate, :password)";
        $result = $db->prepare($insertQuery);
        $result->bindParam(':username', $username);
        $result->bindParam(':name', $name);
        $result->bindParam(':email', $email);
        $result->bindParam(':birthdate', $birthdate);
        $result->bindParam(':password', $password);
        $result->execute();
        
    } catch (PDOException $e) {
        // Handle any errors
        echo "Error: " . $e->getMessage();
        exit();
    }

    // Redirect to login page after successful registration
    header("Location: login.php");
    exit();
}
?>

<body>
    <div class='main'>
        <!-- Cambiar el titulo si es que queramos -->
        <h1 class='title'>META DATABASES</h1>

        <form action='register.php' method='POST'>
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="name">Name:</label>
            <input type="text" name="name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="birthdate">Birthdate:</label>
            <input type="text" name="birthdate" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <input class='btn' type='submit' value='Register'>
        </form>
    </div>
</body>
</html>

