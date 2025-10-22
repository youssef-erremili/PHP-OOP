<?php
require_once __DIR__ . '/autoload.php';

if (!isset($_GET['id'])) {
    die('No user ID provided.');
}

$id = (int)$_GET['id'];

$user = new User();
$userData = $user->get($id);

if (!$userData) {
    die('User not found.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>

    <form action="Services/update-user.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($userData['id']) ?>">

        <label>First Name:</label><br>
        <input type="text" name="first_name" value="<?= htmlspecialchars($userData['first_name']) ?>" required><br><br>

        <label>Last Name:</label><br>
        <input type="text" name="last_name" value="<?= htmlspecialchars($userData['last_name']) ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= htmlspecialchars($userData['email']) ?>" required><br><br>

        <label>Password (leave blank to keep current):</label><br>
        <input type="password" name="password"><br><br>

        <label>Country:</label><br>
        <input type="text" name="country" value="<?= htmlspecialchars($userData['country']) ?>" required><br><br>

        <input type="submit" value="Update User">
    </form>

    <br>
    <a href="index.php">Back</a>
</body>
</html>
