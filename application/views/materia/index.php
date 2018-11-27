<!-- vista de Index de Materia -->
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

                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Carrera</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Nombre</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Codigo año</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Regimen Cursado</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Regimen Aprobacion</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Carga Horaria</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Tipo Catedra</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Acciones</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php foreach($materias as $m){ ?>
                      <tr data-activo="<?= $m['activo']; ?>" class="<?= ($m['activo']==0) ? 'row-disabled' : ''; ?>">
                        <td><?php echo $m['id_carrera']." - ".$m['nombre_carrera']; ?></td>
                        <td><?php echo $m['nombre_materia']; ?></td>
                        <td><?php echo $m['codigo_anio']; ?></td>
                        <td><?php echo $m['regimen_cursado']; ?></td>
                        <td><?php echo $m['regimen_aprobacion']; ?></td>
                        <td><?php echo $m['carga_horaria']; ?></td>
                        <td><?php echo $m['tipo_catedra']; ?></td>
                        <td>

                          <?php if($boton_edit){?>
                            <a href="<?php echo site_url('materia/edit/'.$m['materia_id']); ?>" class="btn btn-info btn-sm" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                          <?php }?>
                          <?php if($boton_remove){?>
                            <a href="<?php echo site_url('materia/remove/'.$m['materia_id']); ?>" data-confirm="remove" class="btn btn-danger btn-sm" title="Eliminar"><i class="fas fa-times"></i></a>
                          <?php }?>
                          <button type="button" class="btn btn-outline-info btn-sm" onclick="ver_correlativas(<?=$m['materia_id']; ?>,this);">Ver correlativas</button>
                          <button type="button" class="btn btn-outline-info btn-sm" onclick="ver_equivalencias(<?=$m['materia_id']; ?>,this);">Ver equivalencias</button>

                        </td>
                      </tr>
                      <!-- <tr class="d-none">
                      <td colspan="7" data-correlativaheader="<?=$m['materia_id']; ?>"></td>
                      <td><button type="button" name="button">Agregar</button></td>
                    </tr> -->
                    <!-- <tr>
                    <td colspan="8">materia 1</td>
                  </tr>
                  <tr>
                  <td colspan="8">materia 2</td>
                </tr> -->
              <?php } ?>
            </tbody>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1">Carrera</th>
                <th rowspan="1" colspan="1">Nombre</th>
                <th rowspan="1" colspan="1">Codigo año</th>
                <th rowspan="1" colspan="1">Regimen Cursado</th>
                <th rowspan="1" colspan="1">Regimen Aprobacion</th>
                <th rowspan="1" colspan="1">Carga Horaria</th>
                <th rowspan="1" colspan="1">Tipo Catedra</th>
                <th rowspan="1" colspan="1">Acciones</th>
              </tr>
            </tfoot>
          </table>

          <div class="pull-right">
            <?php if ($boton_add): ?>
              <a href="<?php echo site_url('materia/add'); ?>" class="btn btn-success">Nuevo</a>
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
<!-- Modal materias correlativas -->
<div class="modal fade" id="modal_correlativas" role="dialog" aria-labelledby="modal_correlativas" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id=""></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="" data-respuesta=""></div>

        <?php echo form_open('materia_correlativa/add/',array("class"=>"form-horizontal")); ?>
        <input type="hidden" name="id_materia" value="">
        <div class="form-group">
          <label class="col-12">Agregar correlatividad</label>
          <div class="col-12">
            <select class="form-control custom-select" required name="id_correlativa" style="width: 100%; height:36px;">
              <option value="">Buscar</option>
              <?php
              foreach($materias as $m)
              {
                echo '<option value="'.$m['materia_id'].'">'.$m['nombre_materia'].' ('.$m['id_carrera']." - ".$m['nombre_carrera'].')</option>';
              }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-8">
            <button type="submit" class="btn btn-success">Guardar</button>
          </div>
        </div>
        <?php echo form_close(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal materias equivalentes-->
<div class="modal fade" id="modal_equivalencias" role="dialog" aria-labelledby="modal_equivalencias" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id=""></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="" data-respuesta=""></div>

        <?php echo form_open('materia_equivalente/add/',array("class"=>"form-horizontal")); ?>
        <input type="hidden" name="id_materia" value="">
        <div class="form-group">
          <label class="col-12">Agregar equivalencia</label>
          <div class="col-12">
            <select class="form-control custom-select" required name="id_equivalencia" style="width: 100%; height:36px;">
              <option value="">Buscar</option>
              <?php
              foreach($materias as $m)
              {
                echo '<option value="'.$m['materia_id'].'">'.$m['nombre_materia'].' ('.$m['id_carrera']." - ".$m['nombre_carrera'].')</option>';
              }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-12"></label>
          <div class="col-12">
            <div class="custom-control custom-checkbox mr-sm-2">
              <input class="custom-control-input" name="bidireccional" type="checkbox" value="1" checked id="checkbox_bidireccional">
              <label class="custom-control-label" for="checkbox_bidireccional">Equivalencia Bidireccional
                <i class="mdi mdi-alert-circle" data-toggle="tooltip" data-placement="bottom"
                title="Si la materia es quivalente de un nivel superior hacia uno inferior, desmarque esta opcion."></i>
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-8">
            <button type="submit" class="btn btn-success">Guardar</button>
          </div>
        </div>
        <?php echo form_close(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
