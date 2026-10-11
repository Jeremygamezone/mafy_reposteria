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
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">PUTO</h3>
              <div id="salesChart">
                <h1>Hola</h1>
                <p><?php $p=$this->model->Listar()?>
                <?=var_dump($p)?>
            </p>
              </div>
          </div>
        </div>
      </div>
    </main>
   
  </body>