<?php 
    class Comentario{
        private $codigoComentario;
        private $codigoPost;
        private $usuario;
        private $comentario;

        public function __construct(
            $codigoComentario,
            $codigoPost,
            $usuario,
            $comentario
        )
        {
            $this->codigoComentario= $codigoComentario;
            $this->codigoPost= $codigoPost;
            $this->usuario= $usuario;
            $this->comentario= $comentario;
            
        }

        public function guardarComentario(){
            $contenidoArchivoComentarios= file_get_contents('../data/comentarios.json');
            $comentarios = json_decode($contenidoArchivoComentarios, true);
            $comentarios[]= array(
                "codigoComentario" => $this->codigoComentario,
                "codigoPost" => $this->codigoPost,
                "usuario" => $this->usuario,
                "comentario" => $this->comentario
            );
            $archivoComentarios=fopen('../data/comentarios.json', 'w');
            fwrite($archivoComentarios, json_encode($comentarios));
            fclose($archivoComentarios);

            echo '{"Mensaje":"Comentario agregado con exito"}';
        }

        /**
         * Get the value of codigoComentario
         */ 
        public function getCodigoComentario()
        {
                return $this->codigoComentario;
        }

        /**
         * Set the value of codigoComentario
         *
         * @return  self
         */ 
        public function setCodigoComentario($codigoComentario)
        {
                $this->codigoComentario = $codigoComentario;

                return $this;
        }

        /**
         * Get the value of codigoPost
         */ 
        public function getCodigoPost()
        {
                return $this->codigoPost;
        }

        /**
         * Set the value of codigoPost
         *
         * @return  self
         */ 
        public function setCodigoPost($codigoPost)
        {
                $this->codigoPost = $codigoPost;

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
         * Get the value of comentario
         */ 
        public function getComentario()
        {
                return $this->comentario;
        }

        /**
         * Set the value of comentario
         *
         * @return  self
         */ 
        public function setComentario($comentario)
        {
                $this->comentario = $comentario;

                return $this;
        }
    }
?>