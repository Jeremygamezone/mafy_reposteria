<?php
class Usuario
{
    private $pdo;
    public function __CONSTRUCT()
    {
        $this->pdo = DataBase::Connect();
    }
}
