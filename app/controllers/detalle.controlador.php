<?php
 require_once '../app/models/venta.php';
 require_once '../app/models/detalle.php';

    class DetalleControlador{
        private $model;

        public function __CONSTRUCT(){
            $this->model = new Venta();
            $this->detalle = new Detalle();
        }

        public function Inicio(){
            require_once '../views/pages/header.php';
            require_once '../views/pages/venta/index.php';
            require_once '../views/pages/footer.php';
        }

        public function FormCrear(){
            require_once '../views/pages/header.php';
            require_once '../views/pages/detalle/form.php';
            require_once '../views/pages/footer.php';
        }

        public function Guardar(){
            $d = new Detalle();
            $d->set_venta_id($_POST['venta_id']);
            $d->set_producto_id($_POST['producto_id']);
            $d->set_cantidad($_POST['cantidad']);

            $this->detalle->Insertar($d);
            header("location:?c=venta");
        }
    }
?>