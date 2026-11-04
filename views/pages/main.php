<body class="bg-image-01">
    <main class="col-12 col-lg-10 mx-auto">
      <div class="mb-4 p-3">
        <h1 class="text-center text-light"><i class="bi bi-bookmark-heart"></i>   Bienvenida     <i class="bi bi-bookmark-heart"></i></h1>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <div class="mb-5 text-dark">
              <h1>Postres</h1>
            </div>
              <div id="salesChart" class="text-dark">
                <?php $p=$this->model->Disponibles()?>
                <h2><?php foreach($p as $producto): ?>
                    <p><?= $producto->nombre ?> - $<?= number_format($producto->precio, 2) ?></p>
                <?php endforeach; ?></h2>
              </div>
          </div>
        </div>
        <div class="col-md-6">

              <div class="card shadow bg-body rounded">
                    <div class="card-header bg-green-dark">
                        <h2 class="h3">Ventas pagadas de esta semana</h2>
                    </div>
                    <div class="card-body m-2">
                        <?php
                            $ventasPagadas = $this->ventas->ListarPagados();
                            $ganancia = 0;
                        ?>

                        <?php if (!empty($ventasPagadas)): ?>

                            <div class="ventas-pagadas-scroll mb-3 col-12 mx-auto">

                                <?php foreach ($ventasPagadas as $r): ?>

                                    <?php
                                        $detalles = $this->detalles->DetallesDeVenta($r->id);

                                        $total = 0;
                                        $cantidadTotalElegible = 0;

                                        // PRIMER RECORRIDO: sumar unidades elegibles
                                        foreach ($detalles as $d) {

                                            if (in_array((int)$d->producto_id, [1, 2, 3, 4])) {
                                                $cantidadTotalElegible += (int)$d->cantidad;
                                            }
                                        }

                                        // SEGUNDO RECORRIDO: calcular subtotales y descuentos
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

                                    <div class="border rounded p-3 m-1 bg-green-light d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>Venta #<?= (int)$r->id ?></strong>
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
        </div>
      </div>
    </main>
</body>
