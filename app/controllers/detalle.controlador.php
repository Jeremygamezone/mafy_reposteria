<?php
 require_once '../app/models/venta.php';

    class DetalleControlador{
        private $model;

        public function __CONSTRUCT(){
            $this->model = new Venta();
        }

        public function Inicio(){
            require_once '../views/pages/header.php';
            require_once '../views/pages/venta/index.php';
            require_once '../views/pages/footer.php';
        }
    }
?>