<?php

class UserController
{

    public function createUser(array $data): User
    {
        $user = new User();
        $user->create($data);

        if ($user) {
            header("Location: /php-oop/index.php");
            exit();
        }

        return $user;
    }



    public function deleteUser(int $id): User
    {
        $user = new User();
        $user->delete($id);
        if ($user) {
            header("Location: /php-oop/index.php");
            exit();
        }
        return $user;
    }
}
