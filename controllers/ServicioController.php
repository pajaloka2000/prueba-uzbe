<?php 

namespace Controllers;

use MVC\Router;

class ServicioController {

    public static function index(Router $router){
        
        session_start();

        // estaAutenticado();

        $router->render('servicio/index',[
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id']
        ]);
    }

}

?>