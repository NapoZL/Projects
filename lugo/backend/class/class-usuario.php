<?php 
    class Usuario{
        private $idUsuario;
        private $nombre;
        private $apellido;
        private $ordenes;

        public function __construct(
            $idUsuario,
            $nombre,
            $apellido,
            $ordenes
        )
        {
            $this->idUsuario= $idUsuario;
            $this->nombre= $nombre;
            $this->apellido= $apellido;
            $this->ordenes= $ordenes;
        }

        public static function obtenerUsuarios(){
            $contenidoArchivoUsuarios= file_get_contents('../data/usuarios.json');
            echo $contenidoArchivoUsuarios;
        }

        public static function obtenerUsuario($id){
            $contenidoArchivo= file_get_contents("../data/usuarios.json");
            $Usuarios= json_decode($contenidoArchivo,true);
            $usuario=null;
            for($i=0; $i<sizeof($Usuarios); $i++){
                if($Usuarios[$i]["idUsuario"]== $id){
                    $usuario= $Usuarios[$i];
                }
            }
            echo json_encode($usuario);
        }

        /**
         * Get the value of idUsuario
         */ 
        public function getIdUsuario()
        {
                return $this->idUsuario;
        }

        /**
         * Set the value of idUsuario
         *
         * @return  self
         */ 
        public function setIdUsuario($idUsuario)
        {
                $this->idUsuario = $idUsuario;

                return $this;
        }

        /**
         * Get the value of nombre
         */ 
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Set the value of nombre
         *
         * @return  self
         */ 
        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }

        /**
         * Get the value of apellido
         */ 
        public function getApellido()
        {
                return $this->apellido;
        }

        /**
         * Set the value of apellido
         *
         * @return  self
         */ 
        public function setApellido($apellido)
        {
                $this->apellido = $apellido;

                return $this;
        }

        /**
         * Get the value of ordenes
         */ 
        public function getOrdenes()
        {
                return $this->ordenes;
        }

        /**
         * Set the value of ordenes
         *
         * @return  self
         */ 
        public function setOrdenes($ordenes)
        {
                $this->ordenes = $ordenes;

                return $this;
        }
    }
?>