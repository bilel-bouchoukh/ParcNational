<?php

namespace App\Models;

use Core\Database;

final class ReservationModel extends Database {

    public function __construct()
    {
        parent::__construct('reservation');
    }

    public function getReservation(int $id): array {
        $query = "
            SELECT *, users.firstname, users.lastname, location.name
            FROM  reservation
            INNER JOIN users ON users.id = reservation.fk_user
            INNER JOIN location ON location.id = reservation.fk_location
            WHERE reservation.id = :id
            LIMIT 1
        ";

        parent::sqlQuery($query, ['id' => $id]);
        return $this->stmt->fetch() ?? [];
    }

    public function getAllReservation($filters): array {
        $query = "
            SELECT *, users.firstname, users.lastname, location.name
            FROM  reservation
            INNER JOIN users ON users.id = reservation.fk_user
            INNER JOIN location ON location.id = reservation.fk_location
            WHERE reservation.id = :id
        ".parent::buildClauses($filters);

        parent::sqlQuery($query, $filters);
        return $this->stmt->fetchAll() ?? [];
    }

    public function createReservation($data): bool {
        return $this->create($data);
    }

    public function deleteReservation(int $id): bool {
        return $this->delete($id);
    }

    public function updateReservation(int $id, $data): bool {
        return $this->update($id, $data);
    }
}