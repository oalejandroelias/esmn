<?php echo form_open('usuario/edit/'.$usuario['usuario_id'],array("class"=>"form-horizontal")); ?>

<div class="form-group">
	<label for="username" class="col-md-4 control-label">Username</label>
	<div class="col-md-8">
		<input type="text" name="username" value="<?php echo ($this->input->post('username') ? $this->input->post('username') : $usuario['username']); ?>" class="form-control" id="username" />
		<span class="text-danger"><?php echo form_error('username');?></span>
	</div>
</div>
<div class="form-group">
	<label for="password" class="col-md-4 control-label">Password</label>
	<div class="col-md-8">
		<input type="text" name="password" value="" class="form-control" id="password" />
		<span class="text-danger"><?php echo form_error('password');?></span>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-4 col-sm-8">
		<button type="submit" class="btn btn-success">Guardar</button>
		<button type="button" class="btn btn-danger" onclick="history.go(-1)">Cancelar</button>
	</div>
</div>

<?php echo form_close(); ?>
