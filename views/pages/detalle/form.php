<body class="">
    <main class="">
  <div class="app-title">
    <div>
      <h1><i class="bi bi-ui-checks"></i>Pedido</h1>
    </div>
  </div>
  <div class="row flow">
    <div class="col-md-6">
      <div class="tile">
        <h3 class="tile-title">¿Qué se encargó?</h3>
        <div class="tile-body">
          <form method="POST" action="?c=detalle&a=guardar">
             <div class="mb-3">
              <input type="text" id="venta_id" name="venta_id" readonly value="1">
            </div>
            <div class="mb-3">
              <input type="text" id="venta_id" name="producto_id" readonly value="1">
            </div>
            <div class="mb-3">
              <label class="form-label">Cantidad</label>
              <input type="number" name="cantidad">
            </div>

            <div class="tile-footer">
              <button class="btn btn-primary" type="submit">
                <i class="bi bi-check-circle-fill me-2"></i>Registrar
              </button>&nbsp;&nbsp;&nbsp;
              <a class="btn btn-secondary" href="?c=producto">
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