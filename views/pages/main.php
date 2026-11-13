<?php
$fechaDeHoy = $descuento->ObtenerFecha();
?>

<body class="bg-image-01">
    <main class="col-12 col-lg-10 mx-auto">
        <div class="mb-4 p-3">
            <h1 class="text-center text-light"><i class="bi bi-bookmark-heart"></i> Bienvenida <i class="bi bi-bookmark-heart"></i></h1>
        </div>
        <div class="row">
            <div class="col-12 col-xl-6 card-custom mb-3">
                <div class="card shadow bg-body rounded">
                    <div class="card-header bg-pink-dark">
                        <h2>Postres a la venta</h2>
                    </div>
                    <div style="max-height: 500px;">
                        <?php $p = $this->model->Disponibles() ?>
                        <?php foreach ($p as $producto): ?>
                            <div class="ventas-pagadas-scroll m-3 col-10 mx-auto text-dark">
                                <span>
                                    <?= $producto->nombre ?>
                                </span>
                                <span>
                                    -<u class="text-end">$<?= number_format($producto->precio, 2) ?></u>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6 card-custom mb-3">
                <div class="card shadow bg-body rounded">
                    <div class="card-header bg-green-dark">
                        <h2 class="h3">Ganancias de esta semana</h2>
                    </div>

                    <?php
                    $ventasPagadas = $this->ventas->ListarPagados($fechaDeHoy['inicio_semana'], $fechaDeHoy['fin_semana']);
                    $ganancia = 0;
                    ?>

                    <?php if (!empty($ventasPagadas)): ?>

                        <div class="ventas-pagadas-scroll mb-3 mt-3 col-10 mx-auto" style="max-height: 500px;">

                            <?php foreach ($ventasPagadas as $r): ?>

                                <?php
                                $detalles = $this->detalles->DetallesDeVenta($r->id);

                                $total = 0;
                                $cantidadTotalElegible = 0;

                                foreach ($detalles as $d) {

                                    if (in_array((int)$d->producto_id, [1, 2, 3, 4])) {
                                        $cantidadTotalElegible += (int)$d->cantidad;
                                    }
                                }

                                foreach ($detalles as $d) {

                                    $subtotal = (float)$d->cantidad * (float)$d->precio;

                                    $importeDescuento = $descuento->calcularDescuento(
                                        (int)$d->producto_id,
                                        (int)$d->cantidad,
                                        (float)$d->precio,
                                        $cantidadTotalElegible
                                    );

                                    $total += $subtotal - $importeDescuento["descuento"];
                                }

                                $ganancia += $total;
                                ?>

                                <?php if ($total > 0): ?>

                                    <div class="border rounded pt-1 pb-1 p-2 mb-1 bg-green-light d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>Venta #<?= (int)$r->id ?></strong>
                                            <a onclick="window.location.href='?c=venta&a=FormEditar&id=<?= (int) $r->id ?>'"
                                                style="cursor: pointer;" class="btn btn-flat bg-success shadow m-2">
                                                <i class="bi bi-box-arrow-in-up-right text-white">Ir</i>
                                            </a>
                                        </div>
                                        <div>
                                            <strong>
                                                + $<?= number_format($total, 2) ?>
                                            </strong>
                                        </div>
                                    </div>

                                <?php else: ?>
                                    <div class="border rounded pt-1 pb-1 p-2 mb-1 bg-warning d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>Venta #<?= (int)$r->id ?></strong>
                                            <a onclick="window.location.href='?c=venta&a=FormEditar&id=<?= (int) $r->id ?>'"
                                                style="cursor: pointer;" class="btn btn-flat bg-red-dark shadow m-2">
                                                <i class="bi bi-box-arrow-in-up-right text-white">Ir</i>
                                            </a>
                                        </div>
                                        <div>
                                            <p>Venta sin productos</p>
                                        </div>  
                                    </div>
                                <?php endif ?>

                            <?php endforeach; ?>

                        </div>

                    <?php else: ?>

                        <div class="alert alert-info m-4" role="alert" style="max-height: 500px;">
                            Sin ventas esta semana...
                        </div>

                    <?php endif; ?>

                    <?php if (!empty($ventasPagadas)): ?>
                        <div>
                            <h1 class="text-end text-green-dark">
                                Ganancias ¡$<?= number_format($ganancia, 2) ?>!
                            </h1>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</body>