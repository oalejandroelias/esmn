<?php echo form_open('curso/add'); ?>

	<div>
		Id Materia : 
		<input type="text" name="id_materia" value="<?php echo $this->input->post('id_materia'); ?>" />
	</div>
	<div>
		Periodo : 
		<input type="text" name="periodo" value="<?php echo $this->input->post('periodo'); ?>" />
	</div>
	<div>
		Diascursado : 
		<textarea name="diascursado"><?php echo $this->input->post('diascursado'); ?></textarea>
	</div>
	
	<button type="submit">Save</button>

<?php echo form_close(); ?>