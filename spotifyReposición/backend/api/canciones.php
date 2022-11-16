<?php

    header("Content-Type: application/json");
    include_once("../class/class-cancion.php");
    $_POST = json_decode(file_get_contents('php://input'), true);
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $cancion= new Cancion(
                $_POST['nombreCancion'],
                $_POST['duracion']
            );

            $cancion->guardarCancion($_GET['codigoArtista'], $_GET['codigoAlbum']);
        break;
        case 'GET':
            //Obtener
        break;
        case 'PUT':
            //Actualizar
            
        break;
        case 'DELETE':
            Cancion :: eliminarCancion($_GET['codigoArtista'], $_GET['codigoAlbum'], $_GET['codigoCancion']);            
        break;

    }
?>