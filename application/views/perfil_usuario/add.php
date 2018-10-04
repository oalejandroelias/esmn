<?php echo form_open('perfil_usuario/add',array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="permisos" class="col-md-4 control-label">Permisos</label>
		<div class="col-md-8">
			<textarea name="permisos" class="form-control" id="permisos"><?php echo $this->input->post('permisos'); ?></textarea>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>

<?php echo form_close(); ?>