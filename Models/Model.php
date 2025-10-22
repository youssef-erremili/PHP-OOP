<?php


class Model
{
    public function read(string $model, int $id, string $message = 'Desired record is not Found'): mixed
    {
        $pdo = $this->establishConn();

        try {
            $statement = $pdo->query("SELECT * FROM $model WHERE id = $id AND deleted_at IS NULL");
            $row = $statement->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                return $message;
            }

            return $row;
        } catch (PDOException $e) {
            throw new RuntimeException('Query failed: ' . $e->getMessage());
        }
    }


    protected function establishConn(): PDO
    {
        $conn = new DatabaseConnection('php-oop');
        return $conn->connect();
    }
}
