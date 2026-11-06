

<?php
    $fechaDeHoy = $descuento->ObtenerFecha();
    $funcDB = $_GET["func"];
    $funcionTexto = "";

    switch ($funcDB):
        case 1: $funcionTexto = "Pendientes de pago"; break;
        case 2: $funcionTexto = "Ganancias semanales"; break;
        case 3: $funcionTexto = "Cancelados"; break;
        case 4: $funcionTexto = "Todas las ventas"; break;
    endswitch;
?>
<body class="bg-image-sales">
<main class="col-12 col-lg-10 mx-auto">
    <div class="row mx-auto">
        <br>
        <div class="row" id="ParteInferior">
            <div class="col-12 mb-4" id="TodasLasVentas">
                <a class="btn btn-secondary btn-bg" href="?c=venta#func-<?= $funcDB ?>">
                    <i class="bi bi-reply me-2"></i>Regresar
                </a>
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 m-4">
                <h2><i class="bi bi-receipt"></i> <?= $funcionTexto ?></h2>
                    <h3>Periodo:
                        <?= $fechaDeHoy['inicio_semana'] ?>
                        /
                        <?= $fechaDeHoy['fin_semana'] ?></h3>
                </div>
                <div class="card col-12 p-2 mt-5 mb-3">
                            <h4 class=""> Las ventas con texto azul aplican descuento por tener más de 2 productos individuales</h4>
                            <h5>Actualmente se aplica un descuento de $2.00 por pieza a partir de 2 piezas de los siguentes productos: <u class="text-blue">Cupcake Simple, Cupcake Relleno, Chocflan y Flan Napolitano</u></h5>
                </div>

                <div class="row g-3" id="Tickets">
                    <?php foreach ($this->venta->ListarSemanaActual() as $venta): ?>
                        <?php
                        switch ($venta->estatus) {
                            case "Pagado":
                                $clase = "success text-white";
                                break;

                            case "Pendiente":
                                $clase = "warning text-dark";
                                break;

                            case "Cancelado":
                                $clase = "danger text-white";
                                break;

                            default:
                                $clase = "secondary text-white";
                                break;
                        }

                        $detalles = $this->detalle->DetallesDeVenta($venta->venta_id);
                        $total = 0;
                        $cantidadTotalElegible = 0;

                        foreach ($detalles as $d) {

                            if (in_array((int)$d->producto_id, [1, 2, 3, 4])) {
                                $cantidadTotalElegible += (int)$d->cantidad;
                            }
                        }

                        $aplicaDescuento = $cantidadTotalElegible > 2;

                        ?>
                        <div id="venta-<?= (int) $venta->venta_id ?>" class="col-12 col-md-6 col-xl-4 card-custom p-2">

                            <div class="card shadow bg-body rounded h-100">

                                <div class="card-header">
                                    <h3><strong>Venta #<?= (int) $venta->venta_id ?></strong></h3>
                                </div>

                                <div class="card-body">

                                    <div class="d-flex justify-content-between gap-2">

                                        <div class="col-7">
                                            <p>
                                                <strong>Fecha:</strong>
                                                <?= htmlspecialchars($venta->fecha) ?>
                                            </p>

                                            <p>
                                                <strong>Cliente:</strong>
                                                <?= htmlspecialchars($venta->cliente ?? '') ?>
                                            </p>

                                            <div>
                                                <strong>Nota:</strong>
                                                <p class="mb-0 text-break">
                                                    <?= htmlspecialchars($venta->nota ?? '') ?>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="p-2">
                                            <a
                                                href="?c=detalle&a=FormEditar&id=<?= (int) $venta->venta_id ?>"
                                                class="btn btn-primary btn-flat mb-2 shadow"
                                            >
                                                <i class="bi bi-plus-circle">              Agregar</i> 
                                            </a>

                                            <br>

                                            <a
                                                href="?c=venta&a=FormEditar&id=<?= (int) $venta->venta_id ?>"
                                                class="btn btn-flat bg-pink-dark mb-2 shadow"
                                            >
                                                <i class="bi bi-clipboard">                Editar</i> 
                                            </a>
                                        </div>

                                    </div>

                                    <hr>

                                    <?php if (!empty($detalles)): ?>

                                        <h5>Se vendieron</h5>
                                        
                                        <?php foreach ($detalles as $d): ?>

                                            <?php

                                            $subtotal = (float)$d->cantidad * (float)$d->precio;

                                            $importeDescuento = $descuento->calcularDescuento(
                                                (int)$d->producto_id,
                                                (int)$d->cantidad,
                                                (float)$d->precio,
                                                $cantidadTotalElegible
                                            );
                                            
                                            $subtotalFinal = $subtotal - $importeDescuento["descuento"];

                                            $total += $subtotalFinal;

                                            ?>
                                            
                                            
                                            <div class="d-flex justify-content-between gap-2 mb-1">
                                                <span class="<?= $importeDescuento["clase"] ?>">
                                                    <?= (int) $d->cantidad ?> × 
                                                    <?= htmlspecialchars($d->producto) ?>
                                                </span>

                                                <span class="<?= $importeDescuento["clase"] ?>">
                                                    <?php if ($importeDescuento["descuento"] > 0): ?>
                                                        <del class="text-black">
                                                            $<?= number_format($subtotal, 2) ?> 
                                                        </del>
                                                         <strong><?= $importeDescuento["warning"] ?></strong>
                                                    <?php endif; ?>
                                                    <br>
                                                    $<?= number_format($subtotalFinal, 2) ?>
                                                </span>

                                            </div>

                                            <?php if (!empty($importeDescuento["warning"])): ?>
                                                <h6 class="<?= $importeDescuento["clase"] ?>">
                                                
                                                </h6>
                                            <?php endif; ?>

                                        <?php endforeach; ?>

                                        <hr>

                                        <div class="row align-items-center">
                                            <h4 class="col p-2 rounded shadow bg-<?= $clase ?>">
                                                <?= htmlspecialchars($venta->estatus) ?>
                                            </h4>

                                            <h4 class="col text-end">
                                                Total: $<?= number_format($total, 2) ?>
                                            </h4>
                                        </div>

                                    <?php else: ?>

                                        <div class="alert alert-warning" role="alert">
                                            <i class="bi bi-exclamation-circle"></i>
                                            Esta venta aún no tiene productos registrados.
                                        </div>

                                        <div class="row align-items-center">
                                            <h4 class="col p-2 rounded shadow bg-<?= $clase ?>">
                                                <?= htmlspecialchars($venta->estatus) ?>
                                            </h4>
                                        </div>

                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</main>
</body>
