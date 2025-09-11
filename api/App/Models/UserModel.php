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

    public function createUser($data){
        $fields = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_map(fn($k) => ":$k", array_keys($data)));
        $query = 
        "
            INSERT INTO users ($fields) VALUES ($placeholders)
            INNER JOIN acreditation ON acreditation.id = users.fk_acreditation
        ";
        return parent::sqlQuery($query, $data);
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