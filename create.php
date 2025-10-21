<?php
require_once __DIR__ . '/autoload.php';

$dbconnec = new DatabaseConnection('php-oop');
$dbconnec->connect();

$users = new UserController();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save User</title>
</head>

<body>
    <h2>Create User</h2>
    <form action="Services/save_user.php" method="POST">
        <label for="first_name">First Name:</label><br>
        <input type="text" name="first_name" id="first_name" required><br><br>

        <label for="last_name">Last Name:</label><br>
        <input type="text" name="last_name" id="last_name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password" required><br><br>

        <label for="country">Country:</label><br>
        <input type="text" name="country" id="country" required><br><br>

        <input type="submit" value="Save User">
    </form>
</body>

</html>