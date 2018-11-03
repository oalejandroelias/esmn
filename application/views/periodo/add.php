<?php echo form_open('periodo/add'); ?>

	<div>
		Id Tipo Periodo : 
		<input type="text" name="id_tipo_periodo" value="<?php echo $this->input->post('id_tipo_periodo'); ?>" />
	</div>
	<div>
		Desde : 
		<input type="text" name="desde" value="<?php echo $this->input->post('desde'); ?>" />
	</div>
	<div>
		Hasta : 
		<input type="text" name="hasta" value="<?php echo $this->input->post('hasta'); ?>" />
	</div>
	
	<button type="submit">Save</button>

<?php echo form_close(); ?>