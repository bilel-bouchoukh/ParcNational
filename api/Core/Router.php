<?php

namespace Core;

use Exception;

final class Router {
    public function init(): void {
        $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        
        $uriComponents = explode('/', str_replace('/ParcNational/api/', '', $url));
        $controllerName = ucfirst($uriComponents[0]) . 'Controller';
        
        $controllerClass = "App\\Controllers\\$controllerName";
        if (!class_exists($controllerClass)) {
            throw new Exception("La classe $controllerClass n'existe pas.");
        }
        
        $controller = new $controllerClass();
        $data = json_decode(file_get_contents('php://input'), true);
        
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                if (isset($uriComponents[1])) {
                    $controller->show($uriComponents[1]);
                } else {
                    $controller->index($_GET);
                }
                break;
                
            case 'POST':
                $controller->save($data);
                break;
                
            case 'PATCH':
            case 'PUT':
                $controller->edit((int)$uriComponents[1], $data);
                break;
                
            case 'DELETE':
                $controller->destroy($uriComponents[1]);
                break;
                
            default:
                throw new Exception("Invalid request method.");
        }
    }
}