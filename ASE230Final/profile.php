<?php
session_start();
require 'db.php';
include 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get the user ID from the session or URL
if (isset($_GET['user_id'])) {
    $profile_user_id = $_GET['user_id'];
} else {
    $profile_user_id = $_SESSION['user_id']; // Display the profile of the logged-in user
}

// Fetch the user's details, including email
try {
    $stmt = $pdo->prepare("SELECT username, first_name, last_name, email FROM user WHERE user_id = ?");
    $stmt->execute([$profile_user_id]);
    $user = $stmt->fetch();
    if (!$user) {
        echo("Access Denied");
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

// Fetch projects associated with the user (including public and private, but filtering for others)
try {
    // If the profile belongs to the logged-in user, show both public and private projects
    if ($profile_user_id == $_SESSION['user_id']) {
        $stmt = $pdo->prepare("SELECT * FROM project WHERE created_by = ?");
        $stmt->execute([$profile_user_id]);
    } else {
        // Otherwise, only show public projects for other users
        $stmt = $pdo->prepare("SELECT * FROM project WHERE created_by = ? AND is_public = 1");
        $stmt->execute([$profile_user_id]);
    }

    $projects = $stmt->fetchAll();
} catch (PDOException $e) {
    $projects = [];
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($user['first_name']) . " " . htmlspecialchars($user['last_name']); ?>'s Profile</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<br><br>
    <h1 style="text-align: center;"><?php echo htmlspecialchars($user['first_name']) . " " . htmlspecialchars($user['last_name']); ?>'s Profile</h1>

    <h4 style="text-align: center;"><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></h4>

    <!-- Display Email under Username -->
    <h4 style="text-align: center;"><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></h4>
	<br><br>
    <h2 style="text-align: center;">Projects</h2>

    <?php if (count($projects) > 0): ?>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Created On</th>
                        <th>Last Modified</th>
						<th>View Project</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($projects as $project): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($project['title']); ?></td>
                            <td><?php echo htmlspecialchars($project['description']); ?></td>
                            <td><?php echo date('F j, Y', strtotime($project['created_when'])); ?></td>
                            <td><?php echo date('F j, Y', strtotime($project['last_modified'])); ?></td>
							<td>
                            <a href="view_project.php?project_id=<?php echo $project['project_id']; ?>" class="btn btn-primary">View</a>
							</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p style="text-align: center;">No projects to display.</p>
    <?php endif; ?>

    <?php include 'footer.php'; ?>
</body>
</html>
