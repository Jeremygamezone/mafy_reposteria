<?php
require_once '../app/models/producto.php';

class ProductoControlador{
    private $model;

    public function __CONSTRUCT(){
        $this->model = new Producto();
    }

    public function Inicio(){
        require_once '../views/pages/header.php';
        require_once '../views/pages/producto/index.php';
        require_once '../views/pages/footer.php';
    }

    public function FormCrear(){

        require_once '../views/pages/header.php';
        require_once '../views/pages/producto/form.php';
        require_once '../views/pages/footer.php';
    }

    
    public function FormEditar(){
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;

        $p = $this->model->Obtener($id);

        require_once '../views/pages/header.php';
        require_once '../views/pages/producto/edit.php';
        require_once '../views/pages/footer.php';
    }


    public function Guardar(){
        $p = new Producto();
        $p->set_nombre($_POST['nombre']);
        $p->set_descripcion($_POST['descripcion']);

        $this->model->Insertar($p);
        header("location:?c=producto");
    }

    public function Editar(){
    // Verificar que los datos necesarios fueron enviados
    if (
        !isset($_POST['id'], $_POST['nombre'], $_POST['descripcion']) ||
        !is_numeric($_POST['id'])
    ) {
        die('Faltan datos para editar el producto.');
    }

    $p = new Producto();

    $p->set_id((int) $_POST['id']);
    $p->set_nombre($_POST['nombre']);
    $p->set_descripcion($_POST['descripcion']);

    $this->model->Actualizar($p);

    header("Location: ?c=producto");
    exit;
}
}