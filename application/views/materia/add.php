<?php echo form_open('materia/add',array("class"=>"form-horizontal")); ?>
<!-- esta vista permite agregar id de carrera,nombre,codigo de año,regimen de cursado,regimen de aprobación,carga horaria y tipo de catedra no repetido del nivel-->

<div class="row">
	<div class="col-md-8 col-12">
		<div class="card">
			<div class="card-body">

				<div class="form-row mb-3">
					<div class="col-sm-6 col-12">
					<label for="nombre" class="control-label"><span class="text-danger">*</span>Codigo de Plan</label>
						<select name="id_carrera" required class="form-control">
							<option value="">Seleccione una carrera</option>
							<?php
							foreach($all_carreras as $carrera)
							{
								$selected = ($carrera['carrera_id'] == $this->input->post('id_carrera')) ? ' selected="selected"' : "";

								echo '<option value="'.$carrera['carrera_id'].'" '.$selected.'>'.$carrera['carrera_nombre'].' ('.$carrera['carrera_id'].')</option>';
							}
							?>
						</select>
						<span class="text-danger"><?php echo form_error('id_carrera');?></span>
					</div>

					<div class="col-sm-6 col-12">
					<label for="nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
						<input type="text" name="nombre" required value="<?php echo $this->input->post('nombre'); ?>" class="form-control" id="nombre" />
						<span class="text-danger"><?php echo form_error('nombre');?></span>
					</div>
				</div>

				<div class="form-row mb-3">
					<div class="col-sm-6 col-12">
					<label for="codigo_anio" class="control-label">Codigo Año</label>
						<input type="text" name="codigo_anio" value="<?php echo $this->input->post('codigo_anio'); ?>" class="form-control" id="codigo_anio" />
						<span class="text-danger"><?php echo form_error('codigo_anio');?></span>
					</div>

					<div class="col-sm-6 col-12">
						<label for="carga_horaria" class="control-label">Carga Horaria semanal</label>
							<input type="text" name="carga_horaria" value="<?php echo $this->input->post('carga_horaria'); ?>" class="form-control" id="carga_horaria" />
							<span class="text-danger"><?php echo form_error('carga_horaria');?></span>
						</div>
				</div>

				<div class="form-row mb-3">
					<div class="col-sm-6 col-12">
					<label for="regimen_cursado" class="control-label">Regimen Cursado</label>
					<?php $selected = ($this->input->post('regimen_cursado') ? $this->input->post('regimen_cursado') : ''); ?>
						<select name="regimen_cursado" class="form-control">
							<option value="">Seleccione la forma de Cursado</option>
							<option value="Regular"<?= ($selected=='Regular' ? ' selected="selected"' : '') ?>>Regular</option>
							<option value="Libre"<?= ($selected=='Libre' ? ' selected="selected"' : '') ?>>Libre</option>
							<option value="Distancia"<?= ($selected=='Distancia' ? ' selected="selected"' : '') ?>>Distancia</option>
						</select>
						<span class="text-danger"><?php echo form_error('regimen_cursado');?></span>
					</div>

					<div class="col-sm-6 col-12">
					<label for="regimen_aprobacion" class="control-label">Regimen Aprobacion</label>
					<?php $selected = ($this->input->post('regimen_aprobacion') ? $this->input->post('regimen_aprobacion') : ''); ?>
						<select name="regimen_aprobacion" class="form-control">
							<option value="">Seleccione la forma de Aprobacion</option>
							<option value="Final"<?= ($selected=='Final' ? ' selected="selected"' : '') ?>>Final</option>
							<option value="Promoción"<?= ($selected=='Promoción' ? ' selected="selected"' : '') ?>>Promoción</option>
						</select>
						<span class="text-danger"><?php echo form_error('regimen_aprobacion');?></span>
					</div>
				</div>


				<div class="form-row mb-3">
					<div class="col-sm-4 col-12">
					<label for="tipo_catedra" class="control-label">Tipo Catedra</label>
					<?php $selected = ($this->input->post('tipo_catedra') ? $this->input->post('tipo_catedra') : ''); ?>
						<select name="tipo_catedra" class="form-control" required>
							<option value="">Seleccione el tipo de Catedra</option>
							<option value="Grupal"<?= ($selected=='Grupal' ? ' selected="selected"' : '') ?>>Grupal</option>
							<option value="Individual"<?= ($selected=='Individual' ? ' selected="selected"' : '') ?>>Individual</option>
						</select>
						<span class="text-danger"><?php echo form_error('tipo_catedra');?></span>
					</div>
				</div>

				<div class="form-group">
					<!-- botones para guardar o cancelar el agregar materias -->
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-success">Guardar</button>
						<a href="<?=site_url('materia/index'); ?>" class="btn btn-danger">Cancelar</a>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<?php echo form_close(); ?>
