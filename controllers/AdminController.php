<?php 

namespace Controllers;

use Model\AdminServicio;
use MVC\Router;

class AdminController {

    public static function index(Router $router){
        
        session_start();

        // esAdmin();

        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechas = explode('-', $fecha);

        if ( !checkdate($fechas[1], $fechas[2], $fechas[0])) {
            header('Location: /404');
        }

        //Consultar en la base de datos

        $consulta = "SELECT servicios.id, servicios.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, taxis.conductor, taxis.placa as taxi, taxis.tarifa  ";
        $consulta .= " FROM servicios  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON servicios.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN serviciosTaxis ";
        $consulta .= " ON serviciosTaxis.servicioId=servicios.id ";
        $consulta .= " LEFT OUTER JOIN taxis ";
        $consulta .= " ON taxis.id=serviciosTaxis.taxiId ";
        $consulta .= " WHERE fecha =  '$fecha' ";

        $servicios = AdminServicio::SQL($consulta);


        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios,
            'fecha' => $fecha
        ]);
    }

}

?>