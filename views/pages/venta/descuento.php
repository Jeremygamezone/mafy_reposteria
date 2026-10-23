<?php

$a = 0;
$b = 0;
$c = 0;
$texto ="";

class Descuento{
    private $id_producto;

    public function getIdProducto(){
        return $this->id_producto;
    }

    public function calcularDescuento($id_producto){
        switch ($this->id_producto):
            case 1:
                break;
            case 2:
                break;
            case 3:
                break;
            case 4:
                break;
            default:
            $texto = "No aplica descuento";
                break;
            endswitch;
    }
}
?>
