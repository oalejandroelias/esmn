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

										</tr>
									</thead>

									<tbody>
										<?php foreach($inscripcion_materia as $i){ ?>
											<tr>
												<td><?php echo $i['nombre_materia'].' ('.$i['id_carrera'].') - '.$i['tipo_catedra']; ?></td>
												<td><?php echo iconv('ISO-8859-2', 'UTF-8', strftime("%d de %B de %Y", strtotime($i['fecha']))); ?></td>
												<td id="tdEstado<?= $i['id_inscripcion_materia']; ?>" data-estadoinicial="<?= $i['nombre_estado_inicial']; ?>"><?php echo ($i['nombre_estado_final']) ? $i['nombre_estado_inicial'].' > '.$i['nombre_estado_final'] : $i['nombre_estado_inicial']; ?></td>

												</tr>
												<?php } ?>
											</tbody>

											<tfoot>
												<tr>
													<th rowspan="1" colspan="1">Curso</th>
													<th rowspan="1" colspan="1">Fecha inscripción</th>
													<th rowspan="1" colspan="1">Estado</th>
						
												</tr>
											</tfoot>
										</table>

										<div class="pull-right">
											<?php if ($boton_add): ?>
												<a href="<?php echo site_url('inscripcion_materia/add_inscripcion_cursado_alumno'); ?>" class="btn btn-success">Nueva</a>
												
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
