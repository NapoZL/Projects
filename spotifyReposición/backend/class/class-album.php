<?php
    class Album{
        private $nombreAlbum;
        private $caratulaAlbum;
        private $canciones;

        public function __construct(
            $nombreAlbum,
            $caratulaAlbum,
            $canciones
        )
        {
            $this->nombreAlbum= $nombreAlbum;
            $this->caratulaAlbum= $caratulaAlbum;
            $this->canciones= $canciones;
        }

        public function guardarAlbum($codigoArtista){
                $contenidoArchivoArtista= file_get_contents('../data/artistas.json');
                $artistas= json_decode($contenidoArchivoArtista, true);

                for($i=0; $i<sizeof($artistas); $i++){
                    if($artistas[$i]['codigoArtista']== $codigoArtista){
                        $artistas[$i]['albumes'][] = array(
                            "nombreAlbum"=> $this->nombreAlbum,
                            "caratulaAlbum"=> $this-> caratulaAlbum,
                            "canciones"=>[]
                        );
                    }
                }

                $archivo = fopen('../data/artistas.json', 'w');
                fwrite($archivo, json_encode($artistas));
                fclose($archivo);

                echo '{"Mensaje":"Guardado con exito"}';
        }

        /**
         * Get the value of nombreAlbum
         */ 
        public function getNombreAlbum()
        {
                return $this->nombreAlbum;
        }

        /**
         * Set the value of nombreAlbum
         *
         * @return  self
         */ 
        public function setNombreAlbum($nombreAlbum)
        {
                $this->nombreAlbum = $nombreAlbum;

                return $this;
        }

        /**
         * Get the value of caratulaAlbum
         */ 
        public function getCaratulaAlbum()
        {
                return $this->caratulaAlbum;
        }

        /**
         * Set the value of caratulaAlbum
         *
         * @return  self
         */ 
        public function setCaratulaAlbum($caratulaAlbum)
        {
                $this->caratulaAlbum = $caratulaAlbum;

                return $this;
        }

        /**
         * Get the value of canciones
         */ 
        public function getCanciones()
        {
                return $this->canciones;
        }

        /**
         * Set the value of canciones
         *
         * @return  self
         */ 
        public function setCanciones($canciones)
        {
                $this->canciones = $canciones;

                return $this;
        }
    }
?>