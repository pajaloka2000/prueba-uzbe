<?php

namespace Model;

class AdminServicio extends ActiveRecord{
    protected static $tabla = 'serviciostaxis';
    protected static $columnaDD = ['id', 'hora', 'cliente', 'email', 'telefono', 'conductor', 'placa', 'tarifa'];

    public $id;
    public $hora;
    public $cliente;
    public $email;
    public $telefono;
    public $conductor;
    public $taxi;
    public $tarifa;

    public function __construct()
    {
        $this->id = $args['id'] ?? null;
        $this->hora = $args['hora'] ?? '';
        $this->cliente = $args['cliente'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->conductor = $args['conductor'] ?? '';
        $this->taxi = $args['taxi'] ?? '';
        $this->tarifa = $args['tarifa'] ?? '';
        
    }
}


?>