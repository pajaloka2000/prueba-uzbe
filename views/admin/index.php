<h1 class="nombre-pagina">Panel de administrador</h1>

<?php
    include_once __DIR__ . '/../templates/barra.php';
?>

<h2>Buscar servicios</h2>

<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $fecha; ?>">
        </div>
    </form>
</div>

<?php
    if (count($servicios) === 0) {
        echo "<h2>No hay servicios en esta fecha</h2>";
    }
?>

<div class="servicios-admin">
    <ul class="servicios">
        <?php 
            $idServicio = 0;
            foreach($servicios as $key => $servicio){
                if($idServicio !== $servicio->id){
                    $total = 0; ?>
                <li>
                    <p>Id: <span><?php echo $servicio->id; ?></span></p>
                    <p>Hora: <span><?php echo $servicio->hora; ?></span></p>
                    <p>Cliente: <span><?php echo $servicio->cliente; ?></span></p>
                    <p>Email: <span><?php echo $servicio->email; ?></span></p>
                    <p>Telefono: <span><?php echo $servicio->telefono; ?></span></p>

                    <h3>Taxis</h3>
                    <?php $idServicio = $servicio->id;
                }
                $total += $servicio->tarifa; ?>
                <p>
                    <span>Conductor: </span><?php echo $servicio->conductor;?>
                    <span>Placa: </span><?php echo $servicio->taxi;?> 
                    <span>Tarifa: </span><?php echo $servicio->tarifa;?>
                </p>


                <?php 
                    $actual = $servicio->id;
                    $proximo = $servicios[$key + 1]->id ?? 0;
                    
                    if(esUltimo($actual, $proximo)) {?>
                        <p class="total">Total: <span>$<?php echo $total; ?></span></p>
                        <form action="/api/eliminar" method="POST">
                            <input type="hidden" name="id" value="<?php echo $servicio->id; ?>">
                            <input type="submit" class="boton-eliminar" value="eliminar">
                        </form>
                <?php }
            } //fin del foreach ?>
    </ul>
</div>

<?php $script = "<script src='build/js/buscador.js'></script>"?>
