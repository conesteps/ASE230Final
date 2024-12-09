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
    // Fetch all users except the current logged-in user
    $stmt = $pdo->prepare("SELECT user_id, username, first_name, last_name FROM user WHERE user_id != ?");
    $stmt->execute([$_SESSION['user_id']]);
    $users = $stmt->fetchAll();
} catch (PDOException $e) {
    $users = []; // Set as an empty array to prevent undefined variable errors
    echo "An error occurred while fetching the user list. Please try again later.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1 style="text-align: center;">User Directory</h1>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($user['last_name']); ?></td>
                    <td>
                        <a class="btn btn-warning" href="profile.php?user_id=<?php echo $user['user_id']; ?>">View Profile</a>
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
