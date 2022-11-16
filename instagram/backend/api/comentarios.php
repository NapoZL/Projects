<?php

    header("Content-Type: application/json");
    include_once("../class/class-comentario.php");
    $_POST = json_decode(file_get_contents('php://input'), true);
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $comentario= new Comentario(
                $_POST['codigoComentario'],
                $_POST['codigoPost'],
                $_POST['usuario'],
                $_POST['comentario']
            );

            $comentario->guardarComentario();
        break;
        case 'GET':
            //Obtener
        break;
        case 'PUT':
            //Actualizar
            
        break;
        case 'DELETE':
            //Eliminar            
        break;

    }
?>