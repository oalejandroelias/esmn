<div class="row">
  <div class="col-12">

    <div class="card">
      <div class="card-body">
        <!-- <h5 class="card-title">Basic Datatable</h5> -->
        <button type="button" class="btn btn-sm btn-primary mb-3" onclick="mostrarTodo();">Mostrar deshabilitados</button>
        <div class="table-responsive">
          <div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
            <div class="row">
              <div class="col-sm-12">
                <table id="zero_config" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="zero_config_info">
                  <thead>
                    <tr role="row">
                      <!-- <th>ID</th> -->
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Documento</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Nombre</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Apellido</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Username</th>
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Rol</th>
                      <!--<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Permisos</th> -->
                      <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Acciones</th>
                    </tr>

                  </thead>

                  <tbody>
                    <?php foreach($usuarios as $u){ ?>
                      <tr data-activo="<?= $u['activo']; ?>" class="<?= ($u['activo']==0) ? 'row-disabled' : ''; ?>">
                        <td><?= $u['tipo_documento']." - ".$u['numero_documento']; ?></td>
                        <td><?= $u['nombre']; ?></td>
                        <td><?= $u['apellido']; ?></td>
                        <td><?= $u['username']; ?></td>
                        <td><?= $u['rol']; ?></td>
                        <!--<td><?= $u['permisos']?></td> -->
                        <td>

                          <?php if($boton_edit){?>
                            <a href="<?= site_url('Usuario/edit/'.$u['usuario_id']); ?>" class="btn btn-info btn-sm">Editar</a>
                          <?php } ?>
                          <?php if($boton_remove){?>
                            <?php if ($u['activo'] == 0): ?>
                              <a href="<?= site_url('Usuario/remove/'.$u['usuario_id'].'/1'); ?>" data-confirm="remove" class="btn btn-success btn-sm"><i class="mdi mdi-eye"></i> Habilitar</a>
                              <?php else: ?>
                                <a href="<?= site_url('Usuario/remove/'.$u['usuario_id'].'/0'); ?>" data-confirm="remove" class="btn btn-danger btn-sm"><i class="mdi mdi-eye-off"></i> Deshabilitar</a>
                            <?php endif; ?>
                          <?php } ?>


                        </td>
                      </tr>
                    <?php } ?>

                  </tbody>

                  <tfoot>
                    <tr>

                      <th rowspan="1" colspan="1">Documento</th>
                      <th rowspan="1" colspan="1">Nombre</th>
                      <th rowspan="1" colspan="1">Apellido</th>
                      <th rowspan="1" colspan="1">Username</th>
                      <th rowspan="1" colspan="1">Rol</th>
                      <!--<th rowspan="1" colspan="1">Permisos</th>-->
                      <th rowspan="1" colspan="1">Acciones</th>
                    </tr>
                  </tfoot>

                </table>
              </div>
              <!-- <div class="float-right position-relative b-3">
                <a href="<?php echo site_url('Usuario/add'); ?>" class="btn btn-success">Nuevo</a>
              </div> -->

              <div class="float-right">
                <?php echo $this->pagination->create_links(); ?>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>
