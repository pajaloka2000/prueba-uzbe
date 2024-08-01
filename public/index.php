<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\ApiController;
use Controllers\LoginController;
use Controllers\ServicioController;
use Controllers\TaxisController;
use MVC\Router;
$router = new Router();

//Registro y Login

    //Crear cuenta
        $router->get('/crear_cuenta', [LoginController::class, 'crear']);
        $router->post('/crear_cuenta', [LoginController::class, 'crear']);

    //Iniciar sesion
        $router->get('/login', [LoginController::class, 'login']);
        $router->post('/login', [LoginController::class, 'login']);
        $router->get('/logout', [LoginController::class, 'logout']);

//Area de usuario cuando ya se ha logueado

    $router->get('/servicio', [ServicioController::class, 'index']);
    
    //API de servicios 
    
        $router->get('/api/taxis', [ApiController::class, 'index']);
        $router->post('/api/servicios', [ApiController::class, 'guardar']);
        $router->post('/api/eliminar', [ApiController::class, 'eliminar']);

//Area de Admin

    $router->get('/admin', [AdminController::class, 'index']);
    
    //Crud de Taxis
        $router->get('/taxis', [TaxisController::class, 'index']);
        $router->get('/taxis/crear', [TaxisController::class, 'crear']);
        $router->post('/taxis/crear', [TaxisController::class, 'crear']);
        $router->get('/taxis/actualizar', [TaxisController::class, 'actualizar']);
        $router->post('/taxis/actualizar', [TaxisController::class, 'actualizar']);
        $router->post('/taxis/eliminar', [TaxisController::class, 'eliminar']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();