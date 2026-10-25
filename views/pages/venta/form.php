<body class="">
    <main class="">
  <div class="app-title">
    <div>
      <h1><i class="bi bi-ui-checks"></i>¡Nueva Venta!</h1>
    </div>
  </div>
  <div class="row flow">
    <div class="col-md-6">
      <div class="tile">
        <h3 class="tile-title">Venta</h3>
        <div class="tile-body">
          <form method="POST" action="?c=venta&a=guardar">
             <div class="mb-3">
              <label class="form-label">Fecha</label>
              <input type="text" id="fecha" name="fecha" readonly>
            </div>
            <div class="mb-3">
              <label class="form-label">Cliente</label>
              <input required class="form-control" type="text" name="cliente" placeholder="¿Para quién es?">
            </div>
            <div class="mb-3">
              <label class="form-label">Nota</label>
              <textarea required class="form-control" name="nota" placeholder="Deja un comentario..."></textarea>
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
<script>
    function actualizarFecha() {
        const ahora = new Date();

        const formato = ahora.getFullYear() + '-' +
            String(ahora.getMonth() + 1).padStart(2, '0') + '-' +
            String(ahora.getDate()).padStart(2, '0') + ' ' +
            String(ahora.getHours()).padStart(2, '0') + ':' +
            String(ahora.getMinutes()).padStart(2, '0') + ':' +
            String(ahora.getSeconds()).padStart(2, '0');

        document.getElementById('fecha').value = formato;
    }

    actualizarFecha();
</script>