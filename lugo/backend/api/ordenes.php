<?php
    header("Content-Type: application/json");
    include_once("../class/class-orden.php");
    $_POST = json_decode(file_get_contents('php://input'),true);
    $_PUT = json_decode(file_get_contents('php://input'),true);

    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $orden = new Orden(
                $_POST["nombreProducto"],
                $_POST["descripcion"],
                $_POST["cantidad"],
                $_POST["precio"]
            );

            $orden -> agregarOrden($_GET['idUsuario']);
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
            //Eliminar
        break;

    }
?>