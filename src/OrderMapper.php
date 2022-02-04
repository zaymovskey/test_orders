<?php
declare(strict_types=1);

namespace App;

use PDO;

class OrderMapper
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getAll(): array
    {
        $sql = 'SELECT orders.*, products.* FROM orders INNER JOIN products ON product_id = products.id ORDER BY at_create DESC';
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function add(array $data): void
    {
        $sql = 'INSERT INTO orders (name, address, phone, product_id) VALUES (:name, :address, :phone, :product)';
        $statement = $this->connection->prepare($sql);
        $statement->execute($data);
    }

}