<?php

class Venta{
    private $pdo;

    private $id;
    private $usuario_id;
    private $fecha;
    private $cliente;
    private $nota;

    public function __CONSTRUCT(){
        $this->pdo = DataBase::Connect();
    }

    public function get_id():int{
        return $this->id;
    }

    public function set_id(int $id){
        $this->id = $id;
    }

    public function get_usuario_id():int{
        return $this->usuario_id;
    }

    public function set_usuario_id(int $usuario_id){
        $this->usuario_id = $usuario_id;
    }

    public function get_fecha():string{
        return $this->fecha;
    }

    public function set_fecha(string $fecha){
        $this->fecha = $fecha;
    }

    public function get_cliente():string{
        return $this->cliente;
    }

    public function set_cliente(string $cliente){
        $this->cliente = $cliente;
    }

    public function get_nota():string{
        return $this->nota;
    }

    public function set_nota(string $nota){
        $this->nota = $nota;
    }

    public function Listar(){
        try{
            $consulta=$this->pdo->prepare("SELECT * FROM ventas");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function DetallesVenta($venta_id){
        try{
            $consulta=$this->pdo->prepare("SELECT * FROM detalles WHERE venta_id = :venta_id");
            $consulta->bindParam(':venta_id', $venta_id, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function Prueba(){
            try {
                $consulta = $this->pdo->prepare("
                    SELECT
                        Ventas.id AS venta_id,
                        Productos.nombre AS producto,
                        Detalles.cantidad AS cantidad,
                        Ventas.fecha AS fecha
                    FROM Detalles
                    INNER JOIN Ventas
                        ON Detalles.Venta_id = Ventas.ID
                    INNER JOIN Productos
                        ON Detalles.Producto_id = Productos.ID
                    WHERE Ventas.ID = 1
                ");

                $consulta->execute();

                return $consulta->fetchAll(PDO::FETCH_OBJ);

            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
}
?>