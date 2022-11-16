<?php
    class Orden{
        private $nombreProducto;
        private $descripcion;
        private $cantidad;
        private $precio;

        public function __construct(
            $nombreProducto,
            $descripcion,
            $cantidad,
            $precio
        )
        {
            $this->nombreProducto=$nombreProducto;
            $this->descripcion=$descripcion;
            $this->cantidad=$cantidad;
            $this->precio=$precio;
        }

        public function agregarOrden($idUsuario){
            $contenidoArchivoUsuarios= file_get_contents('../data/usuarios.json');
            $Usuarios= json_decode($contenidoArchivoUsuarios, true);

            for($i=0; $i<sizeof($Usuarios); $i++){
                if($Usuarios[$i]["idUsuario"]==$idUsuario){
                    $Usuarios[$i]["ordenes"][]= array(
                        "nombreProducto"=>$this->nombreProducto,
                        "descripcion"=>$this->descripcion,
                        "cantidad"=>$this->cantidad,
                        "precio"=>$this->precio
                    );
                }
            }

            $archivo = fopen('../data/usuarios.json', 'w');
            fwrite($archivo, json_encode($Usuarios));
            fclose($archivo);
        
            echo '{"Mensaje":"Guardado con exito"}';
        }

        /**
         * Get the value of nombreProducto
         */ 
        public function getNombreProducto()
        {
                return $this->nombreProducto;
        }

        /**
         * Set the value of nombreProducto
         *
         * @return  self
         */ 
        public function setNombreProducto($nombreProducto)
        {
                $this->nombreProducto = $nombreProducto;

                return $this;
        }

        /**
         * Get the value of descripcion
         */ 
        public function getDescripcion()
        {
                return $this->descripcion;
        }

        /**
         * Set the value of descripcion
         *
         * @return  self
         */ 
        public function setDescripcion($descripcion)
        {
                $this->descripcion = $descripcion;

                return $this;
        }

        /**
         * Get the value of cantidad
         */ 
        public function getCantidad()
        {
                return $this->cantidad;
        }

        /**
         * Set the value of cantidad
         *
         * @return  self
         */ 
        public function setCantidad($cantidad)
        {
                $this->cantidad = $cantidad;

                return $this;
        }

        /**
         * Get the value of precio
         */ 
        public function getPrecio()
        {
                return $this->precio;
        }

        /**
         * Set the value of precio
         *
         * @return  self
         */ 
        public function setPrecio($precio)
        {
                $this->precio = $precio;

                return $this;
        }
    }

?>