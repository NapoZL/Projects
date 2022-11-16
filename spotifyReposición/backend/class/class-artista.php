<?php
    class Artista{
        private $codigoArtista;
        private $nombreArtista;
        private $albumes;

        public function __construct(
                $codigoArtista,
                $nombreArtista,
                $albumes
        )
        {
                $this->codigoArtista= $codigoArtista;
                $this->nombreArtista= $nombreArtista;
                $this->albumes= $albumes;
        }

        public static function obtenerArtistas(){
                $contenidoArchivoArtistas= file_get_contents('../data/artistas.json');
                echo $contenidoArchivoArtistas;
        }

        public static function obtenerArtista($idArtista){
                $contenidoArchivoArtistas= file_get_contents('../data/artistas.json');
                $artistas= json_decode($contenidoArchivoArtistas, true);
                for($i=0; $i<sizeof($artistas); $i++){
                        if($artistas[$i]['codigoArtista']== $idArtista){
                                echo json_encode($artistas[$i]);
                        }
                }
        }

        public function guardarArtista(){
                $contenidoArchivoArtista= file_get_contents('../data/artistas.json');
                $artistas= json_decode($contenidoArchivoArtista, true);
                $artistas[] = array(
                        "codigoArtista"=> sizeof($artistas)+1,
                        "nombreArtista"=> $this->nombreArtista,
                        "albumes"=> []
                        );

                $archivo = fopen('../data/artistas.json', 'w');
                fwrite($archivo, json_encode($artistas));
                fclose($archivo);

                echo '{"Mensaje":"Guardado con exito"}';
        }

        /**
         * Get the value of codigoArtista
         */ 
        public function getCodigoArtista()
        {
                return $this->codigoArtista;
        }

        /**
         * Set the value of codigoArtista
         *
         * @return  self
         */ 
        public function setCodigoArtista($codigoArtista)
        {
                $this->codigoArtista = $codigoArtista;

                return $this;
        }

        /**
         * Get the value of nombreArtista
         */ 
        public function getNombreArtista()
        {
                return $this->nombreArtista;
        }

        /**
         * Set the value of nombreArtista
         *
         * @return  self
         */ 
        public function setNombreArtista($nombreArtista)
        {
                $this->nombreArtista = $nombreArtista;

                return $this;
        }

        /**
         * Get the value of albumes
         */ 
        public function getAlbumes()
        {
                return $this->albumes;
        }

        /**
         * Set the value of albumes
         *
         * @return  self
         */ 
        public function setAlbumes($albumes)
        {
                $this->albumes = $albumes;

                return $this;
        }
    }
?>