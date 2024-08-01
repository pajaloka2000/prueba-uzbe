<?php 

namespace Controllers;

use Model\Servicio;
use Model\ServicioTaxi;
use Model\Taxi;

class ApiController {

    public static function index(){
        $servicios = Taxi::all();

        echo json_encode($servicios);

    }

    public static function guardar(){
        
        //Almacenar el servicio y devolver el id
        $servicio = new Servicio($_POST);
        $resultado = $servicio->guardar();

        $id = $resultado['id'];

        //Almacenar los taxis con el id del servicio
        $idTaxis = explode(",", $_POST['taxis']);

        foreach($idTaxis as $idTaxi){
            $args = [
                'servicioId' => $id,
                'taxiId' => $idTaxi
            ];
            $servicioTaxi = new ServicioTaxi($args);
            $servicioTaxi->guardar();
        }

        echo json_encode(['resultado' => $resultado]);
    }

    public static function eliminar(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            $servicio = Servicio::find($id);
            $servicio->eliminar();
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }

}

?>