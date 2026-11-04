<body class="bg-image-sales">
<main class="col-12 col-lg-10 mx-auto">
    <div class="row mx-auto">
        <div class="bg-dark">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
                <h1><i class="bi bi-book"></i> Ventas</h1>
            </div>
        </div>
        <div class="row g-3" id="ParteSuperior">
            <div class="col-12 col-xl-6 card-custom" id="VentasSimples">
                <div class="table-responsive rounded">
                    <table class="table table-hover rounded" id="tabla-ventas">
                        <thead>
                            <tr>
                                <th>venta</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Detalles</th>
                            </tr>
                        </thead>
                    <tbody>
                                    <?php foreach ($this->venta->Listar() as $r): ?>

                                        <?php
                                        switch ($r->estatus) {
                                            case "Pagado":
                                                $clase = "";
                                                $icono = "";
                                                break;

                                            case "Pendiente":
                                                $clase = "warning";
                                                $icono = "<i class='bi bi-exclamation-triangle'></i>";
                                                break;

                                            case "Cancelado":
                                                $clase = "danger";
                                                $icono = "<i class='bi bi-x-circle'></i>";
                                                break;

                                            default:
                                                $clase = "";
                                                $icono = "";
                                                break;
                                        }
                                        ?>

                                        <tr class="fila-venta table-<?= htmlspecialchars($clase) ?>">
                                            <td>
                                                <strong># <?= (int) $r->id ?></strong>
                                                <?= $icono ?>
                                            </td>
                                            <td><?= htmlspecialchars(substr($r->fecha, 0, 10)) ?></td>
                                            <td><?= htmlspecialchars($r->cliente ?? '') ?></td>
                                            <td>
                                                <a
                                                    href="?c=venta&a=FormEditar&id=<?= (int) $r->id ?>"
                                                    class="btn btn-flat bg-pink-dark shadow m-2"
                                                >
                                                    <i class="bi bi-clipboard"> Editar</i>
                                                </a>
                                                <a onclick="window.location.href='#venta-<?= (int) $r->id ?>'"
                                                    style="cursor: pointer;" class="btn btn-flat bg-warning shadow m-2">
                                                    <i class="bi bi-box-arrow-in-up-right">Ir</i>
                                                </a>
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>

                    </table>
                </div>
            </div>
            <div class="col-12 col-xl-6 card-custom" id="VentasPagadas">
                <div class="card shadow bg-body rounded">
                    <div class="card-header bg-green-dark">
                        <h2 class="h3">Ventas pagadas de esta semana</h2>
                    </div>

                    <div class="card-body m-2">

                        <div class="mb-4">
                            <a href="?c=venta&a=FormCrear" class="btn btn-lg btn-flat bg-green-dark">
                                <i class="bi bi-plus-circle">               Nueva venta</i> 
                            </a>
                    </div>

                        <p>Ingreso de ventas pagadas en el periodo de</p>

                        <?php
                            $ventasPagadas = $this->venta->ListarPagados();
                            $ganancia = 0;
                        ?>

                        <?php if (!empty($ventasPagadas)): ?>

                            <div class="ventas-pagadas-scroll mb-3 col-10 mx-auto">

                                <?php foreach ($ventasPagadas as $r): ?>

                                    <?php
                                        $detalles = $this->detalle->DetallesDeVenta($r->id);

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

                                    <div class="border rounded pt-1 pb-1 p-2 mb-1 bg-green-light d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>Venta #<?= (int)$r->id ?></strong>
                                            <a onclick="window.location.href='#venta-<?= (int) $r->id ?>'"
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

                                <?php endforeach; ?>

                            </div>

                        <?php else: ?>

                            <div class="alert alert-info mb-0" role="alert">
                                Todavía no hay ventas pagadas.
                            </div>

                        <?php endif; ?>

                        <div>
                            <h1 class="text-end text-green-dark">
                                Ganancias ¡$<?= number_format($ganancia, 2) ?>!
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row" id="ParteInferior">
            <div class="col-12 mb-4" id="TodasLasVentas">

                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 m-4">
                    <h2><i class="bi bi-receipt"></i> Todas las ventas</h2>
                </div>
                <div class="card col-12 p-2 mt-5 mb-3">
                            <h4 class=""> Las ventas con texto azul aplican descuento por tener más de 2 productos individuales</h4>
                            <h5>Actualmente se aplica un descuento de $2.00 por pieza a partir de 2 piezas de los siguentes productos: <u class="text-blue">Cupcake Simple, Cupcake Relleno, Chocflan y Flan Napolitano</u></h5>
                </div>

                <div class="row g-3" id="Tickets">

                    <?php foreach ($this->venta->ListarB() as $venta): ?>

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
                                        <h6 class="<?= $importeDescuento["clase"] ?>"></h6>

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

                                                <span>
                                                    ($<?= number_format((float) $d->precio, 2) ?> C/U) <u class="<?= $importeDescuento["clase"] ?>"></u>
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
