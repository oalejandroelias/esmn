<!-- esta vista permite agregar codigo de plan, nivel, nombre acta y fecha -->
<?php echo form_open('curso/edit/'.$curso['curso_id'],array("class"=>"form-horizontal")); ?>
<input type="hidden" name="edit" value="1">
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">

				<div class="form-row mb-4">
					<div class="col-sm-4 col-12">
						<label for="id_materia" class="control-label"><span class="text-danger">*</span>Materia</label>
						<select name="id_materia" required class="form-control select2 custom-select" style="width: 100%; height:32px;">
							<option value="">Buscar</option>
							<?php
							foreach($all_materias as $materia)
							{
								$selected = ($materia['materia_id'] == $curso['id_materia']) ? ' selected="selected"' : "";

								echo '<option value="'.$materia['materia_id'].'" '.$selected.'>'.$materia['nombre_materia'].' - '.$materia['id_carrera'].'</option>';
							}
							?>
						</select>
						<span class="text-danger"><?php echo form_error('id_materia');?></span>
					</div>

					<div class="col-sm-4 col-12">
						<label for="id_materia" class="control-label"><span class="text-danger">*</span>Periodo	</label>
						<select name="id_periodo" required class="form-control">
							<option value="">Seleccione un periodo</option>
							<?php
							foreach($all_periodos as $periodo)
							{
							    $selected = ($periodo['id'] == $curso['id_periodo']) ? ' selected="selected"' : "";

									echo '<option value="'.$periodo['id'].'" '.$selected.' data-inicio="'.$periodo['desde'].'" data-fin="'.$periodo['hasta'].'">'.
							    $periodo['descripcion'].' ('.$periodo['desde'].' - '.$periodo['hasta'].')</option>';
							}
							?>
						</select>
						<span class="text-danger"><?php echo form_error('id_periodo');?></span>
					</div>

				</div>

				<div class="form-row mb-4">
					<input type="hidden" name="diascursado" value='<?= $curso["diascursado"]; ?>'>
						<div class="col-sm-4 col-12">
							<label class="control-label">Dias de cursado</label>
							<div class="custom-control custom-checkbox mr-sm-2">
								<input class="custom-control-input" name="dayWeek[]" <?= (in_array('Mon',json_decode($curso['diassemana'])) ? 'checked' : '' ); ?>
									id="Mon" type="checkbox" value="Mon">
								<label class="custom-control-label" for="Mon">Lunes</label>
							</div>
							<div class="custom-control custom-checkbox mr-sm-2">
								<input class="custom-control-input" name="dayWeek[]" <?= (in_array('Tue',json_decode($curso['diassemana'])) ? 'checked' : '' ); ?>
									id="Tue" type="checkbox" value="Tue">
								<label class="custom-control-label" for="Tue">Martes</label>
							</div>
							<div class="custom-control custom-checkbox mr-sm-2">
								<input class="custom-control-input" name="dayWeek[]" <?= (in_array('Wed',json_decode($curso['diassemana'])) ? 'checked' : '' ); ?>
									id="Wed" type="checkbox" value="Wed">
								<label class="custom-control-label" for="Wed">Miercoles</label>
							</div>
							<div class="custom-control custom-checkbox mr-sm-2">
								<input class="custom-control-input" name="dayWeek[]" <?= (in_array('Thu',json_decode($curso['diassemana'])) ? 'checked' : '' ); ?>
									id="Thu" type="checkbox" value="Thu">
								<label class="custom-control-label" for="Thu">Jueves</label>
							</div>
							<div class="custom-control custom-checkbox mr-sm-2">
								<input class="custom-control-input" name="dayWeek[]" <?= (in_array('Fri',json_decode($curso['diassemana'])) ? 'checked' : '' ); ?>
									id="Fri" type="checkbox" value="Fri">
								<label class="custom-control-label" for="Fri">Viernes</label>
							</div>
							<div class="custom-control custom-checkbox mr-sm-2">
								<input class="custom-control-input" name="dayWeek[]" <?= (in_array('Sat',json_decode($curso['diassemana'])) ? 'checked' : '' ); ?>
									id="Sat" type="checkbox" value="Sat">
								<label class="custom-control-label" for="Sat">Sabado</label>
							</div>
							<span class="text-danger"><?php echo form_error('dayWeek[]');?></span>
            </div>
				</div>

				<div class="col-sm-4 col-12 d-none" id="table-reference">
					<h5>Seleccione los dias Feriados:</h5>
					<p>Referencias: <span class="badge badge-danger">F: feriado</span></p>
				</div>

				<table id="tablaDiasCursado" class="table-responsive tabla-dias-cursado mb-4">
					<thead>
						<tr></tr>
					</thead>
					<tbody>
						<tr></tr>
					</tbody>
				</table>


				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-success">Guardar</button>
						<a href="<?=site_url('curso/index'); ?>" class="btn btn-danger">Cancelar</a>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<?php echo form_close(); ?>
