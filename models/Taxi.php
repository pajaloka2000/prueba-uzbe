<?php 

namespace Model;

class Taxi extends ActiveRecord{
    
    protected static $tabla = 'taxis';
    protected static $columnasDB = ['id', 'conductor', 'placa', 'disponibilidad', 'tarifa'];

    public $id;
    public $conductor;
    public $placa;
    public $disponibilidad;
    public $tarifa;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->conductor = $args['conductor'] ?? '';
        $this->placa = $args['placa'] ?? '';
        $this->disponibilidad = $args['disponibilidad'] ?? 0;
        $this->tarifa = $args['tarifa'] ?? 0;
    }

    public function validarTaxi(){
        if (!$this->conductor) {
            self::$alertas['error'][] = 'El nombre del conductor del taxi es obligatorio';
        }
        if (!$this->placa) {
            self::$alertas['error'][] = 'La placa del taxi es obligatoria';
        }
        if (!$this->tarifa) {
            self::$alertas['error'][] = 'La tarifa del taxi es obligatoria';
        }
        return self::$alertas;
    }

}


?>