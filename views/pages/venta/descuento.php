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
            && $cantidadTotalElegible >= 2
        ) {
            return [
                'clase' => "text-blue",
                'warning' => '- $'.($cantidad * 2),
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

    public function ObtenerFecha(): array {
        $hoy = new DateTimeImmutable(
            'now',
            new DateTimeZone('America/Mexico_City')
        );

        $lunes = $hoy->modify('monday this week');
        $domingo = $hoy->modify('sunday this week');

        $numeroDia = (int)$hoy->format('N');

        $dias = [
            1 => 'Lunes',
            2 => 'Martes',
            3 => 'Miércoles',
            4 => 'Jueves',
            5 => 'Viernes',
            6 => 'Sábado',
            7 => 'Domingo'
        ];

        return [
            'año' => $hoy->format('Y'),
            'mes' => $hoy->format('m'),
            'dia' => $hoy->format('d'),
            'dia_semana' => $numeroDia,
            'nombre_dia' => $dias[$numeroDia],
            'fecha_actual' => $hoy->format('Y-m-d'),
            'inicio_semana' => $lunes->format('Y-m-d'),
            'fin_semana' => $domingo->format('Y-m-d'),
            'fin_exclusivo' => $lunes->modify('+7 days')->format('Y-m-d')
        ];
    }
}
?>