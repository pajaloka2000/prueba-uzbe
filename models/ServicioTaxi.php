<?php

namespace Model;

class ServicioTaxi extends ActiveRecord{
    protected static $tabla = 'serviciostaxis';
    protected static $columnasDB = ['id', 'servicioId', 'taxiId'];

    public $id;
    public $servicioId;
    public $taxiId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->servicioId = $args['servicioId'] ?? '';
        $this->taxiId = $args['taxiId'] ?? '';
        
    }
}


?>