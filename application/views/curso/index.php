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

                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Materia</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Periodo de clases</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Catedra</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Acciones</th>
                    </tr>
                  </thead>

                  <tbody>

                	<?php foreach($cursos as $curso){ ?>
                    <tr>
                		<td><?php echo $curso['nombre']; ?></td>
                		<td><?php echo $curso['periodo'].' ('.$curso['desde'].' - '.$curso['hasta'].') - '."<span id='cursoSpan".$curso['curso_id']."'>".$curso['diassemana']."</span>"; ?></td>
                    <?php
                    $personas=array();
                    foreach ($catedras as $c) {
                      if ($c['id_curso']==$curso['curso_id']) {
                        $persona = $c['nombre'].' '.$c['apellido'];
                        array_push($personas,$persona);
                      }
                    }
                     ?>
                		<td><?php echo implode(', ',$personas); ?></td>
                		<td>
                            <?php if($boton_edit){?>
                            <a href="<?php echo site_url('curso/edit/'.$curso['curso_id']); ?>" class="btn btn-info btn-sm">Editar</a>
                          <?php }?>
                          <?php if($boton_remove){?>
                            <a href="<?php echo site_url('curso/remove/'.$curso['curso_id']); ?>" data-confirm="remove" class="btn btn-danger btn-sm">Eliminar</a>
                          <?php }?>
                          <a href="<?php echo site_url('asistencia/control/'.$curso['curso_id']); ?>" class="btn btn-outline-info btn-sm">Asistencias</a>

                        </td>
                    </tr>
                     <?php } ?>
            </tbody>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1">Materia</th>
                <th rowspan="1" colspan="1">Periodo de clases</th>
                <th rowspan="1" colspan="1">Catedra</th>
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
