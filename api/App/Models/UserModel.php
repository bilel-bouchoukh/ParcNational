<?php 

namespace App\Models;

use Core\Database;

final class UserModel extends Database {

    public function __construct()
    {
        parent::__construct("users");
    }

    public function getUser(int $id){
        $query = 
        "
            SELECT *, acreditation.name
            FROM users
            INNER JOIN acreditation.id = users.fk_acreditation
            WHERE users.id = :id
            LIMIT 1
        ";

        parent::sqlQuery($query, ["id" => $id]);
        return $this->stmt->fetch() ?? [];
    }

    public function getAllUser(array $filters){
        $query = 
        "
            SELECT *, acreditation.name
            FROM users
            INNER JOIN acreditation ON acreditation.id = users.fk_acreditation 
        ".parent::buildClauses($filters);

        parent::sqlQuery($query, $filters);
        return $this->stmt->fetchAll() ?? [];
    }

    public function updateUser(int $id, array $data){
        $setters = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));
        $query = 
        "
            UPDATE users 
            SET $setters 
            INNER JOIN acreditation ON acreditation.id = users.fk_acreditation
            WHERE id = :id;
        ";

        return parent::sqlQuery($query, ["id" => $id]);
    }

    public function deleteUser(int $id){
        $query =
            "
            DELETE 
            FROM users 
            WHERE id = :id
            ";
        return parent::sqlQuery($query, ["id" => $id]);
    }
}