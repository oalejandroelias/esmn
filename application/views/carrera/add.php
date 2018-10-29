<!-- esta vista permite agregar codigo de plan, nivel, nombre acta y fecha -->
<?php echo form_open('carrera/add',array("class"=>"form-horizontal")); ?>

<div class="col-md-8 col-12">
	<div class="card">
		<div class="card-body">

			<div class="form-row mb-4">
				<div class="col-sm-6 col-12">
					<label for="id" class="control-label"><span class="text-danger">*</span>Codigo de Plan</label>
					<input type="text" name="id" required value="<?php echo $this->input->post('id'); ?>" class="form-control" id="id" />
					<span class="text-danger"><?php echo form_error('id');?></span>
				</div>

				<div class="col-sm-6 col-12">
					<label for="id_nivel" class="control-label"><span class="text-danger">*</span>Nivel</label>
					<select name="id_nivel" required class="form-control">
						<option value="">Seleccione un nivel</option>
						<?php
						foreach($all_niveles as $nivel)
						{
							$selected = ($nivel['id'] == $this->input->post('id_nivel')) ? ' selected="selected"' : "";

							echo '<option value="'.$nivel['id'].'" '.$selected.'>'.$nivel['nombre'].'</option>';
						}
						?>
					</select>
					<span class="text-danger"><?php echo form_error('id_nivel');?></span>
				</div>
			</div>

			<div class="form-row mb-4">
				<div class="col-sm-6 col-12">
					<label for="nombre" class="control-label"><span class="text-danger">*</span>Nombre de la Carrera</label>
					<input type="text" name="nombre" required value="<?php echo $this->input->post('nombre'); ?>" class="form-control" id="nombre" />
					<span class="text-danger"><?php echo form_error('nombre');?></span>
				</div>

				<div class="col-sm-6 col-12">
					<label for="acta" class="control-label">Acta</label>
					<input type="text" name="acta" value="<?php echo $this->input->post('acta'); ?>" class="form-control" id="acta" />
					<span class="text-danger"><?php echo form_error('acta');?></span>
				</div>
			</div>

			<div class="form-row mb-4">
				<!-- formato de fecha año/mes/dia, con calendario desplgable -->
				<div class="col-sm-4 col-12">
					<label for="fecha" class="control-label">Fecha</label>
					<div class="input-group">
						<input type="text" class="form-control mydatepicker" placeholder="dd/mm/yyyy" name="fecha" value="<?php echo $this->input->post('fecha'); ?>" id="fecha">
						<div class="input-group-append">
							<span class="input-group-text"><i class="fa fa-calendar"></i></span>
						</div>

					</div>
				</div>
			</div>
			<!-- botones para guardar o cancelar el agregar carrera -->
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-8">
					<button type="submit" class="btn btn-success">Guardar</button>
					<a href="<?=site_url('carrera/index'); ?>" class="btn btn-danger">Cancelar</a>
				</div>
			</div>
			
		</div>
	</div>
</div>

<?php echo form_close(); ?>
