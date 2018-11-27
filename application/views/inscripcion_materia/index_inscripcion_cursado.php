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
											<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Fecha inscripción</th>
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
												<td><?php echo $i['nombre_materia'].' ('.$i['id_carrera'].') - '.$i['tipo_catedra']; ?></td>
												<td><?php echo iconv('ISO-8859-2', 'UTF-8', strftime("%d de %B de %Y", strtotime($i['fecha']))); ?></td>
												<td id="tdEstado<?= $i['id_inscripcion_materia']; ?>" data-estadoinicial="<?= $i['nombre_estado_inicial']; ?>"><?php echo ($i['nombre_estado_final']) ? $i['nombre_estado_inicial'].' > '.$i['nombre_estado_final'] : $i['nombre_estado_inicial']; ?></td>
												<td><?php echo $i['nombre_persona'].' '.$i['apellido_persona'].' - '.$i['numero_documento']; ?></td>
												<td><?php echo ($i['porcentaje']) ? $i['porcentaje'].'%, '.$i['faltas'].' faltas' : ' - '; ?></td>
												<td id="tdCalificacion<?= $i['id_inscripcion_materia']; ?>"><?php echo $i['calificacion']; ?></td>
												<td>

													<?php if($boton_edit){?>
														<!-- <a href="<?php echo site_url('inscripcion_materia/edit_inscripcion_cursado/'.$i['id_inscripcion_materia']); ?>" class="btn btn-info btn-sm">Editar</a> -->
													<?php }?>
													<?php if($boton_remove){?>
														<!-- <a href="<?php echo site_url('inscripcion_materia/remove_inscripcion_cursado/'.$i['id_inscripcion_materia']); ?>" data-confirm="remove" class="btn btn-danger btn-sm">Eliminar</a> -->
													<?php }?>
													<?php if (!$i['porcentaje']): ?>
														<button type="button" class="btn btn-outline-secondary btn-sm" onclick="noCalifica(<?= $i['id_curso'] ?>);">Cambiar Calificación</button>
													<?php else: ?>
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
																type="button" class="btn btn-success btn-sm" title="Guardar"><i class="mdi mdi-content-save"></i></button>
																<button id="cancelarCalificacion<?= $i['id_inscripcion_materia']; ?>"
																	data-id="<?= $i['id_inscripcion_materia']; ?>"
																	data-calificacion="<?= $i['calificacion']; ?>"
																	data-action='cancelar'
																	onclick="toggleCalificacion(this);"
																	type="button" class="btn btn-secondary btn-sm" title="Cancelar"><i class="mdi mdi-close"></i></button>
														</div>
														<?php endif; ?>
													</td>
												</tr>
												<?php } ?>
											</tbody>

											<tfoot>
												<tr>
													<th rowspan="1" colspan="1">Curso</th>
													<th rowspan="1" colspan="1">Fecha inscripción</th>
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
												<a href="<?php echo site_url('inscripcion_materia/inscripcion_equivalencia'); ?>" class="btn btn-primary">Inscripcion por Equivalencia</a>
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
