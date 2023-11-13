<?php
session_start();
include('./templates/header.html');

require("../config/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validate inputs
        $username = htmlspecialchars($_POST['username']);
        $password = $_POST['password'];

        // Check if the username exists
        $checkQuery = "SELECT * FROM users WHERE username = :username";
        $result = $db->prepare($checkQuery);
        $result->bindParam(':username', $username);
        $result->execute();

        $user = $result->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            throw new Exception("Invalid username or password");
        }

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct, start a session
            $_SESSION['username'] = $username;

            // Redirect to the index page or any other page you desire
            header("Location: index.php");
            exit();
        } else {
            throw new Exception("Invalid username or password");
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}
?>

<body>
    <div class='main'>
        <h1 class='title'>META DATABASES</h1>

        <form action='login.php' method='POST'>
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <input class='btn' type='submit' value='Login'>
        </form>

        <form action='register.php' method='GET'>
            <input class='btn' type='submit' value='Register'>
        </form>
    </div>
</body>
</html>
