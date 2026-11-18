<?php
require_once '../app/models/usuario.php';

class UsuarioControlador
{
    private $usuario;

    public function __construct()
    {
        $this->usuario = new Usuario();
    }

    public function Inicio()
    {
        require_once '../views/pages/header.php';
        require_once '../views/pages/login/index.php';
        require_once '../views/pages/footer.php';
    }

    public function Login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: ?c=venta");
            exit;
        }

        if ($_POST['user'] == "Mafy.postres" && $_POST['password'] == "231145_ mlfg") {
            session_regenerate_id(true);
            $_SESSION['active'] = true;

            header('Location: ?c=inicio');
            exit;
        } else {

            header('Location: ?c=usuario&ERROR');
            exit("Usuario/Contraseña incorrecta");
        }
    }

    public function Cerrar(){
        session_destroy();
        header('Location: ?c=usuario&Exited');
    }
}
