<?php 

namespace Controllers;

use Model\Taxi;
use MVC\Router;

class TaxisController {

    public static function index(Router $router){
        session_start();

        // esAdmin();
        $taxis = Taxi::all();
        $router->render('/taxis/index',[
            'nombre' => $_SESSION['nombre'],
            'taxis' => $taxis
        ]);
    }

    public static function crear(Router $router){
        session_start();
        // esAdmin();

        $taxi = new taxi;
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $taxi->sincronizar($_POST);

            $alertas = $taxi->validar();

            if(empty($alertas)){
                $taxi->guardar();
                header('Location: /taxis');
            }
        }
        $router->render('/taxis/crear',[
            'nombre' => $_SESSION['nombre'],
            'taxi' => $taxi,
            'alertas' => $alertas

        ]);
    }

}

?>