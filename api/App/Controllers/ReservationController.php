<?php

namespace App\Controllers;

use App\Models\ReservationModel;

final class ReservationController {
    private ReservationModel $reservationModel;

    public function __construct()
    {
        $this->reservationModel = new ReservationModel();
    }

    public function show(int $id){
        $results = $this->reservationModel->getReservation($id);
        if ($results) {
            json_encode([
                "success" => true,
                "data"=> $results
            ]);
        } else {
            json_encode("Erreur lors de la récupéraration");
        }
    }

    public function index(array $filters) {
        $results = $this->reservationModel->getAllReservation($filters);
        if($results) {
            json_encode([
                "success" => true,
                "data" => $results
            ]);
        } else {
            json_encode("Erreur lors de la récupération");
        }
    }

    public function save($data) {
        $results = $this->reservationModel->createReservation($data);
        if($results) {
            json_encode([
                "success" => true,
                "data save" => $results
            ]);
        } else{
            json_encode("Erreur lors de la sauvegarde des données");
        }
    }

    public function edit(int $id, array $data){
        $results = $this->reservationModel->updateReservation($id, $data);

        if($results) {
            json_encode([
                "success" => true,
                "data updated" => $results
            ]);
        } else {
            json_encode("Erreur lors de la mise à jour des données");
        }
    }
}