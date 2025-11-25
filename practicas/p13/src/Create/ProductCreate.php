<?php
namespace P13\ProductApp\Create;

class ProductCreate
{
    protected \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(array $data): int
    {
        $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado)
                VALUES (:nombre, :marca, :modelo, :precio, :detalles, :unidades, :imagen, :eliminado)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $data['nombre'] ?? null,
            ':marca' => $data['marca'] ?? null,
            ':modelo' => $data['modelo'] ?? null,
            ':precio' => $data['precio'] ?? 0,
            ':detalles' => $data['detalles'] ?? null,
            ':unidades' => $data['unidades'] ?? 1,
            ':imagen' => $data['imagen'] ?? 'img/default.png',
            ':eliminado' => $data['eliminado'] ?? 0,
        ]);

        return (int)$this->pdo->lastInsertId();
    }
}
