<?php echo form_open('persona_tutor/add',array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="id_tutor" class="col-md-4 control-label">Tutor</label>
		<div class="col-md-8">
			<select name="id_tutor" class="form-control">
				<option value="">select tutor</option>
				<?php 
				foreach($all_tutores as $tutor)
				{
					$selected = ($tutor['id'] == $this->input->post('id_tutor')) ? ' selected="selected"' : "";

					echo '<option value="'.$tutor['id'].'" '.$selected.'>'.$tutor['nombre'].'</option>';
				} 
				?>
			</select>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>

<?php echo form_close(); ?>