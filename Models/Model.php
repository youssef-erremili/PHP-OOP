<?php


class Model
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = $this->establishConn();
    }

    public function fetchAll($model, $message = "Query failed")
    {

        try {
            $statement = $this->pdo->query("SELECT * FROM $model Where deleted_at IS NULL");
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new RuntimeException($message . $e->getMessage());
        }
    }

    public function read(int $id, string $model, string $message = 'Desired record is not Found'): mixed
    {
        try {
            $statement = $this->pdo->query("SELECT * FROM $model WHERE id = $id AND deleted_at IS NULL");
            $row = $statement->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                return $message;
            }

            return $row;
        } catch (PDOException $e) {
            throw new RuntimeException('Query failed: ' . $e->getMessage());
        }
    }


    public function create(string $model, array $data, array $fillable): bool|string
    {
        try {
            $columns = implode(', ', $fillable);
            $placeholders = ':' . implode(', :', $fillable);

            $sql = "INSERT INTO $model ($columns, created_at, updated_at)
                VALUES ($placeholders, NOW(), Null)";

            $stmt = $this->pdo->prepare($sql);

            foreach ($fillable as $column) {
                $stmt->bindValue(':' . $column, $data[$column]);
            }

            $stmt->execute();

            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            throw new RuntimeException('Insert failed: ' . $e->getMessage());
        }
    }

    public function update(string $model, int $id, array $data, array $fillable): string
    {
        $setClause = implode(', ', array_map(fn($col) => "$col = :$col", $fillable));

        $sql = "UPDATE $model SET $setClause, updated_at = NOW() WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        foreach ($fillable as $col) {
            $stmt->bindValue(':' . $col, $data[$col]);
        }

        $stmt->bindValue(':id', $id);

        $stmt->execute();

        return "User updated successfully.";
    }


    public function fillable($fillable)
    {
        $setClause = implode(', ', array_map(fn($col) => "$col = :$col", $fillable));
        return $setClause;
    }

    protected function establishConn(): PDO
    {
        $conn = new DatabaseConnection('php-oop');
        return $conn->connect();
    }
}
