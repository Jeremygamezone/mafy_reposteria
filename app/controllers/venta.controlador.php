<?php
    require_once '../app/models/venta.php';
    require_once '../app/models/detalle.php';

    class VentaControlador{
        private $venta;
        private $detalle;

        public function __CONSTRUCT(){
            $this->venta = new Venta();
            $this->detalle = new Detalle();
        }

        public function Inicio(){
            require_once '../views/pages/header.php';
            require_once '../views/pages/venta/index.php';
            require_once '../views/pages/footer.php';
        }

        public function FormCrear(){
            require_once '../views/pages/header.php';
            require_once '../views/pages/venta/form.php';
            require_once '../views/pages/footer.php';
        }

        public function Guardar(){
            $v = new Venta();
            $v->set_fecha($_POST['fecha']);
            $v->set_cliente($_POST['cliente']);
            $v->set_nota($_POST['nota']);

            $this->venta->Insertar($v);
            header("location:?c=venta");
        }
    }
?>