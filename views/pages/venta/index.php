<?php
require_once __DIR__ . "/descuento.php";

$descuento = new Descuento();
?>

<main class="text-light bg-dark" style="background-color: var(--bs-wine--dark) !important;">

    <div class="bg-dark">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
            <h1><i class="bi bi-table"></i> Ventas</h1>
        </div>
    </div>

    <div class="row g-3" id="ParteSuperior">
        <div class="col-12 col-xl-6 card-custom" id="VentasSimples">
            <div class="table-responsive rounded">
                <table class="table table-hover rounded" id="tabla-ventas">
                    <thead>
                        <tr>
                            <th>ID de venta</th>
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

                            <tr
                                class="fila-venta table-<?= htmlspecialchars($clase) ?>"
                                onclick="window.location.href='#venta-<?= (int) $r->id ?>'"
                                style="cursor: pointer;"
                            >
                                <td>
                                    <?= (int) $r->id ?>
                                    <?= $icono ?>
                                </td>
                                <td><?= htmlspecialchars(substr($r->fecha, 0, 10)) ?></td>
                                <td><?= htmlspecialchars($r->cliente ?? '') ?></td>
                                <td>
                                    <a
                                        href="?c=venta&a=FormEditar&id=<?= (int) $r->id ?>"
                                        class="btn btn-flat bg-pink-dark shadow"
                                    >
                                        <i class="bi bi-clipboard"></i> Editar
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

                <div class="card-body">

                    <div class="mb-3">
                        <a href="?c=venta&a=FormCrear" class="btn btn-flat bg-green-dark">
                            <i class="bi bi-plus-circle"></i> Nueva venta
                        </a>
                    </div>

                    <?php
                    $ventasPagadas = $this->venta->ListarPagados();
                    $ganancia = 0;
                    ?>

                    <?php if (!empty($ventasPagadas)): ?>

                        <div class="d-flex flex-column gap-3">

                            <?php foreach ($ventasPagadas as $r): ?>

                                <?php
                                $detalles = $this->detalle->DetallesDeVenta($r->id);
                                $total = 0;
                                ?>

                                <div class="border rounded p-3 bg-green-light row">
                                    <div class="col-4">
                                        <h5>
                                            Venta #<?= (int) $r->id ?>
                                        </h5>
                                    </div>
                                    <div class="col-8">
                                        <?php if (!empty($detalles)): ?>

                                        <?php foreach ($detalles as $d): ?>

                                            <?php
                                            $subtotal = (float) $d->cantidad * (float) $d->precio;

                                            $importeDescuento = $descuento->calcularDescuento(
                                                (int) $d->producto_id,
                                                (int) $d->cantidad,
                                                (float) $d->precio
                                            );

                                            $subtotalFinal = $subtotal - $importeDescuento;
                                            $total += $subtotalFinal;
                                            $ganancia += $total;
                                            ?>

                                            <div class="d-flex justify-content-between gap-2 mb-1">
                                                <span>
                                                    <?= (int) $d->cantidad ?> ×
                                                    <?= htmlspecialchars($d->producto) ?>
                                                </span>
                                                <span>
                                                    ($<?= htmlspecialchars($d->precio) ?> C/U)
                                                </span>

                                                <span>
                                                    $<?= number_format($subtotalFinal, 2) ?>
                                                </span>
                                            </div>
                                        <?php endforeach; ?><hr>

                                    <?php else: ?>
                                        <a href="#venta-<?= (int) $r->id ?>">
                                        <div class="alert alert-danger mb-0" role="alert">
                                            Venta pagada sin productos, cambiar a Pendiente
                                        </div></a>
                                    <?php endif; ?>
                                    </div>
                                    <div class="col-12">
                                            <strong><h6 class="text-end">+ $<?= number_format($total, 2) ?></h6></strong>
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

            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
                <h2><i class="bi bi-receipt"></i> Todas las ventas</h2>
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
                    ?>
                    <div id="venta-<?= (int) $venta->venta_id ?>" class="col-12 col-md-6 col-xl-4 card-custom p-2">

                        <div class="card shadow bg-body rounded h-100">

                            <div class="card-header">
                                <strong>Venta #<?= (int) $venta->venta_id ?></strong>
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
                                            <i class="bi bi-plus-circle"></i> Agregar
                                        </a>

                                        <br>

                                        <a
                                            href="?c=venta&a=FormEditar&id=<?= (int) $venta->venta_id ?>"
                                            class="btn btn-flat bg-pink-dark mb-2 shadow"
                                        >
                                            <i class="bi bi-clipboard"></i> Editar
                                        </a>
                                    </div>

                                </div>

                                <hr>

                                <?php if (!empty($detalles)): ?>

                                    <h5>Se vendieron</h5>

                                    <?php foreach ($detalles as $d): ?>

                                        <?php
                                        $subtotal = (float) $d->cantidad * (float) $d->precio;

                                        $importeDescuento = $descuento->calcularDescuento(
                                            (int) $d->producto_id,
                                            (int) $d->cantidad,
                                            (float) $d->precio
                                        );

                                        $subtotalFinal = $subtotal - $importeDescuento;
                                        $total += $subtotalFinal;
                                        ?>

                                        <div class="d-flex justify-content-between gap-2 mb-1">

                                            <span>
                                                <?= (int) $d->cantidad ?> ×
                                                <?= htmlspecialchars($d->producto) ?>
                                            </span>

                                            <span>
                                                ($<?= number_format((float) $d->precio, 2) ?> C/U)
                                            </span>

                                            <span>
                                                $<?= number_format($subtotalFinal, 2) ?>
                                            </span>

                                        </div>

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

</main>
