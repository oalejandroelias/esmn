<?php echo form_open('persona/add',array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="id_tipo_documento" class="col-md-4 control-label"><span class="text-danger">*</span>Tipo Documento</label>
		<div class="col-md-8">
			<select name="id_tipo_documento" class="form-control">
				<option value="">Seleccionar tipo de documento</option>
				<?php
				foreach($all_tipo_documento as $tipo_documento)
				{
					$selected = ($tipo_documento['id'] == $this->input->post('id_tipo_documento')) ? ' selected="selected"' : "";

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
			<input type="text" name="numero_documento" value="<?php echo $this->input->post('numero_documento'); ?>" class="form-control" id="numero_documento" />
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
					$selected = ($ciudad['ciudad_id'] == $this->input->post('id_ciudad')) ? ' selected="selected"' : "";

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
			<input type="text" name="nombre" value="<?php echo $this->input->post('nombre'); ?>" class="form-control" id="nombre" />
			<span class="text-danger"><?php echo form_error('nombre');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="apellido" class="col-md-4 control-label"><span class="text-danger">*</span>Apellido</label>
		<div class="col-md-8">
			<input type="text" name="apellido" value="<?php echo $this->input->post('apellido'); ?>" class="form-control" id="apellido" />
			<span class="text-danger"><?php echo form_error('apellido');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="domicilio" class="col-md-4 control-label">Domicilio</label>
		<div class="col-md-8">
			<input type="text" name="domicilio" value="<?php echo $this->input->post('domicilio'); ?>" class="form-control" id="domicilio" />
			<span class="text-danger"><?php echo form_error('domicilio');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="telefono" class="col-md-4 control-label">Telefono</label>
		<div class="col-md-8">
			<input type="text" name="telefono" value="<?php echo $this->input->post('telefono'); ?>" class="form-control" id="telefono" />
			<span class="text-danger"><?php echo form_error('telefono');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="email" class="col-md-4 control-label">Email</label>
		<div class="col-md-8">
			<input type="text" name="email" value="<?php echo $this->input->post('email'); ?>" class="form-control" id="email" />
			<span class="text-danger"><?php echo form_error('email');?></span>
		</div>
	</div>

	<div class="form-group">
		<label for="fecha" class="col-md-4 control-label">Fecha de Nacimiento</label>
		<div class="input-group col-md-8">
	        <input type="text" class="form-control mydatepicker" placeholder="yyyy-mm-dd" name="fecha_nacimiento" value="<?php echo $this->input->post('fecha_nacimiento'); ?>" id="fecha_nacimiento">
	        <div class="input-group-append">
	            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
	        </div>
	    </div>
	</div>

	<div class="form-group">
		<!-- <div class="form-check">
	  		<label class="form-check-label">
	    		<input type="checkbox" class="form-check-input" name="generar_usuario" value="0" >Generar Usuario

	  		</label>
		</div> -->
		<label class="col-md-3"></label>
		<div class="col-md-9">
				<div class="custom-control custom-checkbox mr-sm-2">
					<input class="custom-control-input" name="generar_usuario"
						id="checkbox_generar_usuario" type="checkbox" value="0">
					<label class="custom-control-label" for="checkbox_generar_usuario">Generar Usuario</label>
				</div>
		</div>
	</div>

	<div class="form-group d-none" id="copiar_permisos_de">
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
			<span class="text-danger"><?php echo form_error('id_ciudad');?></span>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Guardar</button>
			<button type="submit" formaction="index" class="btn btn-danger">Cancelar</button>
        </div>
	</div>


<?php echo form_close(); ?>
