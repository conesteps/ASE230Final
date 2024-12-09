<?php
require 'db.php';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        // Insert the new user into the database
        $stmt = $pdo->prepare("INSERT INTO user (first_name, last_name, username, email, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$first_name, $last_name, $username, $email, $password]);

        // Redirect to the login page after successful registration
        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <main class="form-container">
        <div class="form-box">
            <h2>Register</h2>
            <form method="POST">
                <div class="input-group">
                    <input type="text" name="first_name" placeholder="First Name" required>
                </div>
                <div class="input-group">
                    <input type="text" name="last_name" placeholder="Last Name" required>
                </div>
                <div class="input-group">
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
				<br><br>
                <button type="submit" class="button">Sign Up</button>
            </form>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
