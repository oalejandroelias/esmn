<div class="row">
	<div class="col-sm-6 col-12">
		<div class="card">
			<div class="card-body">
				<?php echo form_open('ciudad/edit/'.$ciudad['id'],array("class"=>"form-horizontal")); ?>

				<div class="form-group">
					<label for="id_ciudad" class="col-md-4 control-label">Provincia</label>
					<div class="col-md-8">
						<select name="id_provincia" class="form-control">
							<option value="">Seleccionar Provincia</option>
							<?php
							foreach($all_provincias as $provincia)
							{
								$selected = ($provincia['id'] == $ciudad['id_provincia']) ? ' selected="selected"' : "";

								echo '<option value="'.$provincia['id'].'" '.$selected.'>'.$provincia['nombre'].'</option>';
							}
							?>
						</select>
						<span class="text-danger"><?php echo form_error('id_provincia');?></span>
					</div>
				</div>

				<div class="form-group">
					<label for="nombre" class="col-md-4 control-label"><span class="text-danger">*</span>Nombre</label>
					<div class="col-md-8">
						<input type="text" name="nombre" value="<?php echo ($this->input->post('nombre') ? $this->input->post('nombre') : $ciudad['nombre']); ?>" class="form-control" id="nombre" />
						<span class="text-danger"><?php echo form_error('nombre');?></span>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-success">Guardar</button>
						<a href="<?=site_url('ciudad/index'); ?>" class="btn btn-danger">Cancelar</a>
					</div>
				</div>

				<?php echo form_close(); ?>
			</div>

		</div>
	</div>

</div>
