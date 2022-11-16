<?php

    header("Content-Type: application/json");
    include_once("../class/class-historia.php");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            //Guardar
        break;
        case 'GET':
            if(isset($_GET['idUsuario'])){
                Historia :: obtenerUsuariosHistorias($_GET['idUsuario']);
                
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