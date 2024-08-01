<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para acceder</p>

<?php 
    include_once __DIR__ ."/../templates/alertas.php"
?>

<form action="/login" class="formulario" method="POST">

    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Tu email" value="<?php echo s($auth->email);?>">
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Tu password" >
    </div>

    <input type="submit" value="Acceder" class="boton">
</form>