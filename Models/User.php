<?php

class User extends Model implements StorableInterface
{

    use SoftDeletes;

    private string|int $id;
    private string $fullname;
    private string $email;
    private string $country;
    private string $password;

    public array $users = [];
    
    /**
     * @var string
     */

    private const MODEL_NAME = 'users';

    public function __construct()
    {
        $this->users = $this->getAll();
    }

    public function getFullName(int $id): array|string
    {
        $user = $this->getCurrentUser($id);

        if (!is_array($user)) {
            return 'User not Found';
        }

        return $user['first_name'] . ' ' . $user['last_name'];
    }

    public function getCurrentUser(int $id): array|string
    {
        $wanted_user = array_filter($this->users, fn($user) => $user['id'] == $id);
        $user = reset($wanted_user);

        return $user ?: 'User not Found';
    }

    public function getEmail(int $id): string
    {
        $user = $this->getCurrentUser($id);

        if (!is_array($user)) {
            return 'EMail not Found';
        }

        return $user['email'];
    }

    public function getCountry(int $id): string
    {
        $user = $this->getCurrentUser($id);

        if (!is_array($user)) {
            return 'User not Found';
        }

        return $user['country'];
    }

    public function getAll(): array
    {
        $pdo = parent::establishConn();

        try {
            $statement = $pdo->query('SELECT * FROM users Where deleted_at IS NULL');
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new RuntimeException('Query failed: ' . $e->getMessage());
        }
    }

    public function create(array $data): mixed
    {
        $pdo = $this->establishConn();

        try {
            $sql = "INSERT INTO users (first_name, last_name, email, password, country, created_at, updated_at)
                VALUES (:first_name, :last_name, :email, :password, :country, NOW(), NOW())";

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':first_name', $data['first_name']);
            $stmt->bindParam(':last_name', $data['last_name']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':password', $data['password']);
            $stmt->bindParam(':country', $data['country']);

            $stmt->execute();

            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            throw new RuntimeException('Insert failed: ' . $e->getMessage());
        }
    }

    public function read(string $model = 'users', int $id, string $message = 'Desired User is not Found'): mixed
    {
        return parent::read($model, $id, $message);
    }


    public function update(int $id, array $data): string
    {
        $pdo = $this->establishConn();

        $sql = "UPDATE users  SET first_name = :first_name, last_name = :last_name, email = :email, password = :password, country = :country, updated_at = NOW() WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':first_name' => $data['first_name'],
            ':last_name' => $data['last_name'],
            ':email' => $data['email'],
            ':password' => $data['password'],
            ':country' => $data['country'],
            ':id' => $id,
        ]);

        return "User updated successfully.";
    }

    public function delete(int $id): mixed
    {
        return $this->softDelete($id);
    }
}
