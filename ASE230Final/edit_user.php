<?php
session_start();
require 'db.php';
include 'header.php';

// Check if the user is an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    echo ('Access Denied');
    exit();
}

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Fetch user details
    $stmt = $pdo->prepare("SELECT * FROM user WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    if (!$user) {
        header('Location: admin_dashboard.php');
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    // Update user in the database
    $stmt = $pdo->prepare("UPDATE user SET first_name = ?, last_name = ?, username = ?, email = ?, is_admin = ? WHERE user_id = ?");
    $stmt->execute([$first_name, $last_name, $username, $email, $is_admin, $user_id]);

    header("Location: admin_dashboard.php");
    exit();
}
?>

<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<main>
    <h1>Edit User</h1>
    <form action="edit_user.php?user_id=<?php echo $user['user_id']; ?>" method="post">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required><br><br>
        
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required><br><br>

        <label for="username">Username</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required><br><br>

        <label for="email">Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br><br>

        <label for="is_admin">Admin</label>
        <input type="checkbox" name="is_admin" <?php echo $user['is_admin'] ? 'checked' : ''; ?>><br><br>

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</main>

<?php include 'footer.php'; ?>
