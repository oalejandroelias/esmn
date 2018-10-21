<?php echo form_open('carrera/edit/'.$carrera['id'],array("class"=>"form-horizontal")); ?>
<!-- esta vista permite editar el codigo de plan, nivel, nombre acta y fecha -->
<div class="form-group">
	<label for="id" class="col-md-4 control-label"><span class="text-danger">*</span>Codigo de Plan</label>
	<div class="col-md-8">
		<input type="text" name="id" value="<?php echo ($this->input->post('id') ? $this->input->post('id') : $carrera['id']); ?>" class="form-control" id="id" />
		<!-- <span class="text-danger"><?php echo form_error('id');?></span> -->
		<span class="text-danger"><?php echo "Cuidado: No se admiten codigos repetidos.";?></span>
	</div>
</div>
	<div class="form-group">
		<label for="id_nivel" class="col-md-4 control-label"><span class="text-danger">*</span>Nivel</label>
		<div class="col-md-8">
			<select name="id_nivel" class="form-control">
				<option value="">Seleccione un nivel</option>
				<?php
				foreach($all_niveles as $nivel)
				{
					$selected = ($nivel['id'] == $carrera['id_nivel']) ? ' selected="selected"' : "";

					echo '<option value="'.$nivel['id'].'" '.$selected.'>'.$nivel['nombre'].'</option>';
				}
				?>
			</select>
			<span class="text-danger"><?php echo form_error('id_nivel');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="nombre" class="col-md-4 control-label"><span class="text-danger">*</span>Nombre</label>
		<div class="col-md-8">
			<input type="text" name="nombre" value="<?php echo ($this->input->post('nombre') ? $this->input->post('nombre') : $carrera['nombre']); ?>" class="form-control" id="nombre" />
			<span class="text-danger"><?php echo form_error('nombre');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="acta" class="col-md-4 control-label">Acta</label>
		<div class="col-md-8">
			<input type="text" name="acta" value="<?php echo ($this->input->post('acta') ? $this->input->post('acta') : $carrera['acta']); ?>" class="form-control" id="acta" />
			<span class="text-danger"><?php echo form_error('acta');?></span>
		</div>
	</div>
	<!-- <div class="form-group">
		<label for="fecha" class="col-md-4 control-label">Fecha</label>
		<div class="col-md-8">
			<input type="text" name="fecha" value="<?php echo ($this->input->post('fecha') ? $this->input->post('fecha') : $carrera['fecha']); ?>" class="form-control" id="fecha" />
		</div>
	</div> -->
	<div class="form-group">
		<label for="fecha" class="col-md-4 control-label">Fecha</label>
		<div class="input-group col-md-8">
			<input type="text" class="form-control mydatepicker" placeholder="yyyy-mm-dd" name="fecha" value="<?php echo ($this->input->post('fecha') ? $this->input->post('fecha') : $carrera['fecha']); ?>" id="fecha">
			<div class="input-group-append">
				<span class="input-group-text"><i class="fa fa-calendar"></i></span>
			</div>
		</div>
	</div>

	<!-- botones para guardar o cancelar el editar carrera -->
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Guardar</button>
			<button type="button" class="btn btn-danger" onclick="history.go(-1)">Cancelar</button>
        </div>
	</div>

<?php echo form_close(); ?>