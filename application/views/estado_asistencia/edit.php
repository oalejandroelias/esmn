<?php echo form_open('estado_asistencia/edit/'.$estado_asistencia['id'],array("class"=>"form-horizontal")); ?>

<div class="form-group">
	<label for="nombre" class="col-md-4 control-label"><span class="text-danger">*</span>Nombre</label>
	<div class="col-md-8">
		<input type="text" name="nombre" value="<?php echo ($this->input->post('nombre') ? $this->input->post('nombre') : $estado_asistencia['nombre']); ?>" class="form-control" id="nombre" />
		<span class="text-danger"><?php echo form_error('nombre');?></span>
	</div>
</div>
<div class="form-group">
	<label for="nomenclatura" class="col-md-4 control-label">Nomenclatura</label>
	<div class="col-md-8">
		<input type="text" name="nomenclatura" value="<?php echo ($this->input->post('nomenclatura') ? $this->input->post('nomenclatura') : $estado_asistencia['nomenclatura']); ?>" class="form-control" id="nomenclatura" />
		<span class="text-danger"><?php echo form_error('nomenclatura');?></span>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-4 col-sm-8">
		<button type="submit" class="btn btn-success">Guardar</button>
		<button type="submit" formaction="index" class="btn btn-danger">Cancelar</button>
	</div>
</div>

<?php echo form_close(); ?>