<?php
session_start();
require 'db.php';
include 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

try {
    // Fetch projects created by the logged-in user
    $stmt = $pdo->prepare("SELECT * FROM project WHERE created_by = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $projects = $stmt->fetchAll();
} catch (PDOException $e) {
    $projects = []; // Ensure the variable is defined even if an error occurs
    echo "An error occurred while loading your projects. Please try again later.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Projects</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<br></br>
    <h1 style="text-align: center;">My Projects</h1>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Created On</th>
                <th>Last Modified</th>
                <th>Visibility</th> <!-- New column for visibility -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projects as $project): ?>
                <tr>
                    <td><?php echo htmlspecialchars($project['title']); ?></td>
                    <td><?php echo htmlspecialchars($project['description']); ?></td>
                    <td><?php echo date("F j, Y", strtotime($project['created_when'])); ?></td> <!-- Formatted date -->
                    <td><?php echo date("F j, Y", strtotime($project['last_modified'])); ?></td> <!-- Formatted date -->
                    <td>
                        <?php
                            // Display public or private status
                            echo $project['is_public'] == 1 ? 'Public' : 'Private';
                        ?>
                    </td>
                    <td>
                        <a href="edit_project.php?project_id=<?php echo $project['project_id']; ?>&redirect_to=my_projects" class="btn btn-warning">Edit</a>
                        <form action="delete_project.php" method="post" style="display:inline;">
                            <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this project?');">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php
        include 'footer.php';
    ?>
</body>
</html>
