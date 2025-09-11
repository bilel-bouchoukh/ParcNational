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
        $fields = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_map(fn($k) => ":$k", array_keys($data)));
        $query = 
        "
            INSERT INTO location ($fields) VALUES ($placeholders)
            INNER JOIN type_location ON type_location.id = location.fk_type_location
        ";
        return parent::sqlQuery($query, $data);
    }

    public function updateLocation(int $id, $data): bool {
        $setters = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));
        $query = 
        "
            UPDATE Location 
            SET $setters 
            INNER JOIN type_location ON type_location.id = location.fk_type_location
            WHERE id = :id;
        ";

        return parent::sqlQuery($query, ["id" => $id]);
    }

    public function deleteLocation(int $id): bool {
        return $this->delete($id);
    }


}
