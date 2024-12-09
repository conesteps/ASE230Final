<?php
session_start();
require 'db.php';

// Check if the user is an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    echo ('Access Denied');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    // Insert new user into the database
    $stmt = $pdo->prepare("INSERT INTO user (first_name, last_name, username, email, password, is_admin) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$first_name, $last_name, $username, $email, $password, $is_admin]);

    header("Location: admin_dashboard.php");
    exit();
}
?>

<?php include 'header.php'; ?>

<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<main>
    <h1>Create New User</h1>
    <form action="create_user.php" method="post">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" required><br><br>
        
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" required><br><br>

        <label for="username">Username</label>
        <input type="text" name="username" required><br><br>

        <label for="email">Email</label>
        <input type="email" name="email" required><br><br>

        <label for="password">Password</label>
        <input type="password" name="password" required><br><br>

        <label for="is_admin">Admin</label>
        <input type="checkbox" name="is_admin"><br><br>

        <button type="submit" class="btn btn-primary">Create User</button>
    </form>
</main>

<?php include 'footer.php'; ?>
