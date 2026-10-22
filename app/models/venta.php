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

        public function ListarB()
    {
        $consulta = $this->pdo->prepare("
            SELECT
                v.id AS venta_id,
                v.usuario_id,
                CONCAT(
                    u.nombre,
                    ' ',
                    u.apellido_paterno
                ) AS nombre_usuario,
                v.fecha,
                v.cliente,
                v.nota
            FROM ventas v
            INNER JOIN usuarios u
                ON v.usuario_id = u.id
            ORDER BY v.id DESC
        ");

        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_OBJ);
    }

    public function DetallesDeVenta(){
            try {
                $consulta = $this->pdo->prepare("
                    SELECT 
                        v.id AS venta_id,
                        v.usuario_id,
                        CONCAT(u.nombre, ' ', u.apellido_paterno) AS nombre_usuario,
                        v.fecha,
                        v.cliente,
                        v.nota,
                        GROUP_CONCAT(CONCAT(d.cantidad, ' - ', p.nombre, ' ($', p.precio, ')') SEPARATOR '<br>') AS lista_detalles,
                        SUM(d.cantidad * p.precio) AS total_venta
                    FROM ventas v
                    INNER JOIN usuarios u ON v.usuario_id = u.id
                    INNER JOIN detalles d ON v.id = d.venta_id
                    INNER JOIN productos p ON d.producto_id = p.id
                    GROUP BY v.id;
                ");

                $consulta->execute();

                return $consulta->fetchAll(PDO::FETCH_OBJ);

            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
}
?>