<?php

namespace App\Controllers;

use App\Models\FauneModel;

final class FauneController {

    private FauneModel $fauneModel;

    public function __construct()
    {
        $this->fauneModel = new FauneModel();
    }

    public function show(int $id){
        $results = $this->fauneModel->getFaune($id);
        if($results){
            json_encode([
                "success" => true,
                "data" => $results
            ]);
        }else {
            json_encode("Erreur lors de la récupération des données");
        }
    }

    public function index(array $filters) {
        $results = $this->fauneModel->getAllFaune($filters);
        if($results){
            json_encode([
                "success" => true,
                "data" => $results
            ]);
        }else{
            json_encode("Erreur lors de la récuperation des données");
        }
    }

    public function destroy(int $id){
        $results = $this->fauneModel->deleteFaune($id);
        if($results){
            json_encode([
                "success" => true,
                "Data supprimé" => $results
            ]);
        }else{
            json_encode("Erreur lors de la suppression des données");
        }
    }

    public function save(array $data){
        $results = $this->fauneModel->createFaune($data);
        if($results){
            json_encode([
                "success" => true,
                "Data créer" => $results
            ]);
        }else{
            json_encode("Erreur lors de la création");
        }
    }

    public function edit(int $id, array $data){
        $results = $this->fauneModel->updateFaune($id, $data);
        if($results){
            json_encode([
                "success" => true,
                "Data update" => $results
            ]);
        }else {
            json_encode("Erreur lors de la mise à jour");
        }
    }

}