<?php 

namespace App\Controllers;

use App\Models\LocationModel;

final class LocationController{
    private LocationModel $locationModel;

    public function __construct(){
        $this->locationModel = new LocationModel();
    }

    public function show(int $id){
        $results = $this->locationModel->getLocation($id);
        if($results){
            json_encode(["Les données sont récupéré " => $results]);
        }else{
            json_encode ("Erreur dans la récupération");
        }
    }

    public function index(array $filters) {
        $results = $this->locationModel->getAllLocation($filters);
        if($results) {
            json_encode([
                "success" => true,
                "Les données récupérer"  => $results
            ]);
        }else {
            json_encode("Erreur lors de la récupération");
        }
    }

    public function save(array $data){
        $results = $this->locationModel->createLocation($data);
        if($results){
            json_encode([
                "success" => true,
                "Les données insérer" => $results
            ]);
        }else{
            json_encode("Erreur lors de la créations des données");
        }
    }

    public function edit(int $id, $data) {
        $results = $this->locationModel->updateLocation($id, $data);
        if($results){
            json_encode([
                "success" => true,
                "Les données mise à jour" => $results
            ]);
        }
    }

    public function destroy(int $id) {
        $results = $this->locationModel->deleteLocation($id);
        if($results){
            json_encode([
                "success" => true,
                "Les données supprimer" => $results
        ]);
        }
    }

}