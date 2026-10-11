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
        <h3 class="tile-title">Nuevo Postre</h3>
        <div class="tile-body">
          <form method="POST" action="?c=producto&a=guardar">
            
            <div class="mb-3">
              <label class="form-label">Nombre del postre</label>
              <input required class="form-control" type="text" name="nombre" placeholder="¿Cómo se llama?">
            </div>

            <div class="mb-3">
              <label class="form-label">Descripción</label>
              <input required class="form-control" type="text" name="descripcion" placeholder="¡Describe qué tan rico sabe!">
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