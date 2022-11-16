<?php
    class Empresa{
        private $idEmpresa;
        private $nombreEmpresa;
        private $imagen;
        private $productos;

        public function __construct(
            $idEmpresa,
            $nombreEmpresa,
            $imagen,
            $productos
        )
        {
            $this->idEmpresa= $idEmpresa;
            $this->nombreEmpresa= $nombreEmpresa;
            $this->imagen= $imagen;
            $this->productos= $productos;
        }

        public static function obtenerEmpresas($idCategoria){
            $resultadoEmpresas= array();
            $contenidoArchivoEmpresas= file_get_contents("../data/empresas.json");
            $Empresas= json_decode($contenidoArchivoEmpresas,true);
            $Empresa=null;

            $contenidoArchivoCategorias= file_get_contents("../data/categorias.json");
            $Categorias= json_decode($contenidoArchivoCategorias,true);
            $categoria=null;
            for($i=0; $i<sizeof($Categorias); $i++){
                if($i== $idCategoria){
                    $categoria= $Categorias[$i];
                break;
                }
            }

            for($i=0; $i<sizeof($Empresas); $i++){
                if(in_array($Empresas[$i]["idEmpresa"], $categoria["empresas"])){
                    $resultadoEmpresas[]= $Empresas[$i];
                }
            }
            echo json_encode($resultadoEmpresas);
        }

        /**
         * Get the value of idEmpresa
         */ 
        public function getIdEmpresa()
        {
                return $this->idEmpresa;
        }

        /**
         * Set the value of idEmpresa
         *
         * @return  self
         */ 
        public function setIdEmpresa($idEmpresa)
        {
                $this->idEmpresa = $idEmpresa;

                return $this;
        }

        /**
         * Get the value of nombreEmpresa
         */ 
        public function getNombreEmpresa()
        {
                return $this->nombreEmpresa;
        }

        /**
         * Set the value of nombreEmpresa
         *
         * @return  self
         */ 
        public function setNombreEmpresa($nombreEmpresa)
        {
                $this->nombreEmpresa = $nombreEmpresa;

                return $this;
        }

        /**
         * Get the value of imagen
         */ 
        public function getImagen()
        {
                return $this->imagen;
        }

        /**
         * Set the value of imagen
         *
         * @return  self
         */ 
        public function setImagen($imagen)
        {
                $this->imagen = $imagen;

                return $this;
        }

        /**
         * Get the value of productos
         */ 
        public function getProductos()
        {
                return $this->productos;
        }

        /**
         * Set the value of productos
         *
         * @return  self
         */ 
        public function setProductos($productos)
        {
                $this->productos = $productos;

                return $this;
        }
    }
?>