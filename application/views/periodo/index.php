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

                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Periodo</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Desde</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Hasta</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Acciones</th>

                    </tr>
                  </thead>

                  <tbody>

                    <?php foreach($periodos as $p){ ?>
                      <tr>
                        <td><?php echo $p['descripcion']; ?></td>
                        <td><?php echo iconv('ISO-8859-2', 'UTF-8', strftime("%d de %B de %Y", strtotime($p['desde']))); ?></td>
                        <td><?php echo iconv('ISO-8859-2', 'UTF-8', strftime("%d de %B de %Y", strtotime($p['hasta']))); ?></td>
                        <td>
                          <?php if($boton_edit){?>
                            <a href="<?php echo site_url('periodo/edit/'.$p['id']); ?>" class="btn btn-info btn-sm">Editar</a>
                          <?php }?>
                          <?php if($boton_remove){?>
                            <a href="<?php echo site_url('periodo/remove/'.$p['id']); ?>" data-confirm="remove" class="btn btn-danger btn-sm">Eliminar</a>
                          <?php }?>

                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>

                  <tfoot>
                    <tr>
                      <th rowspan="1" colspan="1">Periodo</th>
                      <th rowspan="1" colspan="1">Desde</th>
                      <th rowspan="1" colspan="1">Hasta</th>
                      <th rowspan="1" colspan="1">Acciones</th>

                    </tr>
                  </tfoot>
                </table>

                <div class="pull-right">
                  <?php if ($boton_add): ?>
                    <a href="<?php echo site_url('periodo/add'); ?>" class="btn btn-success">Nuevo</a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
