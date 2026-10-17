<?php
    class Detalle{
        private $pdo;

        private $id;
        private $venta_id;
        private $producto_id;
        private $cantidad;

        public function __CONSTRUCT(){
            $this->pdo = DataBase::Connect();
        }

        public function get_id():int{
            return $this->id;
        }

        public function set_id(int $id){
            $this->id = $id;
        }

        public function get_venta_id():int{
            return $this->venta_id;
        }

        public function set_venta_id(int $venta_id){
            $this->venta_id = $venta_id;
        }

        public function get_producto_id():int{
            return $this->producto_id;
        }

        public function set_producto_id(int $producto_id){
            $this->producto_id = $producto_id;
        }

        public function get_cantidad():int{
            return $this->cantidad;
        }

        public function set_cantidad(int $cantidad){
            $this->cantidad = $cantidad;
        }

        public function Listar(){
            try{
                $consulta=$this->pdo->prepare("SELECT * FROM detalles");
                $consulta->execute();
                return $consulta->fetchAll(PDO::FETCH_OBJ);
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        
        public function ConsultarPorVenta($id)
        {
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
                    WHERE Ventas.ID = ?
                ");

                $consulta->execute([$id]);

                return $consulta->fetchAll(PDO::FETCH_OBJ);

            } catch (PDOException $e) {
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