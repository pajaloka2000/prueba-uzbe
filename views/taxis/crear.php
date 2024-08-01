<h1 class="nombre-pagina">Agregar taxi</h1>

<p class="descripcion-pagina">Agrega un nuevo taxi</p>

<?php
    include_once __DIR__ . '/../templates/barra.php';
    include_once __DIR__ . '/../templates/alertas.php';

?>

<form action="/taxis/crear" method="POST" class="formulario">

    <?php include_once __DIR__ . '/formulario.php'; ?>

    <input type="submit" class="boton" value="Guardar taxi">

</form>