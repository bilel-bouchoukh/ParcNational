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
            print_r(["Les données sont récupéré " => $results]);
        }else{
            echo ("Erreur dans la récupération");
        }
    }

}