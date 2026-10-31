<?php
 require_once '../app/models/venta.php';
 require_once '../app/models/detalle.php';
 require_once '../app/models/producto.php';

    class DetalleControlador{
        private $venta;
        private $detalles;
        private $productos;

        public function __CONSTRUCT(){
            $this->venta = new Venta();
            $this->detalles = new Detalle();
            $this->productos = new Producto();
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

        public function FormEditar(){
            $id = isset($_GET['id']) ? (int) $_GET['id'] : null;

            $d = $this->venta->Obtener($id);

            require_once '../views/pages/header.php';
            require_once '../views/pages/detalle/edit.php';
            require_once '../views/pages/footer.php';
        }

        public function Guardar(){
            $d = new Detalle();
            $d->set_venta_id($_POST['venta_id']);
            $d->set_producto_id($_POST['producto_id']);
            $d->set_cantidad($_POST['cantidad']);
            $d->set_notaVenta($_POST['notaVenta']);

            $this->detalles->Insertar($d);
        }
    }
?>