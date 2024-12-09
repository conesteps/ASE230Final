<?php
session_start();
require 'db.php';
include 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get the redirect_to parameter (default to 'my_projects' if not set)
$redirect_to = $_GET['redirect_to'] ?? 'my_projects';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get project details from the form
    $project_id = $_POST['project_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $is_public = isset($_POST['is_public']) ? 1 : 0;

    try {
        // Update the project in the database
        $stmt = $pdo->prepare("UPDATE project SET title = ?, description = ?, is_public = ?, last_modified = NOW() WHERE project_id = ?");
        $stmt->execute([$title, $description, $is_public, $project_id]);

        // Redirect based on the source page
        if ($redirect_to === 'admin_dashboard') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: my_projects.php");
        }
        exit();
    } catch (PDOException $e) {
        echo "Error updating project: " . $e->getMessage();
    }
}

// Retrieve the project data for pre-filling the form
if (isset($_GET['project_id'])) {
    $project_id = $_GET['project_id'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM project WHERE project_id = ?");
        $stmt->execute([$project_id]);
        $project = $stmt->fetch();

        if (!$project) {
            echo "Project not found.";
            exit();
        }
    } catch (PDOException $e) {
        echo "Error fetching project: " . $e->getMessage();
        exit();
    }
} else {
    echo "No project ID provided.";
    exit();
}
?>


<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<main>
    <h1>Edit Project</h1>
    <form method="post">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($project['title']); ?>" required>
		
        <label for="description">Description</label>
        <textarea name="description" id="description" required><?php echo htmlspecialchars($project['description']); ?></textarea>

        <label for="is_public">Public</label>
        <input type="checkbox" name="is_public" id="is_public" <?php echo $project['is_public'] == 1 ? 'checked' : ''; ?>>

        <button type="submit">Save Changes</button>
    </form>
</main>

<?php include 'footer.php'; ?>
