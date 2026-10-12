<body class="app sidebar-mini">
     <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://randomuser.me/api/portraits/men/1.jpg" alt="User Image">
        <div>
          <p class="app-sidebar__user-name">John Doe</p>
          <p class="app-sidebar__user-designation">Frontend Developer</p>
        </div>
      </div>
      <ul class="app-menu">
        <a class="app-menu__item" href="?c=producto" data-toggle="treeview"><i class="app-menu__icon bi bi-laptop"></i><span class="app-menu__label">Postres</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
      </ul>
    </aside>
    <main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="bi bi-ui-checks"></i>Postres</h1>
    </div>
  </div>
  <div class="row flow">
    <div class="col-md-6">
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
                <option value="No disponible" <?= $p->get_estatus() === 'No disponible' ? 'selected' : '' ?>>No disponible</option>
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