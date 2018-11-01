<!-- vista de Index de curso -->
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

                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">ID</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Id curso</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Periodo</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Diascursado</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Acciones</th>
                    </tr>
                  </thead>

                  <tbody>
	
    
                	<?php foreach($curso as $c){ ?>
                    <tr>
                		<td><?php echo $c['id']; ?></td>
                		<td><?php echo $c['id_curso']; ?></td>
                		<td><?php echo $c['periodo']; ?></td>
                		<td><?php echo $c['diascursado']; ?></td>
                		<td>
                            <?php if($boton_edit){?>
                            <a href="<?php echo site_url('curso/edit/'.$m['curso_id']); ?>" class="btn btn-info btn-sm">Editar</a>
                          <?php }?>
                          <?php if($boton_remove){?>
                            <a href="<?php echo site_url('curso/remove/'.$m['curso_id']); ?>" data-confirm="remove" class="btn btn-danger btn-sm">Eliminar</a>
                          <?php }?>
                          <button type="button" class="btn btn-outline-info btn-sm" onclick="ver_correlativas(<?=$m['curso_id']; ?>,this);">Ver correlativas</button>
                        </td>
                    </tr>
                     <?php } ?>
            </tbody>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1">ID</th>
                <th rowspan="1" colspan="1">Id Curso</th>
                <th rowspan="1" colspan="1">Periodo</th>
                <th rowspan="1" colspan="1">Dias cursados</th>
                <th rowspan="1" colspan="1">Acciones</th>
               
              </tr>
            </tfoot>
          </table>

          <div class="pull-right">
            <?php if ($boton_add): ?>
              <a href="<?php echo site_url('curso/add'); ?>" class="btn btn-success">Nuevo</a>
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
