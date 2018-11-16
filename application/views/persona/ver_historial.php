<div class="row">
  <div class="col-12">

	<h5 class="card-title"><?php echo $all_tipo_documento[0]['nombre'].': '. $persona['numero_documento'];?></h5>
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
