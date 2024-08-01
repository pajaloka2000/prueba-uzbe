<div class="barra">
    <p><span>Hola: </span> <?php echo $nombre ?? ''; ?></p>
    <a class="boton" href="/logout">Cerrar sesion</a>
</div>

<?php if (isset($_SESSION['admin'])) {?>
        <div class="barra-taxis">
            <a class="boton" href="/admin">Ver servicios</a>
            <a class="boton" href="/taxis">Ver taxis</a>
            <a class="boton" href="/taxis/crear">Agregar taxis</a>
        </div>
<?php } ?>