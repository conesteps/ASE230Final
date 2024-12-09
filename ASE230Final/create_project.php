<?php
session_start();
require 'db.php';
include 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle form submission for creating a new project
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and process the form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $public = isset($_POST['public']) ? 1 : 0; // 1 for public, 0 for private

    // Insert the new project into the database
    $stmt = $pdo->prepare("INSERT INTO project (title, description, created_by, public) VALUES (?, ?, ?, ?)");
    $stmt->execute([$title, $description, $_SESSION['user_id'], $public]);

    // Redirect back to the user's projects page
    header("Location: my_projects.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
    <main>
        <h1>Create New Project</h1>
        <form action="create_project.php" method="POST" class="form-container">
            <label for="title">Project Title</label>
            <input type="text" name="title" id="title" required>

            <label for="description">Project Description</label>
            <textarea name="description" id="description" required></textarea>

            <label for="public">Make this project public?</label>
            <input type="checkbox" name="public" id="public">

            <button type="submit" class="submit-button">Create Project</button>
        </form>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>
