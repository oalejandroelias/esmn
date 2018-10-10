<?php echo form_open('persona/edit/'.$persona['id'],array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="id_tipo_documento" class="col-md-4 control-label"><span class="text-danger">*</span>Tipo Documento</label>
		<div class="col-md-8">
			<select name="id_tipo_documento" class="form-control">
				<option value="">select tipo_documento</option>
				<?php
				foreach($all_tipo_documento as $tipo_documento)
				{
					$selected = ($tipo_documento['id'] == $persona['id_tipo_documento']) ? ' selected="selected"' : "";

					echo '<option value="'.$tipo_documento['id'].'" '.$selected.'>'.$tipo_documento['nombre'].'</option>';
				}
				?>
			</select>
			<span class="text-danger"><?php echo form_error('id_tipo_documento');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="numero_documento" class="col-md-4 control-label"><span class="text-danger">*</span>Numero Documento</label>
		<div class="col-md-8">
			<input type="text" name="numero_documento" value="<?php echo ($this->input->post('numero_documento') ? $this->input->post('numero_documento') : $persona['numero_documento']); ?>" class="form-control" id="numero_documento" />
			<span class="text-danger"><?php echo form_error('numero_documento');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="id_ciudad" class="col-md-4 control-label">Ciudad</label>
		<div class="col-md-8">
			<select name="id_ciudad" class="form-control">
				<option value="">Seleccionar Ciudad</option>
				<?php
				foreach($all_ciudades as $ciudad)
				{
					$selected = ($ciudad['ciudad_id'] == $persona['id_ciudad']) ? ' selected="selected"' : "";

					echo '<option value="'.$ciudad['ciudad_id'].'" '.$selected.'>'.$ciudad['ciudad'].'</option>';
				}
				?>
			</select>
			<span class="text-danger"><?php echo form_error('id_ciudad');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="nombre" class="col-md-4 control-label"><span class="text-danger">*</span>Nombre</label>
		<div class="col-md-8">
			<input type="text" name="nombre" value="<?php echo ($this->input->post('nombre') ? $this->input->post('nombre') : $persona['nombre']); ?>" class="form-control" id="nombre" />
			<span class="text-danger"><?php echo form_error('nombre');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="apellido" class="col-md-4 control-label"><span class="text-danger">*</span>Apellido</label>
		<div class="col-md-8">
			<input type="text" name="apellido" value="<?php echo ($this->input->post('apellido') ? $this->input->post('apellido') : $persona['apellido']); ?>" class="form-control" id="apellido" />
			<span class="text-danger"><?php echo form_error('apellido');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="domicilio" class="col-md-4 control-label">Domicilio</label>
		<div class="col-md-8">
			<input type="text" name="domicilio" value="<?php echo ($this->input->post('domicilio') ? $this->input->post('domicilio') : $persona['domicilio']); ?>" class="form-control" id="domicilio" />
			<span class="text-danger"><?php echo form_error('domicilio');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="telefono" class="col-md-4 control-label">Telefono</label>
		<div class="col-md-8">
			<input type="text" name="telefono" value="<?php echo ($this->input->post('telefono') ? $this->input->post('telefono') : $persona['telefono']); ?>" class="form-control" id="telefono" />
			<span class="text-danger"><?php echo form_error('telefono');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="email" class="col-md-4 control-label">Email</label>
		<div class="col-md-8">
			<input type="text" name="email" value="<?php echo ($this->input->post('email') ? $this->input->post('email') : $persona['email']); ?>" class="form-control" id="email" />
			<span class="text-danger"><?php echo form_error('email');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="fecha_nacimiento" class="col-md-4 control-label">Fecha Nacimiento</label>
		<div class="col-md-8">
			<input type="text" name="fecha_nacimiento" value="<?php echo ($this->input->post('fecha_nacimiento') ? $this->input->post('fecha_nacimiento') : $persona['fecha_nacimiento']); ?>" class="form-control" id="fecha_nacimiento" />
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>

<?php echo form_close(); ?>
