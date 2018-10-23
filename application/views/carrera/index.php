	<!-- vista de Index de Carrera -->
	<!--  -->


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

											<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Código de Plan</th>
											<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Nivel</th>
											<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Nombre</th>
											<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Acta</th>
											<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Fecha</th>
											<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Acciones</th>


										</tr>
									</thead>

									<tbody>
										<?php foreach($carreras as $c){ ?>
											<tr>
												<td><?php echo $c['carrera_id']; ?></td>
												<td><?php echo $c['nivel']; ?></td>
												<td><?php echo $c['carrera_nombre']; ?></td>
												<td><?php echo $c['acta']; ?></td>
												<td><?php echo $c['fecha']; ?></td>
												<td>
													<?php if($boton_edit){?>
														<a href="<?php echo site_url('carrera/edit/'.$c['carrera_id']); ?>" class="btn btn-info btn-sm">Editar</a>
													<?php }?>
													<?php if($boton_remove){?>
														<a href="<?php echo site_url('carrera/remove/'.$c['carrera_id']); ?>" data-confirm="remove" class="btn btn-danger btn-sm">Eliminar</a>
													<?php }?>

												</td>
											</tr>
										<?php } ?>
									</tbody>

									<tfoot>
										<tr>

											<th rowspan="1" colspan="1">Código de Plan</th>
											<th rowspan="1" colspan="1">Nivel</th>
											<th rowspan="1" colspan="1">Nombre</th>
											<th rowspan="1" colspan="1">Acta</th>
											<th rowspan="1" colspan="1">Fecha</th>
											<th rowspan="1" colspan="1">Acciones</th>
										</tr>
									</tfoot>
								</table>

								<div class="pull-right">
									<?php if ($boton_add): ?>
										<a href="<?php echo site_url('carrera/add'); ?>" class="btn btn-success">Nuevo</a>
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
