
<?php

class Descuento {
    public function calcularDescuento($id_producto, $cantidad, $precio) {
        
        if (in_array((int)$id_producto, [1, 2, 3, 4]) && $cantidad >= 2) {
            $a = $precio;
            $b = $cantidad;
            $c = .02;
            $d = ($a * $c) * $b;
            return $d;
        }
        return 0;
    }
}
?>
