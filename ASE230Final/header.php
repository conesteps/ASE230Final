<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your stylesheet -->
    <style>
        header {
            background-color: #195905;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        nav {
            margin-top: 0.5rem;
        }
        nav a {
            color: white;
            margin: 0 1rem;
            text-decoration: none;
        }
        nav a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<header>
    <h1>Project Manager</h1>
    <nav>
        <a href="index.php">Home</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="my_projects.php">My Projects</a>
            <a href="profile.php?user_id=<?php echo $_SESSION['user_id']; ?>">My Profile</a>
			<a href="users_list.php">Collaborate</a>
            <a href="logout.php">Logout</a>
			
			<?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?> 
                <!-- Show this link only if the user is an admin -->
                <a href="admin_dashboard.php">Admin Dashboard</a>
            <?php endif; ?>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="signup.php">Sign Up Now!</a>
        <?php endif; ?>
    </nav>
</header>
