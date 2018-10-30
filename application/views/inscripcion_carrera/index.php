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
											<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Alumno</th>
											<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Acciones</th>
										</tr>
									</thead>

									<tbody>
										<?php foreach($inscripcion_carrera as $i){ ?>
											<tr>
												<td><?php echo $i['id_carrera'].' - '.$i['nombre_carrera']; ?></td>
                        <td><?php echo $i['nombre_persona'].' '.$i['apellido_persona'].', '.$i['tipo_documento_nombre'].' - '.$i['numero_documento']; ?></td>
												<td>

													<?php if($boton_edit){?>
														<a href="<?php echo site_url('inscripcion_carrera/edit/'.$i['id_persona'].'/'.$i['id_carrera']); ?>" class="btn btn-info btn-sm">Editar</a>
													<?php }?>
													<?php if($boton_remove){?>
														<a href="<?php echo site_url('inscripcion_carrera/remove/'.$i['id_persona'].'/'.$i['id_carrera']); ?>" data-confirm="remove" class="btn btn-danger btn-sm">Eliminar</a>
													<?php }?>

												</td>
											</tr>
										<?php } ?>
									</tbody>

									<tfoot>
										<tr>
											<th rowspan="1" colspan="1">Carrera</th>
											<th rowspan="1" colspan="1">Alumno</th>
											<th rowspan="1" colspan="1">Acciones</th>
										</tr>
									</tfoot>
								</table>

								<div class="pull-right">
									<?php if ($boton_add): ?>
										<a href="<?php echo site_url('inscripcion_carrera/add'); ?>" class="btn btn-success">Nueva</a>
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
