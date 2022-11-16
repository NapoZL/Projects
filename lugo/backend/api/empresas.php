<?php
    header("Content-Type: application/json");
    include_once("../class/class-empresa.php");
    $_POST = json_decode(file_get_contents('php://input'),true);
    $_PUT = json_decode(file_get_contents('php://input'),true);

    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
          //Guardar
        break;
        case 'GET':
            if(isset($_GET['idCategoria'])){
                Empresa::obtenerEmpresas($_GET['idCategoria']);
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