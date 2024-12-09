<?php
session_start();
require 'db.php';
include 'header.php';

// Check if the user is an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    echo ('Access Denied');
    exit();
}

// Fetch all projects from the database
$stmt = $pdo->query("SELECT p.project_id, p.title, p.description, u.username 
                     FROM project p 
                     JOIN user u ON p.created_by = u.user_id 
                     ORDER BY p.project_id DESC");
$projects = $stmt->fetchAll();

// Fetch all users from the database
$stmt = $pdo->query("SELECT user_id, first_name, last_name, username, email, is_admin 
                     FROM user 
                     ORDER BY user_id DESC");
$users = $stmt->fetchAll();
?>

<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<main>
    <h1>Admin Dashboard</h1>
    <p>Welcome, Admin! Here you can manage all projects and users on the platform.</p>
    
    <!-- List of All Projects -->
    <h2>Projects</h2>
	<a href="create_project.php" class="btn btn-primary">Create New Project</a>
    <table class="project-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Created By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projects as $project): ?>
                <tr>
                    <td><?php echo htmlspecialchars($project['title']); ?></td>
                    <td><?php echo htmlspecialchars($project['description']); ?></td>
                    <td><?php echo htmlspecialchars($project['username']); ?></td>
                    <td>
                        <!-- Edit Project -->
                        <a href="edit_project.php?project_id=<?php echo $project['project_id']; ?>&redirect_to=admin_dashboard" class="btn btn-warning">Edit</a>
                        
                        <!-- Delete Project -->
                        <form action="delete_project.php" method="post" style="display:inline;">
                            <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this project?');">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- List of All Users -->
    <h2>Users</h2>
	<a href="create_user.php" class="btn btn-primary">Create New User</a>
    <table class="user-table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td>
                        <!-- Edit User -->
                        <a href="edit_user.php?user_id=<?php echo $user['user_id']; ?>" class="btn btn-warning">Edit</a>
                        
                        <!-- Delete User -->
                        <form action="delete_user.php" method="post" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                            <button type="submit"  onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
<?php include 'footer.php'; ?>
