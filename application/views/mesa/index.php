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
											<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Tribunal</th>
											<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Acciones</th>
										</tr>
									</thead>

									<tbody>
										<?php foreach($mesas as $m){ ?>
											<tr>
												<td><?php echo $m['materia'].' - '.$m['id_carrera']; ?></td>
												<td><?php echo iconv('ISO-8859-2', 'UTF-8', strftime("%d de %B de %Y", strtotime($m['fecha']))).', '.date('H:i',strtotime($m['fecha'])).'hs'; ?></td>
												<?php
		                    $personas=array();
		                    foreach ($tribunales as $t) {
		                      if ($t['id_mesa']==$m['id_mesa']) {
		                        $persona = $t['nombre'].' '.$t['apellido'];
		                        array_push($personas,$persona);
		                      }
		                    }
		                     ?>
		                		<td><?php echo implode(', ',$personas); ?></td>
												<td>

													<?php if($boton_edit){?>
														<a href="<?php echo site_url('mesa/edit/'.$m['id_mesa']); ?>" class="btn btn-info btn-sm">Editar</a>
													<?php }?>
													<?php if($boton_remove){?>
														<a href="<?php echo site_url('mesa/remove/'.$m['id_mesa']); ?>" data-confirm="remove" class="btn btn-danger btn-sm">Deshabilitar</a>
													<?php }?>

												</td>
											</tr>
										<?php } ?>
									</tbody>

									<tfoot>
										<tr>
											<th rowspan="1" colspan="1">Materia</th>
											<th rowspan="1" colspan="1">Fecha y hora</th>
											<th rowspan="1" colspan="1">Tribunal</th>
											<th rowspan="1" colspan="1">Acciones</th>
										</tr>
									</tfoot>
								</table>

								<div class="pull-right">
									<?php if ($boton_add): ?>
										<a href="<?php echo site_url('mesa/add'); ?>" class="btn btn-success">Nueva</a>
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
