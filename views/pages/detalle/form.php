<?php 
?>
<body class="">
    <main class="">
  <div class="app-title">
    <div>
      <h1><i class="bi bi-ui-checks"></i>Pedido <?= $_GET['id'] ?></h1>
    </div>
  </div>
  <div class="row flow">
    <div class="col-md-6">
      <div class="tile">
        <div class="tile-body">
          <form method="POST" action="?c=detalle&a=guardar">
             <div class="mb-3">
              <label for="form-label"><h2># de Venta <?= $_GET['id'] ?> </h2></label>
              <input type="hidden" id="venta_id" name="venta_id" readonly value="<?= $_GET['id'] ?>">
            </div>
            <div class="mb-3">
              <label for="form-label"><h2>Postre a agregar</h2></label>
              <select class="form-select" name="producto_id" id="">
                <?php foreach($this->productos->Disponibles() as $producto): ?>
                <option value="<?= $producto->id ?>"><?= $producto->nombre ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label"><h2>¿Cuántos?</h2> </label>
              <input type="number" name="cantidad">
            </div>

            <div class="tile-footer">
              <button class="btn btn-primary" type="submit">
                <i class="bi bi-check-circle-fill me-2"></i>Registrar
              </button>
              <a class="btn btn-secondary" href="?c=venta">
                <i class="bi bi-x-circle-fill me-2"></i>Cancelar venta
              </a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</main>
</body>