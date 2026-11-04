<body class="bg-image-02">
<main class="col-12 col-lg-10 mx-auto">
      <div class="row">
        <div class="col-12 col-lg-10 mx-auto">
          <div class="bg-dark">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
                <h1><i class="bi bi-cake2"></i> Postres</h1>
            </div>
        </div>
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
                      <td>$ <?=$r->precio?></td>
                      <td><?=$r->descripcion?></td>
                      <td><?=$r->estatus?></td>
                      <td><a href="?c=producto&a=FormEditar&id=<?=$r->id?>" class="btn btn-flat bg-pink-dark">Editar</a></td>
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
</body>
