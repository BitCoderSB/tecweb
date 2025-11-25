<?php
namespace P13\ProductApp\Delete;

class ProductDelete
{
    protected \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM productos WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    public function softDelete(int $id): bool
    {
        $stmt = $this->pdo->prepare('UPDATE productos SET eliminado = 1 WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}
