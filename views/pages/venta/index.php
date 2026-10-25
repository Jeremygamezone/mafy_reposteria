<?php
    require_once 'descuento.php';

    $costoVenta = 0;
    
                                         $descuento = new Descuento();

?>
<main class="text-light bg-dark" style="background-color: var(--bs-wine--dark) !important;">
    <div clas="bg-dark">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
            <h1><i class="bi bi-table"></i> Ventas</h1>
            
        </div>
    </div>

    <div class="row">
        <div class="col-12">
                <h2 class="h4 text-yellow-light">Ventas en tabla usando sólo consulta RAW de SQL</h2>
                    <br>
                
        </div>
    </div>
    <div class="row g-2">
            <div class="col-12 col-md-12 col-xl-6 card-custom">
                          <div class="table-responsive rounded">
                    <table class="table table-hover" id="sampleTable">
                        <thead>
                            <tr>
                                <th>ID de venta</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach($this->venta->Listar() as $r): ?>
                                    <tr class="fila-venta"
                                        onclick="window.location.href='#venta-<?= $r->id ?>'"
                                        style="cursor: pointer;">
                                    <td><?= $r->id ?></td>
                                    <td><?= substr($r->fecha,0,10) ?></td>
                                    <td><?= $r->cliente ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                        </div>
            <div class="col-12 col-md-12 col-xl-6 card-custom">
                            <div class="card shadow bg-body rounded">
                                <div class="card-header">
                                       <h1>Pene</h1>
                                    </div>
                                <div class="card-body">
                                <a href="?c=venta&a=FormCrear" class="btn btn-primary btn-flat">
                                            <i class="bi bi-plus-circle"></i>
                                            Nueva Venta
                                </a>
                                    <p class="mb-3">
                                        <strong>Cliente</strong>
                                        texto de ejemplo
                                    </p><hr>

                                    <div class="mb-3">
                                        <h5>Se vendieron</h5>
                                                
                                        <div class="text-end">
                                            <h4><strong>
                                                texto de ejemplo
                                            </strong></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
                <h2 class="h4 mb-0 text-yellow-light">Ventas en cards usando sólo consulta RAW de SQL</h2>
                    <br>
                <div class="row g-3">

                    
<?php foreach ($this->venta->ListarB() as $venta): ?>

    <div class="col-12 col-md-6 col-xl-4 card-custom"
         id="venta-<?= $venta->venta_id ?>">

        <div class="card shadow bg-body rounded h-100">
            <div class="card-header">
                <strong>Venta #<?= $venta->venta_id ?></strong>
            </div>

            <div class="card-body">

                <p>
                    <strong>Fecha:</strong>
                    <?= htmlspecialchars($venta->fecha) ?>
                </p>

                <p>
                    <strong>Cliente:</strong>
                    <?= htmlspecialchars($venta->cliente ?? '') ?>
                </p>

                <hr>

                <?php
                // Consultamos los detalles una sola vez.
                $detalles = $this->detalle->DetallesDeVenta(
                    $venta->venta_id
                );

                $total = 0;
                ?>

                <?php if (!empty($detalles)): ?>

                    <h5>Se vendieron</h5>

                    <?php foreach ($detalles as $d): ?>

                        <?php
                        $subtotal = $d->cantidad * $d->precio;
                        $total += $subtotal;
                        ?>

                        <div class="d-flex justify-content-between gap-2">
                            <span>
                                <?= (int) $d->cantidad ?> ×
                                <?= htmlspecialchars($d->producto) ?>
                            </span>

                            <span>
                                $<?= number_format($subtotal, 2) ?>
                            </span>
                        </div>

                    <?php endforeach; ?>

                    <hr>

                    <h4 class="text-end">
                        Total: $<?= number_format($total, 2) ?>
                    </h4>

                <?php else: ?>

                    <div class="alert alert-warning" role="alert">
                        <i class="bi bi-exclamation-circle"></i>
                        Esta venta aún no tiene productos registrados.
                    </div>

                <?php endif; ?>

                <hr>

                <div>
                    <strong>Nota</strong>
                    <p class="mb-0 text-break">
                        <?= htmlspecialchars($venta->nota ?? '') ?>
                    </p>
                </div>

            </div>
        </div>
    </div>

<?php endforeach; ?>

                </div>
        </div>
    </div>
</main>