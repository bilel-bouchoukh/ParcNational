<?php 

namespace App\Models;

use Core\Database;

final class FauneModel extends Database {

    public function __construct()
    {
        parent::__construct('faune');
    }

    public function getFaune(int $id){
        $query = 
            "
            SELECT * FROM faune
            WHERE id = :id
            LIMIT 1
            ";
        
        parent::sqlQuery($query, ['id' => $id]);
        return $this->stmt->fetch() ?? [];
    }

    public function getAllFaune($filters) {
        $query = 
        "
        SELECT * FROM faune
        ".parent::buildClauses($filters);

        parent::sqlQuery($query, $filters);
        return $this->stmt->fetchAll() ?? [];
    }

    public function createFaune(array $data){
        return $this->create($data);
    }

    public function deleteFaune(int $id) {
        return $this->delete($id);
    }

    public function updateFaune(int $id, array $data){
        return $this->update($id, $data);
    }
}