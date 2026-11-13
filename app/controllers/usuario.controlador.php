<?php 
    require_once 'app/models/usuario.php';

    class UsuarioControlador{
        private $usuario;

        public function __construct()
        {
            $this->usuario = new Usuario();
        }

        
    public function Login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?c=usuario&a=Index');
            exit;
        }

        $usuario = trim($_POST['usuario'] ?? '');
        $password = $_POST['password'] ?? '';

        $datosUsuario = $this->usuario->Comprobar($usuario);

        if (
            $datosUsuario &&
            password_verify($password, $datosUsuario->password)
        ) {

            session_regenerate_id(true);

            $_SESSION['usuario_id'] = $datosUsuario->id;
            $_SESSION['usuario'] = $datosUsuario->usuario;
            $_SESSION['nombre'] = $datosUsuario->nombre;
            $_SESSION['rol'] = $datosUsuario->rol;

            header('Location: ?c=venta&a=Index');
            exit;
        } else {

            header('Location: ?c=usuario&a=Index&error=1');
            exit;
        }
    }
    }
?>