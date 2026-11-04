<body class="bg-image-03">
<main class="col-12 col-lg-10 mx-auto">
  <div class="row">
    <div class="col-10 mx-auto">
      <div class="tile">
        <h3 class="tile-title">Editar <?=$p->get_nombre()?></h3>
        <div class="tile-body">
          <form method="POST" action="?c=producto&a=editar">
            <div>
                <input
                    type="hidden"
                    name="id"
                    value="<?= $p->get_id() ?>"
                >
            </div>
             

            <div class="mb-3">
              <label class="form-label">Nombre del postre</label>
              <input required class="form-control" type="text" name="nombre" placeholder="¿Cómo se llama?" value="<?=$p->get_nombre()?>">
            </div>

            <div class="mb-3">
              <label class="form-label">Precio</label>
              <input required class="form-control" type="number" name="precio" placeholder="¿Cuánto cuesta?" step="0.01" min="0" value="<?=$p->get_precio()?>">
            </div>

            <div class="mb-3">
              <label class="form-label">Descripción</label>
              <input required class="form-control" type="text" name="descripcion" placeholder="¡Describe qué tan rico sabe!" value="<?=$p->get_descripcion()?>">
            </div>

            <div class="mb-3">
              <label class="form-label">Disponibilidad</label>
              <select required class="form-control" name="estatus">
                <option value="A la venta" <?= $p->get_estatus() === 'A la venta' ? 'selected' : '' ?>>A la venta</option>
                <option value="Agotado" <?= $p->get_estatus() === 'Agotado' ? 'selected' : '' ?>>Agotado</option>
              </select>
            </div>

            <div class="tile-footer">
              <button class="btn btn-primary" type="submit">
                <i class="bi bi-check-circle-fill me-2"></i>Guardar cambios
              </button>&nbsp;&nbsp;&nbsp;
              <a class="btn btn-secondary" href="?c=producto">
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