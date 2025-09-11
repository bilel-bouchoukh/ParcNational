<?php

namespace App\Models;

use Core\Database;

final class FloreModel extends Database {

    public function __construct()
    {
        parent::__construct("flore");
    }

    public function getFlore(int $id){
        $query =
        "
            SELECT * FROM flore
            WHERE id = :id
            LIMIT 1
        ";

        parent::sqlQuery($query, ['id' => $id]);
        return $this->stmt->fetch() ?? [];
    }

    public function getAllFlore(array $filters){
        $query = 
        "
            SELECT * FROM flore
        ".parent::buildClauses($filters);

        parent::sqlQuery($query, $filters);
        return $this->stmt->fetchAll() ?? [];
    }

    public function updateFlore(int $id, array $data){
        return $this->update($id, $data);
    }

    public function deleteFlore(int $id){
        return $this->delete($id);
    }

    public function createFlore(array $data){
        return $this->create($data);
    }
}