<!-- esta vista permite agregar codigo de plan, nivel, nombre acta y fecha -->
<?php echo form_open('curso/edit/'.$curso['curso_id'],array("class"=>"form-horizontal")); ?>

<div class="row">
	<div class="col-sm-8 col-12">
		<div class="card">
			<div class="card-body">

				<div class="form-row mb-4">
					<div class="col-sm-6 col-12">
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

					<div class="col-sm-6 col-12">
						<label for="id_materia" class="control-label"><span class="text-danger">*</span>Periodo	</label>
						<select name="id_periodo" required class="form-control">
							<option value="">Seleccione un periodo</option>
							<?php
							foreach($all_periodos as $periodo)
							{
							    $selected = ($periodo['id'] == $curso['id_periodo']) ? ' selected="selected"' : "";

							    echo '<option value="'.$periodo['id'].'" '.$selected.'>'.$periodo['descripcion'].' ('.$periodo['desde'].' - '.$periodo['hasta'].')</option>';
							}
							?>
						</select>
						<span class="text-danger"><?php echo form_error('id_periodo');?></span>
					</div>

				</div>

				<div class="form-row mb-4">
					<input type="hidden" name="diascursado" value="<?= $curso['diascursado']; ?>">
						<div class="col-sm-6 col-12">
							<label class="control-label">Dias de cursado</label>
							<div class="custom-control custom-checkbox mr-sm-2">
								<input class="custom-control-input" name="dayWeek[]"
									id="Mon" type="checkbox" value="Mon">
								<label class="custom-control-label" for="Mon">Lunes</label>
							</div>
							<div class="custom-control custom-checkbox mr-sm-2">
								<input class="custom-control-input" name="dayWeek[]"
									id="Tue" type="checkbox" value="Tue">
								<label class="custom-control-label" for="Tue">Martes</label>
							</div>
							<div class="custom-control custom-checkbox mr-sm-2">
								<input class="custom-control-input" name="dayWeek[]"
									id="Wed" type="checkbox" value="Wed">
								<label class="custom-control-label" for="Wed">Miercoles</label>
							</div>
							<div class="custom-control custom-checkbox mr-sm-2">
								<input class="custom-control-input" name="dayWeek[]"
									id="Thu" type="checkbox" value="Thu">
								<label class="custom-control-label" for="Thu">Jueves</label>
							</div>
							<div class="custom-control custom-checkbox mr-sm-2">
								<input class="custom-control-input" name="dayWeek[]"
									id="Fry" type="checkbox" value="Fry">
								<label class="custom-control-label" for="Fry">Viernes</label>
							</div>
							<div class="custom-control custom-checkbox mr-sm-2">
								<input class="custom-control-input" name="dayWeek[]"
									id="Sat" type="checkbox" value="Sat">
								<label class="custom-control-label" for="Sat">Sabado</label>
							</div>
							<span class="text-danger"><?php echo form_error('dayWeek[]');?></span>
            </div>
				</div>

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
