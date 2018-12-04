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
											<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Fecha y hora</th>
											<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Estado</th>
											<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Alumno</th>
											<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Calificación</th>
											<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Acciones</th>
										</tr>
									</thead>

									<tbody>
											<?php foreach($inscripcion_materia as $i){ ?>
											<tr>
												<td><?php echo $i['nombre_materia'].' ('.$i['id_carrera'].')'; ?></td>
												<td><?php echo iconv('ISO-8859-2', 'UTF-8', strftime("%d de %B de %Y, %H:%M:%S hs", strtotime($i['fecha_mesa'])));; ?></td>
												<td id="tdEstado<?= $i['id_inscripcion_materia']; ?>" data-estadoinicial="<?= $i['estado_inicial']; ?>"><?php echo ($i['estado_final']) ? $i['estado_inicial'].' > '.$i['estado_final'] : $i['estado_inicial']; ?></td>
                        <td><?php echo $i['nombre_persona'].' '.$i['apellido_persona'].' - '.$i['numero_documento']; ?></td>
												<td id="tdCalificacion<?= $i['id_inscripcion_materia']; ?>"><?php echo $i['calificacion']; ?></td>
												<td>

													<!-- <?php if($boton_edit){?>
														<a href="<?php echo site_url('inscripcion_materia/edit/'.$i['id_inscripcion_materia']); ?>" class="btn btn-info btn-sm">Editar</a>
													<?php }?>
													<?php if($boton_remove){?>
														<a href="<?php echo site_url('inscripcion_materia/remove/'.$i['id_inscripcion_materia']); ?>" data-confirm="remove" class="btn btn-danger btn-sm">Eliminar</a>
													<?php }?> -->
													<button id="cambiarCalificacion<?= $i['id_inscripcion_materia']; ?>"
														data-id="<?= $i['id_inscripcion_materia']; ?>"
														data-calificacion="<?= $i['calificacion']; ?>"
														data-action='editar'
														onclick="toggleCalificacion(this);"
														type="button" class="btn btn-outline-info btn-sm" title="Cambiar Calificación" data-toggle="modal" data-target="#editar_calificacion_modal">
														<i class="fa fa-pencil" aria-hidden="true"></i>
														Cambiar Calificación
													</button>
													<div id="btnGroupCalificacion<?= $i['id_inscripcion_materia']; ?>" class="btn-group d-none" role="group" aria-label="Cambiar Calificación">
														<button id="guardarCalificacion<?= $i['id_inscripcion_materia']; ?>"
															data-id="<?= $i['id_inscripcion_materia']; ?>"
															data-tipo="mesa"
															type="button" class="btn btn-success btn-sm" title="Guardar"><i class="mdi mdi-content-save"></i></button>
															<button id="cancelarCalificacion<?= $i['id_inscripcion_materia']; ?>"
																data-id="<?= $i['id_inscripcion_materia']; ?>"
																data-calificacion="<?= $i['calificacion']; ?>"
																data-action='cancelar'
																onclick="toggleCalificacion(this);"
																type="button" class="btn btn-secondary btn-sm" title="Cancelar"><i class="mdi mdi-close"></i></button>
													</div>
												</td>
											</tr>
										<?php } ?>
									</tbody>

									<tfoot>
										<tr>
											<th rowspan="1" colspan="1">Materia</th>
											<th rowspan="1" colspan="1">Fecha y hora</th>
											<th rowspan="1" colspan="1">Estado</th>
											<th rowspan="1" colspan="1">Alumno</th>
											<th rowspan="1" colspan="1">Calificación</th>
											<th rowspan="1" colspan="1">Acciones</th>
										</tr>
									</tfoot>
								</table>

								<div class="pull-right">
									<?php if ($boton_add): ?>
										<a href="<?php echo site_url('inscripcion_materia/add'); ?>" class="btn btn-success">Nueva</a>
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
