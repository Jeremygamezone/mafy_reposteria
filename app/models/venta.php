<?php

class Venta{
    private $pdo;

    private $id;
    private $usuario_id;
    private $fecha;
    private $cliente;
    private $nota;
    private $estatus;

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

    public function get_estatus():string{
        return $this->estatus;
    }

    public function set_estatus(string $estatus){
        $this->estatus = $estatus;
    }

    public function Listar(){
        try{
            $consulta=$this->pdo->prepare("SELECT * FROM ventas ORDER BY id DESC");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function ListarPagados(){
        try{
            $consulta=$this->pdo->prepare("SELECT * FROM ventas WHERE estatus = 'Pagado' ORDER BY id DESC");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function ListarPendientes(){
        try{
            $consulta=$this->pdo->prepare("SELECT
                v.id AS venta_id,
                v.usuario_id,
                CONCAT(
                    u.nombre,
                    ' ',
                    u.apellido_paterno
                ) AS nombre_usuario,
                v.fecha,
                v.cliente,
                v.nota,
                v.estatus
            FROM ventas v
            INNER JOIN usuarios u
                ON v.usuario_id = u.id
            ORDER BY v.id DESC");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function ListarCancelados(){
        try{
            $consulta=$this->pdo->prepare("SELECT * FROM ventas WHERE estatus = 'Cancelado'");
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
                v.nota,
                v.estatus
            FROM ventas v
            INNER JOIN usuarios u
                ON v.usuario_id = u.id
            ORDER BY v.id DESC
        ");

        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_OBJ);
    }

    public function Obtener($id){
        try {
            $consulta = $this->pdo->prepare(
                "SELECT * FROM ventas WHERE id = ?"
            );
            $consulta->execute([$id]);
            $r = $consulta->fetch(PDO::FETCH_OBJ);

            if (!$r) {
                return null;
            }
            $v = new Venta();

            $v->set_id((int) $r->id);
            $v->set_usuario_id((int) $r->usuario_id);
            $v->set_fecha($r->fecha);
            $v->set_cliente((string) $r->cliente);
            $v->set_nota((string) $r->nota);
            $v->set_estatus((string) $r->estatus);

            return $v;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    public function Insertar(Venta $v){
        try{
            $consulta="INSERT INTO ventas(usuario_id, fecha, cliente, nota, estatus) VALUES (1,?,?,?,'Pendiente')";
            $this->pdo->prepare($consulta)->execute(array($v->get_fecha(),$v->get_cliente(),$v->get_nota()));

            $id_venta = $this->pdo->lastInsertId();

            header("Location: ?c=detalle&a=FormEditar&id=" . $id_venta);
            exit;
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function Actualizar(Venta $v){
        try {
            $consulta = "UPDATE ventas
                        SET cliente = ?, nota = ?, estatus = ?
                        WHERE id = ?";

            $this->pdo->prepare($consulta)->execute([
                $v->get_cliente(),
                $v->get_nota(),
                $v->get_estatus(),
                $v->get_id()
            ]);

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
?>