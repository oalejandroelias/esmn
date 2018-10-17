<?php echo form_open('usuario/add/'.$persona['id'],array("class"=>"form-horizontal")); ?>

<div class="form-group">
	<label for="username" class="col-md-4 control-label"><span class="text-danger">*</span>Username</label>
	<div class="col-md-8">
		<input type="text" name="username" value="<?php echo $this->input->post('username'); ?>" class="form-control" id="username" />
		<span class="text-danger"><?php echo form_error('username');?></span>
	</div>
</div>
<div class="form-group">
	<label for="password" class="col-md-4 control-label"><span class="text-danger">*</span>Password</label>
	<div class="col-md-8">
		<input type="password" name="password" value="" class="form-control" id="password" />
		<span class="text-danger"><?php echo form_error('password');?></span>
	</div>
</div>

<div class="form-group">
	<label for="id_ciudad" class="col-md-4 control-label"><span class="text-danger">*</span>Copiar permisos de</label>
	<div class="col-md-8">
		<select name="id_perfil" class="form-control">
			<option value="">Seleccionar Rol</option>
			<?php
			foreach($all_roles as $rol)
			{
				$selected = ($rol['id'] == $this->input->post('id_perfil')) ? ' selected="selected"' : "";

				echo '<option value="'.$rol['id'].'" '.$selected.'>'.$rol['nombre'].'</option>';
			}
			?>
		</select>
		<span class="text-danger"><?php echo form_error('id_perfil');?></span>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-4 col-sm-8">
		<button type="submit" class="btn btn-success">Guardar</button>
		<button type="button" class="btn btn-danger" onclick="history.go(-1)">Cancelar</button>
	</div>
</div>

<?php echo form_close(); ?>
