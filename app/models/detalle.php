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

        public function ConsultarPorVenta()
        {
            try{
                $consulta = $this->pdo->prepare("SELECT venta_id AS numero, d.cantidad, p.nombre AS producto, p.precio, v.fecha AS ventas FROM Detalles d INNER JOIN Productos p INNER JOIN Ventas v ON d.Producto_id = p.ID");
                $consulta->execute();
                return $consulta->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
    }
?>