<?php echo form_open('inscripcion_materium/edit/'.$inscripcion_materium['id'],array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="id_persona" class="col-md-4 control-label">Id Persona</label>
		<div class="col-md-8">
			<input type="text" name="id_persona" value="<?php echo ($this->input->post('id_persona') ? $this->input->post('id_persona') : $inscripcion_materium['id_persona']); ?>" class="form-control" id="id_persona" />
		</div>
	</div>
	<div class="form-group">
		<label for="id_curso" class="col-md-4 control-label">Id Curso</label>
		<div class="col-md-8">
			<input type="text" name="id_curso" value="<?php echo ($this->input->post('id_curso') ? $this->input->post('id_curso') : $inscripcion_materium['id_curso']); ?>" class="form-control" id="id_curso" />
		</div>
	</div>
	<div class="form-group">
		<label for="id_materia" class="col-md-4 control-label">Id Materia</label>
		<div class="col-md-8">
			<input type="text" name="id_materia" value="<?php echo ($this->input->post('id_materia') ? $this->input->post('id_materia') : $inscripcion_materium['id_materia']); ?>" class="form-control" id="id_materia" />
		</div>
	</div>
	<div class="form-group">
		<label for="id_mesa" class="col-md-4 control-label">Id Mesa</label>
		<div class="col-md-8">
			<input type="text" name="id_mesa" value="<?php echo ($this->input->post('id_mesa') ? $this->input->post('id_mesa') : $inscripcion_materium['id_mesa']); ?>" class="form-control" id="id_mesa" />
		</div>
	</div>
	<div class="form-group">
		<label for="id_estado" class="col-md-4 control-label">Id Estado</label>
		<div class="col-md-8">
			<input type="text" name="id_estado" value="<?php echo ($this->input->post('id_estado') ? $this->input->post('id_estado') : $inscripcion_materium['id_estado']); ?>" class="form-control" id="id_estado" />
		</div>
	</div>
	<div class="form-group">
		<label for="calificacion" class="col-md-4 control-label">Calificacion</label>
		<div class="col-md-8">
			<input type="text" name="calificacion" value="<?php echo ($this->input->post('calificacion') ? $this->input->post('calificacion') : $inscripcion_materium['calificacion']); ?>" class="form-control" id="calificacion" />
		</div>
	</div>
	<div class="form-group">
		<label for="fecha" class="col-md-4 control-label">Fecha</label>
		<div class="col-md-8">
			<input type="text" name="fecha" value="<?php echo ($this->input->post('fecha') ? $this->input->post('fecha') : $inscripcion_materium['fecha']); ?>" class="form-control" id="fecha" />
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>
	
<?php echo form_close(); ?>