<?php
    class Post{
        private $codigoPost;
        private $codigoUsuario;
        private $contenidoPost;
        private $imagen;
        private $cantidadLikes;

        public function __construct(
        $codigoPost,
        $codigoUsuario,
        $contenidoPost,
        $imagen,
        $cantidadLikes)
        {
            $this->codigoPost= $codigoPost;
            $this->codigoUsuario= $codigoUsuario;
            $this->contenidoPost= $contenidoPost;
            $this->imagen= $imagen;
            $this->cantidadLikes= $cantidadLikes;
        }

        public static function obtenerCantidadPost(){
            $contenidoArchivoPosts= file_get_contents('../data/posts.json');
            echo $contenidoArchivoPosts;
        }

        public static function obtenerPosts($idUsuario){
            $contenidoArchivo= file_get_contents('../data/usuarios.json');
            $usuarios= json_decode($contenidoArchivo, true);
            $usuario= null;
            for($i=0; $i<sizeof($usuarios); $i++){
                if($usuarios[$i]["codigoUsuario"]==$idUsuario){
                    $usuario=$usuarios[$i];
                break;
                }
            }

            $contenidoArchivoComentarios = file_get_contents('../data/comentarios.json');
            $comentarios = json_decode($contenidoArchivoComentarios, true);

            $resultadoPost= array();
            $contenidoArchivoPosts= file_get_contents('../data/posts.json');
            $posts= json_decode($contenidoArchivoPosts, true);
            for($i=0; $i<sizeof($posts); $i++){
                if(in_array($posts[$i]["codigoUsuario"], $usuario["siguiendo"])){
                    $posts[$i]["comentarios"]= array();
                    for($j=0; $j<sizeof($comentarios); $j++){
                        if($posts[$i]["codigoPost"]== $comentarios[$j]["codigoPost"]){
                            $posts[$i]["comentarios"][]= $comentarios[$j];
                        }
                    }
                    for($j=0; $j<sizeof($usuarios); $j++){
                        if($posts[$i]["codigoUsuario"]== $usuarios[$j]["codigoUsuario"]){
                            $posts[$i]["nombre"]= $usuarios[$j]['nombre'];
                            $posts[$i]["imagenPerfilUsuario"]= $usuarios[$j]['imagen'];
                        }
                    }

                    $resultadoPost[]= $posts[$i];
                }
            }    
            echo json_encode($resultadoPost);
        }

        public function guardarPost(){
            $contenidoArchivoPosts= file_get_contents('../data/posts.json');
            $posts= json_decode($contenidoArchivoPosts, true);
            $posts[] = array(
                "codigoPost"=> $this->codigoPost,
                "codigoUsuario"=> $this->codigoUsuario,
                "contenidoPost"=> $this->contenidoPost,
                "imagen"=> $this->imagen,
                "cantidadLikes"=> $this->cantidadLikes
            );

            $archivo = fopen('../data/posts.json', 'w');
            fwrite($archivo, json_encode($posts));
            fclose($archivo);

            echo '{"Mensaje":"Post guardado con exito"}';

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

        /**
         * Get the value of contenidoPost
         */ 
        public function getContenidoPost()
        {
                return $this->contenidoPost;
        }

        /**
         * Set the value of contenidoPost
         *
         * @return  self
         */ 
        public function setContenidoPost($contenidoPost)
        {
                $this->contenidoPost = $contenidoPost;

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
         * Get the value of cantidadLikes
         */ 
        public function getCantidadLikes()
        {
                return $this->cantidadLikes;
        }

        /**
         * Set the value of cantidadLikes
         *
         * @return  self
         */ 
        public function setCantidadLikes($cantidadLikes)
        {
                $this->cantidadLikes = $cantidadLikes;

                return $this;
        }
    }
?>