<?php

class User implements StorableInterface
{

    use SoftDeletes;

    private string $firstname, $lastname, $email, $contry, $password;


    public function __construct() {}

    public function getName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getContry(): string
    {
        return $this->contry;
    }

    public function getAll(): array
    {
        $pdo = $this->establishConn();

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

    public function read(int $id): array
    {
        $pdo = $this->establishConn();

        try {
            $statement = $pdo->query("SELECT * FROM users WHERE id = $id AND deleted_at IS NULL");
            $row = $statement->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                echo "User not found.";
                return ['user' => 'Not Found'];
            }

            return $row;
        } catch (PDOException $e) {
            throw new RuntimeException('Query failed: ' . $e->getMessage());
        }
    }

    public function update(int $id, array $data): string
    {
        return 'string';
    }

    public function delete(int $id): mixed
    {
        return $this->softDelete($id);
    }

    private function establishConn()
    {
        $conn = new DatabaseConnection('php-oop');
        return $conn->connect();
    }
}
