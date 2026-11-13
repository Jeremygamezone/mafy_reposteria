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

        $usuario = trim($_POST['user'] ?? '');
        $password = $_POST['password'] ?? '';

        $datosUsuario = $this->usuario->Comprobar($usuario);

        if (
            $datosUsuario &&
            password_verify($password, $datosUsuario->password)
        ) {

            session_regenerate_id(true);

            $_SESSION['usuario_id'] = $datosUsuario->id;
            $_SESSION['usuario'] = $datosUsuario->usuario;

            header('Location: ?c=usuario$SUCCESS');
            exit;
        } else {

            header('Location: ?c=usuario&ERROR');
            exit;
        }
    }
}
