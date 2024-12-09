<?php
$host = 'localhost';
$db = 'ase230final';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "An error occurred while connecting to the database. Please try again later.";
}
?>
