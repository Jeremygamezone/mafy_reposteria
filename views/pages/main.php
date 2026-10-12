<body class="app sidebar-mini">
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
   
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
          <h1><i class="bi bi-speedometer"></i> Productos</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <div class="tile">
             <h1>Productos Disponibles</h1><br>
              <div id="salesChart">
                <?php $d=$this->model->Disponibles()?>
                <h2><?php foreach($d as $producto): ?>
                    <p><?= $producto->nombre ?> - $<?= number_format($producto->precio, 2) ?></p>
                <?php endforeach; ?></h2>
              </div>
          </div>
        </div>
      </div>
    </main>
   
  </body>