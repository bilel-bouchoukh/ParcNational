<?php

namespace App\Models;

use Core\Database;

final class TypeLocationModel extends Database {

    public function __construct()
    {
        parent::__construct('type_location');
    }

    public function getAllTypeLocation(array $filters){
        $query =
        "
            SELECT name 
            FROM type_location
        ".parent::buildClauses($filters);

        parent::sqlQuery($query, $filters);
        return $this->stmt->fetchAll() ?? [];
    }
}