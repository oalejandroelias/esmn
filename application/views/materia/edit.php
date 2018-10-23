<?php echo form_open('materia/edit/'.$materia['id'],array("class"=>"form-horizontal")); ?>
<!-- esta vista permite editar id de carrera,nombre,codigo de año,regimen de cursado,regimen de aprobación,carga horaria y tipo de catedra no repetido del nivel-->
	<div class="form-group">
		<label for="id_carrera" class="col-md-4 control-label"><span class="text-danger">*</span>Id Carrera</label>
		<div class="col-md-8">
			<input type="text" name="id_carrera" value="<?php echo ($this->input->post('id_carrera') ? $this->input->post('id_carrera') : $materia['id_carrera']); ?>" class="form-control" id="id_carrera" />
			<span class="text-danger"><?php echo form_error('id_carrera');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="nombre" class="col-md-4 control-label"><span class="text-danger">*</span>Nombre</label>
		<div class="col-md-8">
			<input type="text" name="nombre" value="<?php echo ($this->input->post('nombre') ? $this->input->post('nombre') : $materia['nombre']); ?>" class="form-control" id="nombre" />
			<span class="text-danger"><?php echo form_error('nombre');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="codigo_anio" class="col-md-4 control-label">Codigo Anio</label>
		<div class="col-md-8">
			<input type="text" name="codigo_anio" value="<?php echo ($this->input->post('codigo_anio') ? $this->input->post('codigo_anio') : $materia['codigo_anio']); ?>" class="form-control" id="codigo_anio" />
			<span class="text-danger"><?php echo form_error('codigo_anio');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="regimen_cursado" class="col-md-4 control-label">Regimen Cursado</label>
		<div class="col-md-8">
			<input type="text" name="regimen_cursado" value="<?php echo ($this->input->post('regimen_cursado') ? $this->input->post('regimen_cursado') : $materia['regimen_cursado']); ?>" class="form-control" id="regimen_cursado" />
			<span class="text-danger"><?php echo form_error('regimen_cursado');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="regimen_aprobacion" class="col-md-4 control-label">Regimen Aprobacion</label>
		<div class="col-md-8">
			<input type="text" name="regimen_aprobacion" value="<?php echo ($this->input->post('regimen_aprobacion') ? $this->input->post('regimen_aprobacion') : $materia['regimen_aprobacion']); ?>" class="form-control" id="regimen_aprobacion" />
			<span class="text-danger"><?php echo form_error('regimen_aprobacion');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="carga_horaria" class="col-md-4 control-label">Carga Horaria</label>
		<div class="col-md-8">
			<input type="text" name="carga_horaria" value="<?php echo ($this->input->post('carga_horaria') ? $this->input->post('carga_horaria') : $materia['carga_horaria']); ?>" class="form-control" id="carga_horaria" />
			<span class="text-danger"><?php echo form_error('carga_horaria');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="tipo_catedra" class="col-md-4 control-label">Tipo Catedra</label>
		<div class="col-md-8">
			<input type="text" name="tipo_catedra" value="<?php echo ($this->input->post('tipo_catedra') ? $this->input->post('tipo_catedra') : $materia['tipo_catedra']); ?>" class="form-control" id="tipo_catedra" />
			<span class="text-danger"><?php echo form_error('tipo_catedra');?></span>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<!-- botones para guardar o cancelar el editar nivel -->
			<button type="submit" class="btn btn-success">Guardar</button>
			<a href="<?=site_url('materia/index'); ?>" class="btn btn-danger">Cancelar</a>
        </div>
	</div>

<?php echo form_close(); ?>
