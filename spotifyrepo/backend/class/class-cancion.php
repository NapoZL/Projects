<?php
    class Cancion{
        private $nombreCancion;
        private $duracion;

        public function __construct($nombreCancion,$duracion){
            $this->nombreCancion = $nombreCancion;
            $this->duracion = $duracion;
        }
        
        public function guardarCancion($codigoArtista, $codigoAlbum){
            $contenidoArchivoArtista= file_get_contents('../data/artistas.json');
            $artistas= json_decode($contenidoArchivoArtista, true);
    
            for($i=0; $i<sizeof($artistas); $i++){
                if($artistas[$i]['codigoArtista']== $codigoArtista){
                    for($j=0; $j<sizeof($artistas[$i]['albumes']); $j++){
                        if($j==$codigoAlbum){
                            $artistas[$i]['albumes'][$j]['canciones'][]= array(
                                "nombreCancion"=>$this->nombreCancion,
                                "duracion"=>$this->duracion
                            );
                        }
                    }
                }
            }
            $archivo = fopen('../data/artistas.json', 'w');
            fwrite($archivo, json_encode($artistas));
            fclose($archivo);
            echo '{"Mensaje":"Guardado con exito"}';
        }
    
        public static function eliminarCancion($codigoArtista, $codigoAlbum, $codigoCancion){
            $contenidoArchivoArtista= file_get_contents('../data/artistas.json');
            $artistas= json_decode($contenidoArchivoArtista, true);
    
            for($i=0; $i<sizeof($artistas); $i++){
                if($artistas[$i]['codigoArtista']== $codigoArtista){
                    for($j=0; $j<sizeof($artistas[$i]['albumes']); $j++){
                        if($j==$codigoAlbum){
                            for($k=0; $k<sizeof($artistas[$i]['albumes'][$j]['canciones']); $k++){
                                if($k==$codigoCancion){
                                    array_splice($artistas[$i]['albumes'][$j]['canciones'], $k, 1);
                                }
                            }
                        }
                    }
                }
            }
    
            $archivo = fopen('../data/artistas.json', 'w');
            fwrite($archivo, json_encode($artistas));
            fclose($archivo);
    
            echo '{"Mensaje":"Eliminado con exito"}';
        }

        /**
         * Get the value of nombreCancion
         */ 
        public function getNombreCancion()
        {
                return $this->nombreCancion;
        }

        /**
         * Set the value of nombreCancion
         *
         * @return  self
         */ 
        public function setNombreCancion($nombreCancion)
        {
                $this->nombreCancion = $nombreCancion;

                return $this;
        }

        /**
         * Get the value of duracion
         */ 
        public function getDuracion()
        {
                return $this->duracion;
        }

        /**
         * Set the value of duracion
         *
         * @return  self
         */ 
        public function setDuracion($duracion)
        {
                $this->duracion = $duracion;

                return $this;
        }
    }
?>