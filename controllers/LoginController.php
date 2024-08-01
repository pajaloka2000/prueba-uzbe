<?php 

namespace Controllers;

use Model\Usuario;
use MVC\Router;

class LoginController{

    public static function crear(Router $router){
        $usuario = new Usuario($_POST);

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
           $usuario->sincronizar($_POST);
           $alertas = $usuario->validarNuevaCuenta();

           if(empty($alertas)){
                $resultado = $usuario->existeUsuario();
                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                }else{
                    $resultado = $usuario->guardar();

                    if($resultado){
                        header('Location: /login');
                    }
                }
           }
        }

        $router->render('auth/crear_cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function login(Router $router){

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            if (empty($alertas)) {
                $usuario = Usuario::where('email', $auth->email);

                if($usuario){
                    if($usuario->comprobarPassword($auth->password)){
                        //Autenticar el usuario
                        session_start();

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        if($usuario->admin === "1"){
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        }else{
                            header('Location: /servicio');
                        }
                    }
                }else{
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                }
            }

        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/login', [
            'alertas' => $alertas,
            'auth' => $auth
        ]);
    }


    public static function logout(){
        session_start();

        $_SESSION = [];

        header('Location: /login');
    }
}



?>