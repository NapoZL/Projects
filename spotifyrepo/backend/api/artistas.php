<?php
    header("Content-Type: application/json"); 
    include_once("../class/class-artista.php");
    $_POST = json_decode(file_get_contents('php://input'), true);
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $artista = new Artista(
                $_POST['codigoArtista'],
                $_POST['nombreArtista'],
                $_POST['albumes']
            );
            $artista->guardarArtista();
        break;
        case 'GET':
            if(isset($_GET['idArtista'])){
                Artista ::obtenerArtista($_GET['idArtista']);
            }else{
                Artista::obtenerArtistas();
            }
        break;
        case 'PUT':
            //Actualizar
        break;
        case 'DELETE':
            //eliminar
        break;
    }

?>