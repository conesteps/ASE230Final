<?php
session_start();
require 'db.php';
include 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if project_id is provided
if (!isset($_GET['project_id'])) {
    header("Location: my_projects.php");
    exit();
}

$project_id = $_GET['project_id'];

// Fetch project details
try {
    $stmt = $pdo->prepare("
        SELECT 
            p.project_id, 
            p.title, 
            p.description, 
            p.last_modified, 
            u.username AS created_by 
        FROM project p
        JOIN user u ON p.created_by = u.user_id
        WHERE p.project_id = ?
    ");
    $stmt->execute([$project_id]);
    $project = $stmt->fetch();

    if (!$project) {
        echo "Project not found.";
        exit();
    }
} catch (PDOException $e) {
    echo "An error occurred while fetching the project details. Please try again later.";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Project: <?php echo htmlspecialchars($project['title']); ?></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Project Details</h1>
        <div class="project-details">
            <p><strong>Title:</strong> <?php echo htmlspecialchars($project['title']); ?></p>
            <p><strong>Description:</strong></p>
            <p><?php echo nl2br(htmlspecialchars($project['description'])); ?></p>
            <p><strong>Created By:</strong> <?php echo htmlspecialchars($project['created_by']); ?></p>
            <p><strong>Last Modified:</strong> <?php echo date('F j, Y', strtotime($project['last_modified'])); ?></p>
        </div>
        <a href="profile.php?user_id.php" class="btn btn-primary">Back to Profile</a>
    </div>
	<?php
	include 'footer.php';
	?>
</body>
</html>
