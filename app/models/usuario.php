<?php
class Usuario
{
    private $pdo;

    public function __CONSTRUCT()
    {
        $this->pdo = DataBase::Connect();
    }

    public function Comprobar($usuario)
    {
        try {

            $consulta = $this->pdo->prepare(
                "SELECT * FROM usuarios
                    WHERE usuario = 1"
            );

            $consulta->execute([$usuario]);

            return $consulta->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {

            die($e->getMessage());
        }
    }
}
