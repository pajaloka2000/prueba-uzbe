<h1 class="nombre-pagina">Taxis</h1>

<p class="descripcion-pagina">Administracion de taxis</p>

<?php
    include_once __DIR__ . '/../templates/barra.php';
?>

<ul class="taxis">
    <?php foreach ($taxis as $taxi) {?>
        <li>
            <p>Conductor: <span><?php echo $taxi->conductor; ?></span></p>
            <p>Placa: <span>$<?php echo $taxi->placa; ?></span></p>
            <p>Tarifa: <span>$<?php echo $taxi->tarifa; ?></span></p>

            <div class="acciones">
                <a href="/taxis/actualizar?id=<?php echo $taxi->id; ?>" class="boton">Actualizar</a>
                <form action="/taxis/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $taxi->id; ?>">
                    <input type="submit" class="boton-eliminar" value="eliminar">
                </form>
            </div>
        </li>   
    <?php } ?>

</ul>
