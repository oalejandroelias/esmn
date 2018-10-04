<?php echo form_open('usuario/edit/'.$usuario['id'],array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="id_persona" class="col-md-4 control-label"><span class="text-danger">*</span>Persona</label>
		<div class="col-md-8">
			<select name="id_persona" class="form-control">
				<option value="">select persona</option>
				<?php 
				foreach($all_personas as $persona)
				{
					$selected = ($persona['id'] == $usuario['id_persona']) ? ' selected="selected"' : "";

					echo '<option value="'.$persona['id'].'" '.$selected.'>'.$persona['numero_documento'].'</option>';
				} 
				?>
			</select>
			<span class="text-danger"><?php echo form_error('id_persona');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="password" class="col-md-4 control-label">Password</label>
		<div class="col-md-8">
			<input type="text" name="password" value="<?php echo ($this->input->post('password') ? $this->input->post('password') : $usuario['password']); ?>" class="form-control" id="password" />
			<span class="text-danger"><?php echo form_error('password');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="username" class="col-md-4 control-label">Username</label>
		<div class="col-md-8">
			<input type="text" name="username" value="<?php echo ($this->input->post('username') ? $this->input->post('username') : $usuario['username']); ?>" class="form-control" id="username" />
			<span class="text-danger"><?php echo form_error('username');?></span>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>
	
<?php echo form_close(); ?>