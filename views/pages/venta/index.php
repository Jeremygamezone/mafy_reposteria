<?php
    $costoVenta = 0;
?>

<main class="text-light bg-dark">
    <div>
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
            <h1><i class="bi bi-table"></i> Ventas</h1>
            <a href="?c=venta&a=FormCrear" class="btn btn-primary btn-flat">
                        <i class="bi bi-plus-circle"></i>
                        Nueva Venta
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="tile">

                <h2 class="h4 mb-3">Ventas usando Ventas->Listar()</h2>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>ID de venta</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Nota</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach($this->venta->Listar() as $r): ?>
                                <tr>

                                <a href="#venta-<?= $r->id ?>" class="text-decoration-none text-dark">
                                    <td><?= $r->id ?></td>
                                    <td><?= $r->fecha ?></td>
                                    <td><?= $r->cliente ?></td>
                                    <td><?= $r->nota ?></td>
                                </a>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                      <tr>
                          <th># Venta</th>
                          <th>Detalles</th>
                          <th>Precio Unitario</th>
                      </tr>
                  </thead>
                  <tbody>
                          <?php foreach ($this->detalle->ConsultarPorVenta() as $item): ?>
                              <tr>
                                  <td><?= $item->numero ?></td>
                                  <td><?= $item->cantidad ?></td>
                                  <td><?= $item->precio ?></td>
                              </tr>
                          <?php endforeach; ?>
                  </tbody>
              </table>
              </div>
            </div>
          </div>
          <div class="tile">
            <h1><a href="?c=producto&a=FormCrear" class="btn btn-primary btn-flat">Nueva Venta</a></h1>
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th># Venta</th>
                      <th>Detalles</th>
                      <th>Fecha</th>
                      <th>Cliente</th>
                      <th>Nota</th>
                      <th>Accion</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($this->model->Listar() as $r): ?>
                      <tr>
                          <td><?= $r->id ?></td>

                          <td>
                              <?php
                              foreach (
                                  $this->detalle->ConsultarPorVenta($r->id)
                                  as $detalle
                              ):
                              ?>
                                  <?= $detalle->cantidad ?> x
                                  <?= $detalle->producto ?>
                                  <?= $detalle->precio ?>
                                  <br>
                              <?php endforeach; ?>
                          </td>

                          <td><?= $r->fecha ?></td>
                          <td><?= $r->cliente ?></td>
                          <td><?= $r->nota ?></td>

                          <td>
                              <a href="?c=venta&a=FormEditar&id=<?= $r->id ?>"
                                class="btn btn-flat btn-warning">
                                  Editar
                              </a>
                          </td>
                      </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
                <h2 class="h4 mb-0">Ventas en cards usando sólo consulta RAW de SQL</h2>

                <div class="row g-3">

                    <?php foreach ($this->venta->DetallesDeVenta() as $d): ?>
                        <div class="col-12 col-md-6 col-xl-4 card-custom" id="venta-<?= $d->venta_id ?>">

                            <div class="card shadow bg-body rounded h-100">
                                <div class="card-header">
                                        <strong>Venta #<?= $d->venta_id ?></strong>
                                    </div>
                                <div class="card-body">

                                    

                                    <p class="mb-2">
                                        <strong>Fecha:</strong>
                                        <?= $d->fecha ?>
                                    </p>

                                    <p class="mb-3">
                                        <strong>Cliente:</strong>
                                        <?= $d->cliente ?>
                                    </p><hr>

                                    <div class="mb-3">
                                        <strong>Productos:</strong>
                                        <div class="text-break">
                                            <?= $d->lista_detalles ?>
                                        </div>
                                    </div>
                                    <p class="mb-2">
                                        <strong>Total:</strong>
                                        $<?= $d->total_venta ?>
                                    </p><hr>

                                    <div>
                                        <strong>Nota:</strong>
                                        <p class="mb-0 text-break">
                                            <?= $d->nota ?>
                                        </p>
                                    </div>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>
        </div>
    </div>

    <!-- Tercera sección: detalles de venta -->
    <div class="row">
        <div class="col-12">

                <h2 class="h4 mb-3">
                    Detalles de venta usando dos funciones para Venta->Listar() y Detalles->DetallesDeVenta($id)
                </h2>

                    <?php foreach ($this->venta->ListarB() as $venta): ?>

                  <div class="card mb-3 shadow bg-body rounded">
                      <div class="card-header">
                          <h4>Venta #<?= $venta->venta_id ?></h4>
                      </div>

                      <div class="card-body">

                          <h5 class="card-title">
                              <?= htmlspecialchars($venta->nombre_usuario) ?>
                          </h5>

                          <p>
                              Fecha: <?= htmlspecialchars($venta->fecha) ?>
                          </p>

                          <p>
                              Cliente: <?= htmlspecialchars($venta->cliente) ?>
                          </p>

                          <p>
                              Nota: <?= htmlspecialchars($venta->nota) ?>
                          </p>

                          <hr>

                          <h5>Se vendieron</h5>

                          <?php
                          $detalles = $this->detalle->DetallesDeVenta($venta->venta_id);

                          $total = 0;
                          ?>
                                <div class="d-flex justify-content-between">
                                  <span>
                                    <h6>Postre</h6>
                                  </span>
                                  <span>
                                    <h6>Precio unitario</h6>
                                  </span>
                                  <span>
                                    <h6>Subtotal</h6>
                                  </span>
                              </div>
                          <?php foreach ($detalles as $d): ?>

                              <?php
                              $subtotal = $d->cantidad * $d->precio;
                              $total += $subtotal;
                              ?>
                            
                              <div class="d-flex justify-content-between">
                                  <span>
                                      <?= (int) $d->cantidad ?> ×
                                      <?= htmlspecialchars($d->producto) ?>
                                  </span>
                                  <span>
                                        $<?= number_format($d->precio, 2) ?>
                                  </span>
                                  <span>
                                      $<?= number_format($subtotal, 2) ?>
                                  </span>
                              </div>

                          <?php endforeach; ?>

                          <hr>

                          <div class="text-end">
                            <h4><strong>
                                  Total $<?= number_format($total, 2) ?>
                              </strong></h4>
                              
                          </div>

                      </div>
                  </div>

              <?php endforeach; ?>
        </div>
    </div>

</main>
