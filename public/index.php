<?php
session_start();
require_once '../app/models/database.php';
require_once '../views/pages/venta/descuento.php';
$descuento = new Descuento();
$fechaDeHoy = $descuento->ObtenerFecha();
$_SESSION['nombre_dia'] = $fechaDeHoy['nombre_dia'];
$_SESSION['dia'] = $fechaDeHoy['dia'];
$_SESSION['mes'] = $fechaDeHoy['mes'];
$_SESSION['año'] = $fechaDeHoy['año'];
$_SESSION['inicio_semana'] = $fechaDeHoy['inicio_semana'];
$_SESSION['fin_semana'] = $fechaDeHoy['fin_semana'];

if(!isset($_GET['c'])){
    require_once '../app/controllers/inicio.controlador.php';

    $controlador = new InicioControlador();
    call_user_func(array($controlador,"Inicio"));
}else{
    $controlador = $_GET['c'];
    require_once "../app/controllers/$controlador.controlador.php";
    $controlador = ucwords($controlador)."Controlador";
    $controlador = new $controlador;
    $accion = isset($_GET['a']) ? $_GET['a'] : "Inicio";
    call_user_func(array($controlador, $accion));
}