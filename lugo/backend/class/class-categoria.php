<?php
    class Categoria{
        private $nombreCategoria;
        private $descripcion;
        private $color;
        private $icono;
        private $empresas;

        public function __construct(
            $nombreCategoria,
            $descripcion,
            $color,
            $icono,
            $empresas
        )
        {
            $this->nombreCategoria= $nombreCategoria;
            $this->descripcion= $descripcion;
            $this->color= $color;
            $this->icono= $icono;
            $this->empresas= $empresas;
        }

        public static function obtenerCategorias(){
            $contenidoArchivoCategorias= file_get_contents('../data/categorias.json');
            echo $contenidoArchivoCategorias;
        }

        public function guardarCategoria(){
            $contenidoArchivoCategoria= file_get_contents('../data/categorias.json');
            $Categoria= json_decode($contenidoArchivoCategoria, true);
            $Categoria[] = array(
                "nombreCategoria"=> $this->nombreCategoria,
                "descripcion"=> $this->descripcion,
                "color"=> $this->color,
                "icono"=> $this->icono,
                "empresas"=> $this->empresas
                );
        
            $archivo = fopen('../data/categorias.json', 'w');
            fwrite($archivo, json_encode($Categoria));
            fclose($archivo);
        
            echo '{"Mensaje":"Guardado con exito"}';
        }           
        /**
         * Get the value of nombreCategoria
         */ 
        public function getNombreCategoria()
        {
                return $this->nombreCategoria;
        }

        /**
         * Set the value of nombreCategoria
         *
         * @return  self
         */ 
        public function setNombreCategoria($nombreCategoria)
        {
                $this->nombreCategoria = $nombreCategoria;

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
         * Get the value of color
         */ 
        public function getColor()
        {
                return $this->color;
        }

        /**
         * Set the value of color
         *
         * @return  self
         */ 
        public function setColor($color)
        {
                $this->color = $color;

                return $this;
        }

        /**
         * Get the value of icono
         */ 
        public function getIcono()
        {
                return $this->icono;
        }

        /**
         * Set the value of icono
         *
         * @return  self
         */ 
        public function setIcono($icono)
        {
                $this->icono = $icono;

                return $this;
        }

        /**
         * Get the value of empresas
         */ 
        public function getEmpresas()
        {
                return $this->empresas;
        }

        /**
         * Set the value of empresas
         *
         * @return  self
         */ 
        public function setEmpresas($empresas)
        {
                $this->empresas = $empresas;

                return $this;
        }
    }
?>