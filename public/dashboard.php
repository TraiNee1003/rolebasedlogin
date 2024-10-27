<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

require_once '../config/database.php';
$user = $_SESSION['user'];

// Fetch role name
$stmt = $conn->prepare("SELECT role_name FROM roles WHERE id = :role_id");
$stmt->bindParam(':role_id', $user['role_id']);
$stmt->execute();
$role = $stmt->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css"> <!-- Adjust if necessary -->
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h2>
    <p>Your role is: <?php echo htmlspecialchars($role); ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>
