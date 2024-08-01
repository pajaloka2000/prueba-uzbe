<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba - Uzbe</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=Open+Sans&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>

    <div class="contenedor-app">
        <div class="imagen">
            <div class="texto-cortado">
                <h2>Taxi Driver</h2>
            </div>
        </div>
        
        <div class="app">
            <?php echo $contenido; ?>
        </div>
    </div>

    <?php echo $script ?? ''; ?>

</body>
</html>