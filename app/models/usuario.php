<?php
class Usuario
{
    private $credenciales = [];
    private $pdo;

    public function __CONSTRUCT()
    {
        $this->pdo = DataBase::Connect();
    }

    public function Comprobar($usuario)
    {
        if ($usuario == "Mafy.postres"):
            return $usuario;
        endif;
    }
}
