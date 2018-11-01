<?php echo form_open('curso/edit/'.$curso['id']); ?>

	<div>
		Id Materia : 
		<input type="text" name="id_materia" value="<?php echo ($this->input->post('id_materia') ? $this->input->post('id_materia') : $curso['id_materia']); ?>" />
	</div>
	<div>
		Periodo : 
		<input type="text" name="periodo" value="<?php echo ($this->input->post('periodo') ? $this->input->post('periodo') : $curso['periodo']); ?>" />
	</div>
	<div>
		Diascursado : 
		<textarea name="diascursado"><?php echo ($this->input->post('diascursado') ? $this->input->post('diascursado') : $curso['diascursado']); ?></textarea>
	</div>
	
	<button type="submit">Save</button>
	
<?php echo form_close(); ?>