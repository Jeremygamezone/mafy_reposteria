<body class="app sidebar-mini">
    <main class="bg-dark">
      <div>
        <div>
          <h1><i class="bi bi-speedometer"></i> Productos</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
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
        <div class="col-md-6">
          <div class="tile">
             <h1>Ventas de esta semana</h1><br>
              <div id="salesChart">
                <h2>
                    <p>d</p>
              </div>
          </div>
        </div>
      </div>
    </main>
   
  </body>