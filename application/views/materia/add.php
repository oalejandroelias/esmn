<?php echo form_open('materia/add',array("class"=>"form-horizontal")); ?>
<!-- esta vista permite agregar id de carrera,nombre,codigo de año,regimen de cursado,regimen de aprobación,carga horaria y tipo de catedra no repetido del nivel-->

	<div class="form-group">
		<label for="nombre" class="col-md-4 control-label"><span class="text-danger">*</span>Carrera</label>
		<div class="col-md-8">
			<select name="carrera_id" class="form-control">
				<option value="">Seleccione una carrera</option>
				<?php
				foreach($all_carreras as $carrera)
				{
					$selected = ($carrera['carrera_id'] == $this->input->post('carrera_id')) ? ' selected="selected"' : "";

					echo '<option value="'.$carrera['carrera_id'].'" '.$selected.'>'.$carrera['carrera_nombre'].'</option>';
				}
				?>
			</select>
			<span class="text-danger"><?php echo form_error('id_carrera');?></span>
		</div>
	</div>

	<div class="form-group">
		<label for="nombre" class="col-md-4 control-label"><span class="text-danger">*</span>Nombre</label>
		<div class="col-md-8">
			<input type="text" name="nombre" value="<?php echo $this->input->post('nombre'); ?>" class="form-control" id="nombre" />
			<span class="text-danger"><?php echo form_error('nombre');?></span>
		</div>
	</div>

	<div class="form-group">
		<label for="codigo_anio" class="col-md-4 control-label">Codigo Año</label>
		<div class="col-md-8">
			<input type="text" name="codigo_anio" value="<?php echo $this->input->post('codigo_anio'); ?>" class="form-control" id="codigo_anio" />
			<span class="text-danger"><?php echo form_error('codigo_anio');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="regimen_cursado" class="col-md-4 control-label">Regimen Cursado</label>
		<div class="col-md-8">
			<!-- <input type="text" name="regimen_cursado" value="<?php echo $this->input->post('regimen_cursado'); ?>" class="form-control" id="regimen_cursado" /> -->
			<select name="id_carrera" class="form-control">
			<option value="">Seleccione la forma de Cursado</option>
			<option value="Regular">Regular</option>
			<option value="Libre">Libre</option>
			<option value="Distancia">Distancia</option>
			</select>

			<span class="text-danger"><?php echo form_error('regimen_cursado');?></span>
		</div>
	</div>

	<div class="form-group">
		<label for="regimen_aprobacion" class="col-md-4 control-label">Regimen Aprobacion</label>
		<div class="col-md-8">
			<!-- <input type="text" name="regimen_aprobacion" value="<?php echo $this->input->post('regimen_aprobacion'); ?>" class="form-control" id="regimen_aprobacion" /> -->
				<select name="id_carrera" class="form-control">
				<option value="">Seleccione la forma de Aprobacion</option>
				<option value="Final">Final</option>
				<option value="Promoción">Promoción</option>

			</select>
			<span class="text-danger"><?php echo form_error('regimen_aprobacion');?></span>
		</div>
	</div>


	<div class="form-group">
		<label for="carga_horaria" class="col-md-4 control-label">Carga Horaria semanal</label>
		<div class="col-md-8">
			<input type="text" name="carga_horaria" value="<?php echo $this->input->post('carga_horaria'); ?>" class="form-control" id="carga_horaria" />
			<span class="text-danger"><?php echo form_error('carga_horaria');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="tipo_catedra" class="col-md-4 control-label">Tipo Catedra</label>
		<div class="col-md-8">
			<!-- <input type="text" name="tipo_catedra" value="<?php echo $this->input->post('tipo_catedra'); ?>" class="form-control" id="tipo_catedra" /> -->
			<select name="id_carrera" class="form-control">
			<option value="">Seleccione el tipo de Catedra</option>
			<option value="Grupal">Grupal</option>
			<option value="Individual">Individual</option>
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

<?php echo form_close(); ?>
