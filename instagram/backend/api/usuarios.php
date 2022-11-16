<?php

    header("Content-Type: application/json");
    include_once("../class/class-usuario.php");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            //Guardar
        break;
        case 'GET':
            if(isset($_GET['id'])){
                Usuario ::obtenerUsuario($_GET['id']);
                
            }else{
                Usuario::obtenerUsuarios();
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