<?php

require_once 'modulos/variableSession.php';
$variable = new conectado();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .grilla {
            display: grid;
            grid-template-rows: auto 1fr auto;
            height: 100vh;
        }
    </style>
</head>
<body>
    <?php if($variable->estado()){ ?>
    <div class="container mx-auto w-full lg:w-2/4 grilla">
        <header class="bg-green-500 text-white font-semibold px-4 py-6">header</header>
        <main class="p-4 bg-gray-100">
            <h1 class="p-y-4 text-current text-xl font-semibold">Bienvenido <?php echo $variable->nombre; ?></h1> 
            <div class="flex justify-between mt-4">
                <span class="text-sm font-light">(<?php echo $variable->correo; ?>)</span>
                <a href="modulos/procesos/salir.php" class="text-gray-700 text-sm font-light hover:text-green-500">Cerrar sesion</a>
            </div>
            
        </main>
        <footer class="bg-green-500 text-white font-semibold px-4 py-6">footer</footer>
    </div>
    <?php }else{
        $variable->desconectado();
    } ?>
</body>
</html>