<?php

    $Javi = ["Carmelo", "Domingo"];
    $Pablo = ["Javier", "Hugo"];
    $jefes = [
        "Javi" => $Javi,
        "Pablo" => $Pablo
    ];

    function mostrarLista($jefes) {
        foreach ($jefes as $clave => $valor) {
            echo "<li>" . $clave . "</li>";
            for ($i = 0; $i < count($valor); $i++) {
                echo "<ul>" . "<li>" . $valor[$i] . "</li>" . "</ul>";
            }
            
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>prueba 1</title>
</head>
<body>
    <h1>LISTA DE USUARIOS</h1>

    <ul>
        <?php
            mostrarLista($jefes);
        ?>
    </ul>
</body>
</html>