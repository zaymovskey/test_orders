<?php
declare(strict_types=1);

namespace App;

use PDO;

class ProductMapper
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getAll(): array
    {
        $sql = 'SELECT * FROM products';
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

}