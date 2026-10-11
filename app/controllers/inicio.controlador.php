<?php

require_once '../app/models/producto.php';

class InicioControlador{
    private $model;

    public function __CONSTRUCT(){
        $this->model=new Producto();
    }

    public function Inicio(){
        require_once '../views/pages/header.php';
        require_once '../views/pages/main.php';
        require_once '../views/pages/footer.php';
    }
}