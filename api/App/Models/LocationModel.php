<?php

namespace App\Models;

use Core\Database;

final class LocationModel extends Database {
    public function __construct()
    {
        parent::__construct('location');
    }

    public function getLocation(int $id): array {
        $query ="
            SELECT *, type_location.name 
            FROM location 
            INNER JOIN type_location ON type_location.id = location.fk_type_location
            WHERE location.id = :id
            LIMIT 1
        " ;

        parent::sqlQuery($query, ['id' => $id]);
        return $this->stmt->fetch() ?? [];
    }

    public function getAllLocation(array $filters): array {
        $query ="
        SELECT *, type_location.name 
        FROM location 
        INNER JOIN type_location ON type_location.id = location.fk_type_location
        ".parent::buildClauses($filters);

        parent::sqlQuery($query, $filters);
        return $this->stmt->fetchAll() ?? [];
    }

    public function createLocation($data): bool {
        return $this->create($data);
    }

    public function updateLocation(int $id, $data): bool {
        return $this->update($id, $data);
    }

    public function deleteLocation(int $id): bool {
        return $this->delete($id);
    }


}
