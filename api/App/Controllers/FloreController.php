<?php

namespace App\Controllers;

use App\Models\FloreModel;

final class FloreController {

    private FloreModel $floreModel;

    public function __construct()
    {
        $this->floreModel = new FloreModel();
    }

    public function index(array $filters)
    {
        $results = $this->floreModel->getAllFlore($filters);
        if($results){
            json_encode([
                "success" => true,
                "data" => $results
            ]);
        }else {
            json_encode("Erreur lors de la récupération des données");
        }
    }

    public function show(int $id){

        $results = $this->floreModel->getFlore($id);
        if($results){
            json_encode([
                "success" => true,
                "data" => $results
            ]);
        }else {
            json_encode("Erreur lors de la récupération des données");
        }
    }

    public function destroy(int $id){
        $results = $this->floreModel->deleteFlore($id);
        if($results){
            json_encode([
                "success" => true,
                "data supprimé" => $results
            ]);
        }else{
            json_encode("Erreur lors de la suppression");
        }
    }

    public function save(array $data){
        $results = $this->floreModel->createFlore($data);
        if($results){
            json_encode([
                "success" => true,
                "data créer" => $results
            ]);
        }else{
            json_encode("Erreur lors de l'insertion des données");
        }
    }

    public function edit(array $data, int $id){
        $results = $this->floreModel->updateFlore($id, $data);
        if($results){
            json_encode([
                "success" => true,
                "data modifé" => $results
            ]);
        }else{
            json_encode("Erreur lors de la modification des données");
        }
    }

}