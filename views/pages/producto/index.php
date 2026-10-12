    <main class="app-content">
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
      <div class="app-title">
        <div>
          <h1><i class="bi bi-table"></i> Postres</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h1><a href="?c=producto&a=FormCrear" class="btn btn-primary btn-flat">Nuevo Postre</a></h1>
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th>ID de producto</th>
                      <th>Postre</th>
                      <th>Precio</th>
                      <th>Descripción</th>
                      <th>Estatus</th>
                      <th>Accion</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($this->model->Listar() as $r):?>
                    <tr>
                      <td><?=$r->id?></td>
                      <td><?=$r->nombre?></td>
                      <td><?=$r->precio?></td>
                      <td><?=$r->descripcion?></td>
                      <td><?=$r->estatus?></td>
                      <td><a href="?c=producto&a=FormEditar&id=<?=$r->id?>" class="btn btn-flat btn-warning">Editar</a></td>
                    </tr>
                    <?php endforeach;?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
