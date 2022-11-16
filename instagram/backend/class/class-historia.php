<?php
    class Historia{
        private $codigoHistoria;
        private $codigoUsuario;
        private $usuario;
        private $imagenUsuario;
        private $historia;

        public function __construct(
            $codigoHistoria,
            $codigoUsuario,
            $usuario,
            $imagenUsuario,
            $historia
        )
        {

            $this->codigoHistoria=$codigoHistoria;
            $this->codigoUsuario=$codigoUsuario;
            $this->usuario=$usuario;
            $this->imagenUsuario=$imagenUsuario;
            $this->historia=$historia;
        }

        public static function obtenerUsuariosHistorias($codigoUsuario){
                $contenidoArchivoUsuarios= file_get_contents('../data/usuarios.json');
                $usuarios= json_decode($contenidoArchivoUsuarios, true);
                $usuario= null;
                for ($i=0; $i<sizeof($usuarios); $i++){
                        if($usuarios[$i]["codigoUsuario"]== $codigoUsuario){
                                $usuario = $usuarios[$i];
                        break;
                        }
                }

                $contenidoArchivoHistorias= file_get_contents('../data/historias.json');
                $historias= json_decode($contenidoArchivoHistorias, true);
                $usuariosHistorias = array();
                for ($i=0; $i<sizeof($historias); $i++){
                        if(in_array($historias[$i]["codigoUsuario"], $usuario["siguiendo"])){
                                $usuariosHistorias[]= $historias[$i];
                        }
                }
                echo json_encode($usuariosHistorias);
        }

        /**
         * Get the value of codigoHistoria
         */ 
        public function getCodigoHistoria()
        {
                return $this->codigoHistoria;
        }

        /**
         * Set the value of codigoHistoria
         *
         * @return  self
         */ 
        public function setCodigoHistoria($codigoHistoria)
        {
                $this->codigoHistoria = $codigoHistoria;

                return $this;
        }

        /**
         * Get the value of usuario
         */ 
        public function getUsuario()
        {
                return $this->usuario;
        }

        /**
         * Set the value of usuario
         *
         * @return  self
         */ 
        public function setUsuario($usuario)
        {
                $this->usuario = $usuario;

                return $this;
        }

        /**
         * Get the value of imagenUsuario
         */ 
        public function getImagenUsuario()
        {
                return $this->imagenUsuario;
        }

        /**
         * Set the value of imagenUsuario
         *
         * @return  self
         */ 
        public function setImagenUsuario($imagenUsuario)
        {
                $this->imagenUsuario = $imagenUsuario;

                return $this;
        }

        /**
         * Get the value of historia
         */ 
        public function getHistoria()
        {
                return $this->historia;
        }

        /**
         * Set the value of historia
         *
         * @return  self
         */ 
        public function setHistoria($historia)
        {
                $this->historia = $historia;

                return $this;
        }

        /**
         * Get the value of codigoUsuario
         */ 
        public function getCodigoUsuario()
        {
                return $this->codigoUsuario;
        }

        /**
         * Set the value of codigoUsuario
         *
         * @return  self
         */ 
        public function setCodigoUsuario($codigoUsuario)
        {
                $this->codigoUsuario = $codigoUsuario;

                return $this;
        }

    }
?>