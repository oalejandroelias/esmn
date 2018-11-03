<?php echo form_open('tipo_periodo/add'); ?>

	<div>
		Descripcion : 
		<input type="text" name="descripcion" value="<?php echo $this->input->post('descripcion'); ?>" />
	</div>
	
	<button type="submit">Save</button>

<?php echo form_close(); ?>