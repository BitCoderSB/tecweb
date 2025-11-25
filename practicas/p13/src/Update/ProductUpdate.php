<?php
namespace P13\ProductApp\Update;

class ProductUpdate
{
    protected \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function update(int $id, array $data): bool
    {
        $fields = [];
        $params = [];
        foreach ($data as $k => $v) {
            $fields[] = "`$k` = :$k";
            $params[":$k"] = $v;
        }
        $params[':id'] = $id;
        $sql = 'UPDATE productos SET ' . implode(', ', $fields) . ' WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
}
