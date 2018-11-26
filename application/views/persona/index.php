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
                      <tr>
                        <!-- <th>ID</th> -->
                        <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Documento</th>
                        <!-- <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Numero Documento</th> -->
                        <!-- <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Ciudad</th> -->
                        <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Nombre y Apellido</th>
                        <!-- <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Apellido</th> -->
                        <!-- <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Domicilio</th> -->
                        <!-- <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Telefono</th> -->
                        <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Email</th>
                        <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Fecha Nacimiento</th>
                        <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Acciones</th>
                      </tr>

                    </thead>
                    <tbody>


                      <?php

                      foreach($personas as $p){ ?>
                        <tr data-activo="<?= $p['activo']; ?>" class="<?= ($p['activo']==0) ? 'row-disabled' : ''; ?>">
                          <td><?php echo $p['tipo_documento'].' - '.$p['numero_documento']; ?></td>
                          <!-- <td><?php echo $p['numero_documento']; ?></td> -->
                          <!-- <td><?php echo $p['ciudad']; ?></td> -->
                          <td><?php echo $p['nombre'].' '.$p['apellido']; ?></td>
                          <!-- <td><?php echo $p['apellido']; ?></td> -->
                          <!-- <td><?php echo $p['domicilio']; ?></td> -->
                          <!-- <td><?php echo $p['telefono']; ?></td> -->
                          <td><?php echo $p['email']; ?></td>
                          <td><?php echo iconv('ISO-8859-2', 'UTF-8', strftime("%d de %B de %Y", strtotime($p['fecha_nacimiento']))); ?></td>
                          <td>

                            <?php if($boton_edit){?>
                              <a href="<?php echo site_url('Persona/edit/'.$p['persona_id']); ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                            <?php }?>
                            <?php if($boton_remove){?>
                              <a href="<?php echo site_url('Persona/remove/'.$p['persona_id']); ?>" data-confirm="remove" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Eliminar"><i class="fas fa-times"></i></a>
                            <?php }?>

                            <?php if (empty($this->Usuario_model->get_usuario_by_persona($p['persona_id']))): ?>
                              <a href="<?php echo site_url('Usuario/add/'.$p['persona_id']); ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Crear usuario"><i class="fas fa-user"></i></a>
                            <?php else: ?>
                              <span title="Ya tiene un usuario creado" data-toggle="tooltip" data-placement="bottom"><a href="#" class="btn btn-primary btn-sm disabled" tabindex="-1" role="button" aria-disabled="true"><i class="fas fa-user"></i></a></span>
                            <?php endif; ?>
                            <a href="<?php echo site_url('Documentacion/ver/'.$p['persona_id']); ?>" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Documentacion"><i class="fas fa-file-alt"></i></a>
                            <!-- <a href="<?php echo site_url('persona_tutor/relacion/'.$p['persona_id']); ?>" class="btn btn-outline-secondary btn-sm">Relaciones</a> -->
                            <a href="<?php echo site_url('Persona/ver_historial/'.$p['persona_id']); ?>" class="btn btn-outline-secondary btn-sm">Historial</a>
                          </td>
                        </tr>
                      <?php } ?>

                    </tbody>

                    <tfoot>
                      <tr>
                        <th rowspan="1" colspan="1">Documento</th>
                        <!-- <th rowspan="1" colspan="1">Numero de Documento</th> -->
                        <!-- <th rowspan="1" colspan="1">Ciudad</th> -->
                        <th rowspan="1" colspan="1">Nombre y Apellido</th>
                        <!-- <th rowspan="1" colspan="1">Apellido</th> -->
                        <!-- <th rowspan="1" colspan="1">Domicilio</th> -->
                        <!-- <th rowspan="1" colspan="1">Telefono</th> -->
                        <th rowspan="1" colspan="1">Email</th>
                        <th rowspan="1" colspan="1">Fecha de Nacimiento</th>
                        <th rowspan="1" colspan="1">Acciones</th>
                      </tr>
                    </tfoot>

                  </table>


                </div>
                <div class="float-right position-relative b-3">
                  <a href="<?php echo site_url('Persona/add'); ?>" class="btn btn-success">Nuevo</a>
                </div>

                <!-- <div class="float-right">
                  <?php echo $this->pagination->create_links(); ?>
                </div> -->
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
