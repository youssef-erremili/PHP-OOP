<?php
require_once __DIR__ . '/../autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'first_name' => $_POST['first_name'] ?? null,
        'last_name'  => $_POST['last_name'] ?? null,
        'email'      => $_POST['email'] ?? null,
        'password'   => $_POST['password'] ?? null,
        'country'    => $_POST['country'] ?? null,
    ];

    $controller = new UserController();
    $controller->createUser($data);
}