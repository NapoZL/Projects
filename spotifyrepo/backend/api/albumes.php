<?php
    header("Content-Type: application/json"); 
    include_once("../class/class-album.php");
    $_POST = json_decode(file_get_contents('php://input'),true);
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $album = new Album(
                $_POST['nombreAlbum'],
                $_POST['caratulaAlbum'],
                $_POST['canciones']
            );
            $album->guardarAlbum($_GET['codigoArtista']);
        break;
        case 'GET':
            if(isset($_GET['id'])){
            }else{
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