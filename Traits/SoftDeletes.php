<?php

trait SoftDeletes
{
    public function softDelete(int $id): mixed
    {
        $conn = new DatabaseConnection('php-oop');
        $pdo = $conn->connect();

        try {
            $sql = "UPDATE users SET deleted_at = NOW() WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new RuntimeException('Delete failed: ' . $e->getMessage());
        }
    }
}
