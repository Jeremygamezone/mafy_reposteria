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

        public function FormEditar()
        {
            $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
            $v = $this->venta->Obtener($id);

            require_once '../views/pages/header.php';
            require_once '../views/pages/venta/edit.php';
            require_once '../views/pages/footer.php';
        }

        public function Guardar(){
            $v = new Venta();
            $v->set_fecha($_POST['fecha']);
            $v->set_cliente($_POST['cliente']);
            $v->set_nota($_POST['nota']);

            $this->venta->Insertar($v);
        }

        public function Editar(){
            if (!isset($_POST['nota'], $_POST['cliente'], $_POST['estatus'])) {
                die('Faltan datos para modificar la venta.');
            }

            $v = new Venta();

            $v->set_id((int) $_POST['id']);
            $v->set_usuario_id($_POST['usuario_id']);
            $v->set_nota($_POST['nota']);
            $v->set_fecha($_POST['fecha']);
            $v->set_cliente($_POST['cliente']);
            $v->set_estatus($_POST['estatus']);

            $this->venta->Actualizar($v);

            header("Location: ?c=venta");
            exit;
        }
    }
?>