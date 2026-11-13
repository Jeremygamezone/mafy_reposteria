<body class="bg-image-sales">
    <main class="col-12 col-lg-10 mx-auto">
        <div class="row mx-auto text-light">
            <div class="bg-dark">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
                    <h1><i class="bi bi-book"></i> Resumen <?= $_SESSION['inicio_semana'] ?> al <?= $_SESSION['fin_semana'] ?></h1>
                </div>
                <div class="mb-4">
                    <h1>
                        <a href="?c=venta&a=FormCrear" class="btn bg-pink-dark btn-flat">
                            <i class="bi bi-plus-circle"> Nueva venta</i>
                        </a>
                </div>
            </div>
        </div>
        <div class="row g-3" id="ParteSuperior">
            <div class="col-12 col-xl-6 card-custom" id="VentasPagadas">
                <div class="card shadow bg-body rounded">
                    <div class="card-header success bg-success text-white">
                        <h2 class="h3">Pagadas</h2>
                    </div>
                    <div class="card-body m-2">
                        <?php
                        $ventasPagadas = $this->venta->ListarSemanaPagados();
                        $ganancia = 0;
                        ?>

                        <?php if (!empty($ventasPagadas)): ?>

                            <div class="ventas-pagadas-scroll mb-3 col-12 mx-auto">

                                <?php foreach ($ventasPagadas as $r): ?>

                                    <?php
                                    $detalles = $this->detalle->DetallesDeVenta($r->venta_id);

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
                                                <strong>Venta #<?= (int)$r->venta_id ?></strong>
                                                <a onclick="window.location.href='?c=venta&a=FormEditar&id=<?= (int) $r->venta_id ?>'"
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
                                                <a onclick="window.location.href='?c=venta&a=FormEditar&id=<?= (int) $r->venta_id ?>'"
                                                    style="cursor: pointer;" class="btn btn-flat bg-red-dark shadow m-2">
                                                    <i class="bi bi-box-arrow-in-up-right text-white">Ir</i>
                                                </a>
                                            </div>
                                            <div>
                                                <p>Venta sin productos</p>
                                            </div>
                                            <div>
                                                <strong>
                                                    + $<?= number_format($total, 2) ?>
                                                </strong>
                                            </div>
                                        </div>
                                    <?php endif ?>

                                <?php endforeach; ?>

                            </div>

                        <?php else: ?>

                            <div class="alert alert-info mb-0" role="alert">
                                Sin ventas esta semana
                            </div>

                        <?php endif; ?>

                        <?php if (!empty($ventasPagadas)): ?>
                            <div>
                                <h1 class="text-end text-green-dark">
                                    Ganancia: $<?= number_format($ganancia, 2) ?>
                                </h1>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6 card-custom" id="VentasPagadas">
                <div class="card shadow bg-body rounded">
                    <div class="card-header warning bg-warning text-yellow-dark">
                        <h2 class="h3">Pendientes de Pago</h2>
                    </div>
                    <div class="card-body m-2">
                        <?php
                        $ventasPagadas = $this->venta->ListarSemanaPendientes();
                        $ganancia = 0;
                        ?>

                        <?php if (!empty($ventasPagadas)): ?>

                            <div class="ventas-pagadas-scroll mb-3 col-12 mx-auto">

                                <?php foreach ($ventasPagadas as $r): ?>

                                    <?php
                                    $detalles = $this->detalle->DetallesDeVenta($r->venta_id);

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

                                        <div class="border rounded pt-1 pb-1 p-2 mb-1 bg-yellow-light d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>Venta #<?= (int)$r->venta_id ?></strong>
                                                <a onclick="window.location.href='?c=venta&a=FormEditar&id=<?= (int) $r->venta_id ?>'"
                                                    style="cursor: pointer;" class="btn btn-flat bg-warning shadow m-2">
                                                    <i class="bi bi-box-arrow-in-up-right text-yellow-dark">Ir</i>
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
                                                <a onclick="window.location.href='#venta-<?= (int) $r->id ?>'"
                                                    style="cursor: pointer;" class="btn btn-flat bg-red-dark shadow m-2">
                                                    <i class="bi bi-box-arrow-in-up-right text-white">Ir</i>
                                                </a>
                                            </div>
                                            <div>
                                                <p>Venta sin productos</p>
                                            </div>
                                            <div>
                                                <strong>
                                                    + $<?= number_format($total, 2) ?>
                                                </strong>
                                            </div>
                                        </div>
                                    <?php endif ?>

                                <?php endforeach; ?>

                            </div>

                        <?php else: ?>

                            <div class="alert alert-warning mb-0" role="alert">
                                Sin pendientes
                            </div>

                        <?php endif; ?>

                        <?php if (!empty($ventasPagadas)): ?>
                            <div>
                                <h1 class="text-end text-yellow-dark">
                                    Pendiente total: $<?= number_format($ganancia, 2) ?>
                                </h1>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row" id="ParteInferior">
            <div class="col-12 mb-4" id="TodasLasVentas">

                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 m-4">
                    <h2><i class="bi bi-receipt"></i> Consultar detalles</h2>
                </div>
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 m-4 mx-auto">
                    <a class="btn btn-warning text-yellow-dark" id="func-1" href="?c=venta&a=IndexVentas&isemana=<?= $_SESSION['inicio_semana'] ?>&fsemana=<?= $_SESSION['fin_semana'] ?>&func=1">
                        <h2>Ventas pendiente</h2>
                    </a>
                    <a class="btn btn-success text-green-light" id="func-2" href="?c=venta&a=IndexVentas&isemana=<?= $_SESSION['inicio_semana'] ?>&fsemana=<?= $_SESSION['fin_semana'] ?>&func=2">
                        <h2>Ventas pagadas</h2>
                    </a>
                    <a class="btn btn-danger" id="func-3" href="?c=venta&a=IndexVentas&isemana=<?= $_SESSION['inicio_semana'] ?>&fsemana=<?= $_SESSION['fin_semana'] ?>&func=3">
                        <h2>Ventas canceladas</h2>
                    </a>
                    <a class="btn btn-primary" id="func-4" href="?c=venta&a=IndexVentas&isemana=<?= $_SESSION['inicio_semana'] ?>&fsemana=<?= $_SESSION['fin_semana'] ?>&func=4">
                        <h2>Todas las ventas</h2>
                    </a>
                </div>

            </div>
        </div>
        </div>
    </main>
</body>