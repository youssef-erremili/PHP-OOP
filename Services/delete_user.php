<?php
require_once __DIR__ . '/../autoload.php';

$id = $_GET['id'];

$controller = new UserController();
$controller->deleteUser($id);
