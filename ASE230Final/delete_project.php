<?php
session_start();
require 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project_id = $_POST['project_id'] ?? null;

    if ($project_id) {
        try {
            // Check ownership of the project
            $stmt = $pdo->prepare("SELECT * FROM project WHERE project_id = ?");
            $stmt->execute([$project_id]);
            $project = $stmt->fetch();

            if ($project && ($project['created_by'] == $_SESSION['user_id'] || $_SESSION['is_admin'])) {
                // Delete the project
                $deleteStmt = $pdo->prepare("DELETE FROM project WHERE project_id = ?");
                $deleteStmt->execute([$project_id]);

                $_SESSION['message'] = "Project successfully deleted.";
            } else {
                $_SESSION['error'] = "You do not have permission to delete this project.";
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "An error occurred: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "Invalid project ID.";
    }
} else {
    $_SESSION['error'] = "Invalid request method.";
}

header("Location: my_projects.php");
exit();
?>
