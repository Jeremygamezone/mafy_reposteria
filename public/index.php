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

$controlador = $_GET['c'] ?? 'inicio';
$accion = $_GET['a'] ?? 'Inicio';

// Controladores públicos que no necesitan autenticación
$controladoresPublicos = ['usuario'];

// Comprobar sesión ANTES de cargar el controlador
if (!isset($_SESSION['active'])) {

    if (!in_array($controlador, $controladoresPublicos, true)) {
        header('Location: ?c=usuario');
        exit;
    }
}

// Cargar el controlador solicitado
$archivo = "../app/controllers/$controlador.controlador.php";

if (!is_file($archivo)) {
    http_response_code(404);
    exit('Controlador no encontrado.');
}

require_once $archivo;

// Instanciar controlador
$nombreControlador = ucwords($controlador) . "Controlador";

if (!class_exists($nombreControlador)) {
    http_response_code(404);
    exit('Clase de controlador no encontrada.');
}

$controlador = new $nombreControlador;

// Comprobar que la acción exista
if (!is_callable([$controlador, $accion])) {
    http_response_code(404);
    exit('Acción no encontrada.');
}

call_user_func([$controlador, $accion]);
?>