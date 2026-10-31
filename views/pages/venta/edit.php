<body>
    <main >
  <div class="app-title">
    <div>
      <h1><i class="bi bi-ui-checks"></i>Venta</h1>
    </div>
  </div>
  <div class="row flow">
    <div class="col-md-6">
      <div class="tile">
        <h3 class="tile-title">Editar Información de la Venta #<?=$v->get_id()?></h3>
        <div class="tile-body">
          <form method="POST" action="?c=venta&a=editar">
            <div>
                <input
                    type="hidden"
                    name="id"
                    value=""
                >
            </div>
             

            <div class="mb-3">
              <input type="hidden" name="id" value="<?=$v->get_id()?>">
              <input type="hidden" name="usuario_id" value="<?=$v->get_usuario_id()?>">
              <label class="form-label">Fecha</label>
              <input type="text" id="fecha" name="fecha" readonly value="<?=$v->get_fecha()?>">
            </div>
            <div class="mb-3">
              <label class="form-label">Cliente</label>
              <input required class="form-control" type="text" name="cliente" value="<?=$v->get_cliente()?>">
            </div>
            <div class="mb-3">
              <label class="form-label">Nota</label>
              <textarea required class="form-control" name="nota"><?=$v->get_nota()?></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Disponibilidad</label>
              <select required class="form-control" name="estatus">
                <option value="Pagado" class="" <?= $v->get_estatus() === 'Pagado' ? 'selected' : '' ?>>Pagado</option>
                <option value="Pendiente" <?= $v->get_estatus() === 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
                <option value="Cancelado" <?= $v->get_estatus() === 'Cancelado' ? 'selected' : '' ?>>Cancelado</option>
              </select>
            </div>

            <div class="tile-footer">
              <button class="btn btn-primary" type="submit">
                <i class="bi bi-check-circle-fill me-2"></i>Guardar cambios
              </button>
              <a class="btn btn-secondary" href="?c=venta">
                <i class="bi bi-x-circle-fill me-2"></i>Regresar
              </a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</main>
  </body>