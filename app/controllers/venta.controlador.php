<?php
    require_once '../app/models/venta.php';
    require_once '../app/models/detalle.php';

    class VentaControlador{
        private $model;
        private $detalleModel;

        public function __CONSTRUCT(){
            $this->model = new Venta();
            $this->detalleModel = new Detalle();
        }

        public function Inicio(){
            require_once '../views/pages/header.php';
            require_once '../views/pages/venta/index.php';
            require_once '../views/pages/footer.php';
        }
    }
?>