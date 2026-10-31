<?php
    class Detalle{
        private $pdo;

        private $venta_id;
        private $producto_id;
        private $cantidad;
        private $notaVenta;

        public function __CONSTRUCT(){
            $this->pdo = DataBase::Connect();
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

        public function set_notaVenta(string $notaVenta){
            $this->notaVenta = $notaVenta;
        }

        public function get_notaVenta():string{
            return $this->notaVenta;
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

        
        public function DetallesDeVenta($venta_id)
        {
            $consulta = $this->pdo->prepare("
                SELECT
                    d.venta_id,
                    d.producto_id,
                    p.nombre AS producto,
                    d.cantidad,
                    p.precio,
                    (d.cantidad * p.precio) AS subtotal
                FROM detalles d
                INNER JOIN productos p
                    ON d.producto_id = p.id
                WHERE d.venta_id = ?;
            ");

            $consulta->execute([$venta_id]);

            return $consulta->fetchAll(PDO::FETCH_OBJ);
        }

        public function Insertar(Detalle $d){
            try{
                $consulta="INSERT INTO detalles (venta_id, producto_id, cantidad)
                            VALUES (?, ?, ?)
                            ON DUPLICATE KEY UPDATE
                                cantidad = cantidad + VALUES(cantidad)";
                $consulta2 = $this->pdo->prepare("UPDATE ventas SET nota = ? WHERE id = ?");
                $venta_id = $d->get_venta_id();
                $this->pdo->prepare($consulta)->execute(array($d->get_venta_id(),$d->get_producto_id(),$d->get_cantidad()));
                $consulta2->execute([$d->get_notaVenta(), $d->get_venta_id()]);

                header("location:?c=detalle&a=FormEditar&id=$venta_id");
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

    }
?>