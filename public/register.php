<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $role_id = $_POST['role_id'];

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role_id) VALUES (:name, :email, :password, :role_id)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role_id', $role_id);

    if ($stmt->execute()) {
        header('Location: login.php');
        exit();
    } else {
        echo "Registration failed!";
    }
}

// Fetch roles from the database
$stmt = $conn->query("SELECT * FROM roles");
$roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
        <link rel="stylesheet" href="style.css"> <!-- Adjust if necessary -->
</head>
<body>
    <h2>User Registration</h2>
    <form action="register.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="role">Role:</label>
        <select name="role_id" required>
            <?php foreach ($roles as $role): ?>
                <option value="<?php echo $role['id']; ?>"><?php echo $role['role_name']; ?></option>
            <?php endforeach;?>
        </select><br>

        <button type="submit">Register</button><br>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </form>
</body>
</html>
