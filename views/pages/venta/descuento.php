<?php

class Descuento {

    public function calcularDescuento(
        $id_producto,
        $cantidad,
        $precio,
        $cantidadTotalElegible
    ) {

        if (
            in_array((int)$id_producto, [1, 2, 3, 4])
            && $cantidadTotalElegible > 2
        ) {
            return [
                'clase' => "text-blue",
                'warning' => "Descuento aplicado",
                'cantidad' => $cantidadTotalElegible,
                'descuento' => ($cantidad * 2)
            ];
        }

        return [
            'clase' => "",
            'warning' => "",
            'cantidad' => "",
            'descuento' => 0
        ];
    }
}

?>