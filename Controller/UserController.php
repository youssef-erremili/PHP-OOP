<?php

class UserController
{


    public function getUser($id): void
    {
        $user = new User();
        $result = $user->get($id);

        if ($result) {
            header("Location: /php-oop/index.php");
            exit();
        }

        echo "Failed to create user.";
    }


    public function createUser(array $data): void
    {
        $user = new User();
        $result = $user->save($data);

        if ($result) {
            header("Location: /php-oop/index.php");
            exit();
        }

        echo "Failed to create user.";
    }

    public function deleteUser(int $id): void
    {
        $user = new User();
        $result = $user->delete($id);

        if ($result) {
            header("Location: /php-oop/index.php");
            exit();
        }

        echo "Failed to delete user.";
    }

    public function updateUser(int $id, array $data): void
    {
        $user = new User();
        $result = $user->edit($id, $data);

        if ($result) {
            header("Location: /php-oop/index.php");
            exit();
        }

        echo "Failed to delete user.";
    }
}
