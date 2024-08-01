<h1 class="nombre-pagina">Solicita un nuevo servicio de taxi</h1>

<p class="descripcion-pagina">Elige tu taxi y coloca tus datos para el servicio</p>

<?php
    include_once __DIR__ . '/../templates/barra.php';
?>

<div id="app">
    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Taxis</button>
        <button type="button" data-paso="2">Informacion servicio</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>

    <div id="paso-1" class="seccion">
        <h2>Taxis</h2>
        <p class="text-center">elige tu taxi a continuacion</p>
        <div id="taxis" class="listado-taxis"></div>
    </div>
    <div id="paso-2" class="seccion">
        <h2>Tus datos y servicio</h2>
        <p class="text-center">Coloca tus datos y fecha de tu servicio</p>

        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" placeholder="Tu nombre" value="<?php echo $nombre; ?>" disabled>
            </div>
            <div class="campo">
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" min="<?php echo date('Y-m-d') ?>">
            </div>

            <div class="campo">
                <label for="hora">Hora:</label>
                <input type="time" id="hora">
            </div>
            <input type="hidden" id="id" value="<?php echo $id; ?>">
        </form>
    </div>
    <div id="paso-3" class="seccion contenido-resumen">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la informacion sea correcta</p>
    </div>

    <div class="paginacion">
        <button id="anterior" class="boton">&laquo; Anterior</button>
        <button id="siguiente" class="boton"> Siguiente &raquo;</button>
    </div>
</div>

<?php 
    $script =  "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script> <script src='build/js/app.js'></script>";
?>