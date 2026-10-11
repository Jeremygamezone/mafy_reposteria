<?php

class Producto{
    private $pdo;

    private $id;
    private $nombre;
    private $descripcion;

    public function __CONSTRUCT(){
        $this->pdo = DataBase::Connect();
    }

    public function get_id():int{
        return $this->id;
    }

    public function set_id(int $id){
        $this->id = $id;
    }

    public function get_nombre():string{
        return $this->nombre;
    }

    public function set_nombre(string $nombre){
        $this->nombre = $nombre;
    }

    public function get_descripcion():string{
        return $this->descripcion;
    }

    public function set_descripcion(string $descripcion){
        $this->descripcion = $descripcion;
    }

    public function Listar(){
        try{
            $consulta=$this->pdo->prepare("SELECT * FROM productos");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function Insertar(Producto $p){
        try{
            $consulta="INSERT INTO productos(nombre, descripcion) VALUES (?,?)";
            $this->pdo->prepare($consulta)->execute(array($p->get_nombre(),$p->get_descripcion()));

        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function Obtener($id){
        try{
            $consulta=$this->pdo->prepare("SELECT * FROM productos WHERE id =?;");
            $consulta->execute(array($id));
            $r=$consulta->fetch(PDO::FETCH_OBJ);
            $p = new Producto();

            $p->set_id((int) $r->id);
            $p->set_nombre($r->nombre);
            $p->set_descripcion($r->descripcion);

            return $p;
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    
    public function Actualizar(Producto $p){
        try {
            $consulta = "UPDATE productos
                        SET nombre = ?, descripcion = ?
                        WHERE id = ?";

            $this->pdo->prepare($consulta)->execute([
                $p->get_nombre(),
                $p->get_descripcion(),
                $p->get_id()
            ]);

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

}