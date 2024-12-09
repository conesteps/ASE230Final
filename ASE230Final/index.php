<?php
session_start();
include 'header.php'; // Include your header here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Your Project Hub</title>
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <main class="main-container">
        <div class="content">
            <h1 style="text-align: center;" >Manage Your Projects with Ease</h1>
			<br>
            <h3 style="text-align: center;">Welcome to Project Manager! This website allows you to add, modify, and store your projects. Use it to organize and showcase your work to potential employers or collaborators!.</h3>
			<br><br>

			<div style="text-align: center;">
			<h3 class="fw-bolder mb-4">What You Can Do Here:</h3>
				<ul class="list-unstyled">
					<p class="mb-3"><strong>Add New Projects</strong> - Store details of your projects with titles, descriptions, and more.</p>
                    <p class="mb-3"><strong>Modify Existing Projects</strong> - Update your projects to keep them current as you make progress.</p>
                    <p class="mb-3"><strong>Delete Projects</strong> - Remove outdated projects with ease.</p>
                 </ul>
			</div>
			<br><br>
            <!-- Buttons for actions -->
            <div  style="text-align: center;" class="button-group">
                <a href="create_project.php" class="button">Create New Project</a>
                <a href="my_projects.php" class="button">My Projects</a>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; // Include your footer here ?>
</body>
</html>
