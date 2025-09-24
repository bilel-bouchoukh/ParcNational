<?php

namespace App\Controllers;

use App\Models\TypeLocationModel;

final class TypeLocationController{
    private TypeLocationModel $typeLocationModel;

    public function __construct()
    {
        $this->typeLocationModel = new TypeLocationModel();
    }

    public function index(array $filters) {
        $results = $this->typeLocationModel->getAllTypeLocation($filters);
        if($results) {
            echo json_encode([
                "success" => true,
                'data' => $results
            ]);
        } else {
            json_encode("Erreur lors de la récupération");
        }
    } 
}