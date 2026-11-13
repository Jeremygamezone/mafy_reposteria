<?php

require_once '../app/models/producto.php';
require_once '../app/models/venta.php';
require_once '../app/models/detalle.php';
require_once '../app/models/usuario.php';

class InicioControlador{
    private $model;
    private $ventas;
    private $detalles;
    private $usuario;

    public function __CONSTRUCT(){
        $this->model=new Producto();
        $this->ventas = new Venta();
        $this->detalles = new Detalle();
        $this->usuario = new Usuario();
    }

    public function Inicio(){
        require_once '../views/pages/header.php';
        require_once '../views/pages/main.php';
        require_once '../views/pages/footer.php';
    }
}