
<div class="row">
  <div class="col-12">

    <div class="card">
      <div class="card-body">
        <!-- <h5 class="card-title">Basic Datatable</h5> -->
        <div class="table-responsive">
          <div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
            <div class="row">
              <div class="col-sm-12">
                <table id="zero_config" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="zero_config_info">
                  <thead>
                    <tr role="row">

                      <!-- <th>ID</th> -->
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Nombre</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Permisos</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Acciones</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php foreach($perfiles as $p){ ?>
                      <tr>
                        <!-- <td><?php echo $p['id']; ?></td> -->
                        <td><?php echo $p['nombre']; ?></td>
                        <td><?php echo $p['permisos']; ?></td>
                        <td>

                          <?php if($boton_edit){?>
                            <a href="<?php echo site_url('Perfil/edit/'.$p['id']); ?>" class="btn btn-info btn-sm">Editar</a>
                          <?php }?>
                          <?php if($boton_remove){?>
                            <a href="<?php echo site_url('Perfil/remove/'.$p['id']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                          <?php }?>

                          <a href="<?php echo site_url('Perfil/edit_permission/'.$p['id']); ?>" class="btn btn-warning btn-sm">Editar permisos</a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>

                  <tfoot>
                    <tr>
                      <th rowspan="1" colspan="1">Nombre</th>
                      <th rowspan="1" colspan="1">Permisos</th>
                      <th rowspan="1" colspan="1">Acciones</th>
                    </tr>
                  </tfoot>
                </table>
                <div class="pull-right">
                  <a href="<?php echo site_url('Perfil/add'); ?>" class="btn btn-success">Nuevo</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
