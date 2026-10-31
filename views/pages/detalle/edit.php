<?php 
require_once __DIR__ . "/../venta/descuento.php";
?>

<body class="">
    <main class="">
  <div class="app-title">
    <div>
      <h1><i class="bi bi-ui-checks"></i>Detalles del pedido <?= $_GET['id'] ?></h1>
    </div>
  </div>
  <div class="row flow">
    <div class="col-12 col-md-6 mb-3">
      <div class="card shadow bg-body rounded">
          <form method="POST" action="?c=detalle&a=guardar">
              <h2 class="text-dark text-center">Agregar más postres</h2>
            <div class="p-3">
              <input
                    type="hidden"
                    name="venta_id"
                    value="<?= $d->get_id() ?>"
                >
              <div class="mb-3">
                <label class="form-label"><h3>Postre</h3></label>
                <select class="form-select mb-2" name="producto_id" id="">
                  <?php foreach($this->productos->Disponibles() as $producto): ?>
                  <option value="<?= $producto->id ?>"><?= $producto->nombre ?> -$<?= $producto->precio ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label mb-1"><h3>¿Cuántos?</h3> </label>
                <input class="form-control" type="number" name="cantidad" require value="1">
              </div>
              <input class="form-control" type="hidden" name="notaVenta" require value="<?= $d->get_nota() ?>">
            </div>

            <div class="card-footer">
              <button class="btn btn-primary m-2 p-2" type="submit">
                <i class="bi bi-check-circle-fill me-2"></i>Registrar
              </button>
              <a class="btn btn-success m-2 p-2" href="?c=venta">
                <i class="bi bi-check-circle-fill me-2"></i>Terminado/Regresar
              </a>
              </div>
          </form>
      </div>
    </div>
    <div class="col-12 col-md-6 mb-3">
        <div class="card shadow bg-body rounded h-100">
            <div class="card-header">
                <strong>Venta # <?= $d->get_id() ?></strong>
            </div>

            <div class="card-body">
                <div class="row g-2">
                    <div class="col-6">
                    <p>
                      <strong>Fecha: </strong><?= substr($d->get_fecha(),0,10) ?>
                      <strong>Hora: </strong><?= substr($d->get_fecha(),10,9) ?>
                    </p>

                     <p>
                        <strong>Cliente: </strong><?= $d->get_cliente() ?>
                      </p>
                    </div>
                </div>
                <hr>
                
                    <?php
                $detalles = $this->detalles->DetallesDeVenta($d->get_id());

                $total = 0;
                ?>

                <?php if (!empty($detalles)): ?>

                    <h5>Se vendieron</h5>

                    <?php 
                    switch($d->get_estatus()):
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
                                    
                                        break;
                                    endswitch;
                    foreach ($detalles as $detalle): ?>
                        
                        <?php
                        $subtotal = $detalle->cantidad * $detalle->precio;

                        $descuento = new Descuento();

                        $importeDescuento = $descuento->calcularDescuento(
                            $detalle->producto_id,
                            $detalle->cantidad,
                            $detalle->precio
                        );

                        $subtotalFinal = $subtotal - $importeDescuento;

                        $total += $subtotalFinal;
                        ?>

                        <div class="d-flex justify-content-between gap-2 mb-1">
                            <span>
                                <?= (int) $detalle->cantidad ?> ×
                                <?= htmlspecialchars($detalle->producto) ?>
                            </span>
                            <span>
                                ($<?= $detalle->precio ?> C/U)
                            </span>

                            <span>
                                $<?= number_format($subtotalFinal, 2) ?>
                            </span>
                        </div>

                    <?php endforeach; ?>
                    <hr>
                    <div class="row">
                        <h4 class="col p-2 rounded shadow bg-<?= $clase ?>">
                        <?= $d->get_estatus() ?>
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

                <?php endif; ?>
                <hr>
                <div>
                    <strong>Nota</strong>
                    <p class="mb-0 text-break">
                      <?= $d->get_nota() ?>
                    </p>
                </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</main>
</body>