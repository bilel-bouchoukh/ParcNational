<?php

namespace App\Models;

use Core\Database;

final class TypeLocationModel extends Database {

    public function __construct()
    {
        parent::__construct('type_location');
    }

    public function getAllTypeLocation(array $filters){
        return $this->readAll($filters);
    }
}