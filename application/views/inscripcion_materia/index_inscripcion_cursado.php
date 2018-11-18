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

											<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Curso</th>
											<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Tipo Catedra</th>
											<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Estado</th>
											<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Alumno</th>
											<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Asistencia</th>
											<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Calificación</th>
											<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Acciones</th>
										</tr>
									</thead>

									<tbody>
										<?php foreach($inscripcion_materia as $i){ ?>
											<tr>
												<td><?php echo $i['nombre_materia'].' ('.$i['id_carrera'].')'; ?></td>
												<td><?php echo $i['tipo_catedra']; ?></td>
												<td><?php echo $i['nombre_estado_inicial']; ?></td>
												<td><?php echo $i['nombre_persona'].' '.$i['apellido_persona'].' - '.$i['numero_documento']; ?></td>
												<td><?php echo ($i['porcentaje']) ? $i['porcentaje'].'%, '.$i['faltas'].' faltas' : ' - '; ?></td>
												<td><?php echo $i['calificacion']; ?></td>
												<td>

													<?php if($boton_edit){?>
														<a href="<?php echo site_url('inscripcion_materia/edit_inscripcion_cursado/'.$i['id_inscripcion_materia']); ?>" class="btn btn-info btn-sm">Editar</a>
													<?php }?>
													<?php if($boton_remove){?>
														<a href="<?php echo site_url('inscripcion_materia/remove_inscripcion_cursado/'.$i['id_inscripcion_materia']); ?>" data-confirm="remove" class="btn btn-danger btn-sm">Eliminar</a>
													<?php }?>
													<button type="button" class="btn btn-outline-info btn-sm">Cambiar Calificación</button>

												</td>
											</tr>
										<?php } ?>
									</tbody>

									<tfoot>
										<tr>
											<th rowspan="1" colspan="1">Curso</th>
											<th rowspan="1" colspan="1">Tipo Catedra</th>
											<th rowspan="1" colspan="1">Estado</th>
											<th rowspan="1" colspan="1">Alumno</th>
											<th rowspan="1" colspan="1">Asistencia</th>
											<th rowspan="1" colspan="1">Calificación</th>
											<th rowspan="1" colspan="1">Acciones</th>
										</tr>
									</tfoot>
								</table>

								<div class="pull-right">
									<?php if ($boton_add): ?>
										<a href="<?php echo site_url('inscripcion_materia/add_inscripcion_cursado'); ?>" class="btn btn-success">Nueva</a>
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
