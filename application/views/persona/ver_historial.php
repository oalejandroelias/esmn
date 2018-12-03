<?php echo form_open('persona/ver_historial/'.$persona['id'],array("class"=>"form-horizontal")); ?>
<div class="row">
  <div class="col-12">

    <h5 class="card-title"><?php echo $tipo_documento.': '. $persona['numero_documento'];?></h5>

	<div class="row 12">
    <div class="col-md-4 col-12">
      <div class="card">
        <div class="card">
          <div class="card-header bg-cyan text-white font-weight-bold">
            Certificados
          </div>
          <div class="card-body">
            <button type="button" class="btn btn-info" onclick="getRegularidad(<?= $persona['id'] ?>);">Alumno Regular</button>
            <button type="button" class="btn btn-info" onclick="getConstancia(<?= $persona['id'] ?>);">Constancia de Examen</button>
          </div>
        </div>
      </div>
    </div>
     <div class="col-md-2 col-12">
      <div class="card">
        <div class="card">
          <div class="card-header bg-cyan text-white font-weight-bold">
            Promedio
          </div>
          <div class="card-body">
            <h3><?php echo $promedio;?></h3>
          </div>
        </div>
      </div>
    </div>
      <div class="col-md-4 col-12">
      <div class="card">
        <div class="card">
          <div class="card-header bg-cyan text-white font-weight-bold">
            Carrera
          </div>
          <div class="card-body">
             <select name="id_carrera" required class="form-control" onchange='this.form.submit()'>

            <?php
            foreach($carreras_inscripcion as $carrera)
            {
              $selected = ($carrera['id'] == $this->input->post('id_carrera')) ? ' selected="selected"' : "";

              echo '<option value="'.$carrera['id'].'" '.$selected.'>'.$carrera['nombre'].' ('.$carrera['id'].')</option>';
            }
            ?>
          </select>
          <span class="text-danger"><?php echo form_error('id_carrera');?></span>
          </div>
        </div>
      </div>
    </div>
    </div>

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Cursados</h5>

        <div class="table-responsive">
          <div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
            <div class="row">
              <div class="col-sm-12">
                <table id="zero_config" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="zero_config_info">
                  <thead>
                    <tr role="row">
                      <tr>
                        <!-- <th>ID</th> -->
                        <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Materia</th>

                        <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">ID-Carrera</th>
                        <!-- <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Apellido</th> -->
                        <!-- <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Domicilio</th> -->
                        <!-- <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Telefono</th> -->
                        <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Estado</th>
                        <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Fecha</th>
                        <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Nota</th>
                        <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Estado de aprobación</th>
                      </tr>

                    </thead>
                    <tbody>

                      <?php
                      foreach($datos_persona as $dato){ ?>
                        <tr>
                          <td><?php echo $dato['materia_nombre']; ?></td>
                          <td><?php echo $dato['id_carrera']; ?></td>
                          <td><?php echo $dato['nombre_inicial']; ?></td>
                          <td><?php echo $dato['fecha']; ?></td>
                          <td><?php echo $dato['calificacion']; ?></td>
                          <td><?php echo $dato['final_nombre']; ?></td>
                        </tr>

                      <?php } ?>

                    </tbody>

                    <tfoot>
                      <tr>
                        <th rowspan="1" colspan="1">materia</th>
                        <!-- <th rowspan="1" colspan="1">Numero de Documento</th> -->
                        <!-- <th rowspan="1" colspan="1">Ciudad</th> -->
                        <th rowspan="1" colspan="1">ID-Carrera</th>
                        <!-- <th rowspan="1" colspan="1">Apellido</th> -->
                        <!-- <th rowspan="1" colspan="1">Domicilio</th> -->
                        <!-- <th rowspan="1" colspan="1">Telefono</th> -->
                        <th rowspan="1" colspan="1">Estado</th>
                        <th rowspan="1" colspan="1">Fecha</th>
                        <th rowspan="1" colspan="1">Nota</th>
                        <th rowspan="1" colspan="1">Estado de aprobación</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Mesas</h5>
          <div class="table-responsive">
            <div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
              <div class="row">
                <div class="col-sm-12">
                  <table id="aaa" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="zero_config_info">
                    <thead>
                      <tr role="row">
                        <tr>
                          <!-- <th>ID</th> -->
                          <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Materia</th>

                          <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">ID-Carrera</th>
                          <!-- <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Apellido</th> -->
                          <!-- <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Domicilio</th> -->
                          <!-- <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Telefono</th> -->
                          <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Estado</th>
                          <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Fecha</th>
                          <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Nota</th>
                          <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Estado de aprobación</th>
                        </tr>

                      </thead>
                      <tbody>

                        <?php

                        foreach($datos_mesas as $dato){ ?>
                          <tr>
                            <td><?php echo $dato['materia_nombre']; ?></td>
                            <td><?php echo $dato['id_carrera']; ?></td>
                            <td><?php echo $dato['nombre_inicial']; ?></td>
                            <td><?php echo $dato['fecha']; ?></td>
                            <td><?php echo $dato['calificacion']; ?></td>
                            <td><?php echo $dato['final_nombre']; ?></td>
                          </tr>

                        <?php } ?>

                      </tbody>

                      <tfoot>
                        <tr>
                          <th rowspan="1" colspan="1">Documento</th>
                          <!-- <th rowspan="1" colspan="1">Numero de Documento</th> -->
                          <!-- <th rowspan="1" colspan="1">Ciudad</th> -->
                          <th rowspan="1" colspan="1">ID-Carrera</th>
                          <!-- <th rowspan="1" colspan="1">Apellido</th> -->
                          <!-- <th rowspan="1" colspan="1">Domicilio</th> -->
                          <!-- <th rowspan="1" colspan="1">Telefono</th> -->
                          <th rowspan="1" colspan="1">Estado</th>
                          <th rowspan="1" colspan="1">Fecha</th>
                          <th rowspan="1" colspan="1">Nota</th>
                          <th rowspan="1" colspan="1">Estado de aprobación</th>
                        </tr>
                      </tfoot>

                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
