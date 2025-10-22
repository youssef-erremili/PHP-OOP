<?php
require_once __DIR__ . '/autoload.php';

$dbconnec = new DatabaseConnection('php-oop');
$dbconnec->connect();

$users = new User();
$tt = $users->get(20);

$fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'country',
    ];

// $fill = $users->fillable($fillable);


?>

<!DOCTYPE html>     
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP OOP</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            padding: 6px 12px;
            cursor: pointer;
        }
        .edit-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
        }
        .delete-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
        }
    </style>
</head>

<body>
    <h2>All Users</h2>

        <pre>
            <?php
                print_r($tt);
            ?>
        </pre>

    <?php if (!empty($users->users)) : ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users->users as $index => $user) : ?>
                    <tr>
                        <td style="display: flex; align-items: baseline;">
                            <?= $index+1 ?>
                            <p> -- </p>
                            <?= htmlspecialchars($user['id']) ?>
                        </td>
                        <td><?= htmlspecialchars($user['first_name']) ?></td>
                        <td><?= htmlspecialchars($user['last_name']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['country']) ?></td>
                        <td><?= htmlspecialchars($user['created_at']) ?></td>
                        <td>
                            <a href="update.php?id=<?= $user['id'] ?>">
                                <button class="edit-btn">Edit</button>
                            </a>
                            <a href="Services/delete_user.php?id=<?= $user['id'] ?>">
                                <button class="delete-btn">Delete</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No users found.</p>
    <?php endif; ?>

</body>

</html>