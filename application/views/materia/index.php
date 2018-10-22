
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
										 <tr>
											 <td><?php echo $m['id_carrera']." - ".$m['nombre_carrera']; ?></td>
											 <td><?php echo $m['nombre_materia']; ?></td>
											 <td><?php echo $m['codigo_anio']; ?></td>
											 <td><?php echo $m['regimen_cursado']; ?></td>
											 <td><?php echo $m['regimen_aprobacion']; ?></td>
											 <td><?php echo $m['carga_horaria']; ?></td>
											 <td><?php echo $m['tipo_catedra']; ?></td>
											 <td>

												 <?php if($boton_edit){?>
													 <a href="<?php echo site_url('materia/edit/'.$m['materia_id']); ?>" class="btn btn-info btn-sm">Editar</a>
												 <?php }?>
												 <?php if($boton_remove){?>
													 <a href="<?php echo site_url('materia/remove/'.$m['materia_id']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
												 <?php }?>

											 </td>
										 </tr>
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
