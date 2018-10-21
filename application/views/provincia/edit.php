<?php echo form_open('provincia/edit/'.$provincia['id'],array("class"=>"form-horizontal")); ?>

<div class="form-group">
	<label for="nombre" class="col-md-4 control-label"><span class="text-danger">*</span>Nombre</label>
	<div class="col-md-8">
		<input type="text" name="nombre" value="<?php echo ($this->input->post('nombre') ? $this->input->post('nombre') : $provincia['nombre']); ?>" class="form-control" id="nombre" />
		<span class="text-danger"><?php echo form_error('nombre');?></span>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-4 col-sm-8">
		<button type="submit" class="btn btn-success">Guardar</button>
		<button type="submit" formaction="index" class="btn btn-danger">Cancelar</button>
	</div>
</div>

<?php echo form_close(); ?>
