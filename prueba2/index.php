<?php

/* Inicialización del entorno */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


/* Zona de declaración de funciones */
//Funciones de debugueo

//procesaRedirect();

function dump($var){
    echo '<pre>'.print_r($var,1).'</pre>';
}

//Función lógica presentación
function getTableroMArkup ($tablero, $personaje){
    $output = '';
    //dump($tablero);
    foreach ($tablero as $filaIndex => $datosFila) {
        foreach ($datosFila as $columnaIndex => $tileType) {
            //dump($tileType);
            if(isset($personaje)&&($filaIndex == $personaje['row'])&&($columnaIndex == $personaje['col'])){
                $output .= '<div class = "tile ' . $tileType . '"><img src="src/iron_man.webp" class="personaje"></div>';
            }else {
                $output .= '<div class = "tile ' . $tileType . '"></div>';
            }
        }
    }

    return $output;

}

// function getArrowsMarkup($personaje){
    
//     $arriba = "?row=". ($personaje["row"]-1) . "&col=" . ($personaje["col"]);
//     $abajo = "?row=". ($personaje["row"]+1) . "&col=" . ($personaje["col"]);
//     $derecha = "?row=". ($personaje["row"]) . "&col=" . ($personaje["col"]+1);
//     $izquierda = "?row=". ($personaje["row"]) . "&col=" . ($personaje["col"]-1);
    
//     $output = '
//         <a href="' . $arriba . '"><button>Arriba</button></a><br>
//         <a href="' . $abajo . '"><button>Abajo</button></a><br>
//         <a href="' . $derecha . '"><button>Derecha</button></a><br>
//         <a href="' . $izquierda . '"><button>Izquierda</button></a>
//     ';
    
//     return $output;
// }

function getMensajeMarkup ($arrayMensajes){
    $output = ' ';

    foreach ($arrayMensajes as $mensaje){
        $output .= '<p>' .$mensaje. '</p>';
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

// function procesaRedirect() {
//     if (!isset($_GET['col'])&&!isset($_GET['row'])) {
//         header('Location: ./index.php?row=0&col=0');
//     }
// }

function leerInput(){
    $col = filter_input(INPUT_GET, 'col', FILTER_VALIDATE_INT);
    $row = filter_input(INPUT_GET, 'row', FILTER_VALIDATE_INT);

   
    return (isset($col) && is_numeric($col) && isset($row) && is_numeric($row))? array(
        'row' => $row,
        'col' => $col
    ) : null;    
}

function getMensaje ($personaje){

    if (!isset($personaje)){
        return array('La posición del personaje no está bien definida');
    }

    return array(' ');
}

$personaje = leerInput();
$tablero = leerArchivoCSV('contenido_tablero/contenido.csv');
$mensaje = getMensaje($personaje);
//Lógica de presentación
$tableroMarkup = getTableroMArkup($tablero, $personaje);
$mensajesUsuarioMarkup = getMensajeMarkup ($mensaje);


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
    <br>
    <div>
        <?php echo $mensajesUsuarioMarkup; ?>
    </div>
    <br>
    <div>
        <?php echo getArrowsMarkup($personaje); ?>
    </div>
</body>
</html>