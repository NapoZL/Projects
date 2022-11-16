<?php
    header("Content-Type: application/json");
    include_once("../class/class-categoria.php");
    $_POST = json_decode(file_get_contents('php://input'),true);
    $_PUT = json_decode(file_get_contents('php://input'),true);

    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $categoria= new Categoria(
                $_POST['nombreCategoria'],
                $_POST['descripcion'],
                $_POST['color'],
                $_POST['icono'],
                $_POST['empresas']
            );

            $categoria->guardarCategoria();
        break;
        case 'GET':
            if(isset($_GET['id'])){
                //Obtener 
            }else{
                Categoria :: obtenerCategorias();
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