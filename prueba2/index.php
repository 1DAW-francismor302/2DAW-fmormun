<?php

/* Inicialización del entorno */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


/* Zona de declaración de funciones */
//Funciones de debugueo
function dump($var){
    echo '<pre>'.print_r($var,1).'</pre>';
}

//Función lógica presentación
function getTableroMArkup ($tablero, $personaje){
    $cont = 0;
    $output = '';
    //dump($tablero);
    foreach ($tablero as $filaIndex => $datosFila) {
        foreach ($datosFila as $columnaIndex => $tileType) {
            $cont++;
            //dump($tileType);
            if ($cont == $personaje) {
                $output .= '<div class = "tile ' . $tileType . '"><img src="./src/iron_man.webp" class="personaje"></div>';
            }else {
                $output .= '<div class = "tile ' . $tileType . '"></div>';
            }
        }
    }

    return $output;

}
//Lógica de negocio
//El tablero es un array bidimensional en el que cada fila contiene 12 palabras cuyos valores pueden ser:
// agua
//fuego
//tierra
// hierba


function leerArchivoCSV($archivoCSV) {
    $tablero = [];

    if (($puntero = fopen($archivoCSV, "r")) !== FALSE) {
        while (($datosFila = fgetcsv($puntero)) !== FALSE) {
            $tablero[] = $datosFila;
        }
        fclose($puntero);
    }

    return $tablero;
}

$tablero = leerArchivoCSV('contenido_tablero/contenido.csv');
$personaje = rand(0,143);
//Lógica de presentación
$tableroMarkup = getTableroMArkup($tablero, $personaje);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .contenedorTablero {
            width: 600px;
            height: 600px;
            border-radius: 5px;
            border: solid 2px grey;
            box-shadow: grey;
            display:grid;
            grid-template-columns: repeat(12, 1fr);
            grid-template-rows: repeat(12, 1fr);
        }
        .personaje {
            display: inline-block;
            width: 40px;
            height: 40px;
            position: relative;
            top: 5px;
            left: 5px;
        }
        .tile {
            /*width: 50px;
            height: 50px;*/
            float: left;
            margin: 0;
            padding: 0;
            border-width: 0;
            background-image: url("./src/464.jpg");
            background-size: 209px;
        }
        .fuego {
            background-position:103px -53px;
        }
        .tierra {
            background-position:51px -1px;
        }
        .agua {
            background-position:-54px -1px;
        }
        .hierba {
            background-position:208px 208px;
        }
    </style>
</head>
<body>
    <h1>Tablero juego super rol DWES</h1>
    <div class="contenedorTablero">
        <?php echo $tableroMarkup; ?>
    </div>
</body>
</html>