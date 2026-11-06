<body class="bg-image-03">
    <main class="col-12 col-lg-10 mx-auto">
  <div class="row">
    <div class="col-10 mx-auto text-dark">
      <div class="tile">
        <h3 class="tile-title">Nuevo Postre</h3>
        <div class="tile-body">
          <form method="POST" action="?c=producto&a=guardar">
            
            <div class="mb-3">
              <label class="form-label">Nombre del postre</label>
              <input required class="form-control" type="text" name="nombre" placeholder="¿Cómo se llama?">
            </div>

             <div class="mb-3">
              <label class="form-label">Precio</label>
              <input required class="form-control" type="number" name="precio" placeholder="¿Cuánto cuesta?" step="0.01" min="0">
            </div>
            <div class="mb-3">
              <label class="form-label">Descripción</label>
              <input required class="form-control" type="text" name="descripcion" placeholder="¡Describe qué tan rico sabe!">
            </div>

            <div class="mb-3">
              <input required class="form-control" type="hidden" name="estatus" value="A la venta">
            </div>

            <div class="tile-footer">
              <button class="btn btn-primary" type="submit">
                <i class="bi bi-check-circle-fill me-2"></i>Registrar
              </button>&nbsp;&nbsp;&nbsp;
              <a class="btn btn-secondary" href="?c=producto">
                <i class="bi bi-x-circle-fill me-2"></i>Cancelar
              </a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</main>
  </body>