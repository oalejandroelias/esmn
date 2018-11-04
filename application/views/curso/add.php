<!-- esta vista permite agregar codigo de plan, nivel, nombre acta y fecha -->
<?php echo form_open('curso/add',array("class"=>"form-horizontal")); ?>

<div class="row">
	<div class="col-sm-8 col-12">
		<div class="card">
			<div class="card-body">

				<div class="form-row mb-4">

					<div class="col-sm-6 col-12">
						<label for="id_materia" class="control-label"><span class="text-danger">*</span>Carrera	</label>
						<select name="id_materia" required class="form-control">
							<option value="">Seleccione una carrera</option>
							<?php
							foreach($all_carreras as $carrera)
							{
							    $selected = ($carrera['carrera_id'] == $this->input->post('carrera_id')) ? ' selected="selected"' : "";

							    echo '<option value="'.$carrera['id'].'" '.$selected.'>'.$carrera['carrera_nombre'].' - '.$carrera['carrera_id'].'</option>';
							}
							?>
						</select>
						<span class="text-danger"><?php echo form_error('id_carrera');?></span>
					</div>

					<div class="col-sm-6 col-12">
						<label for="id_materia" class="control-label"><span class="text-danger">*</span>Materia</label>
						<select name="id_materia" required class="form-control">
							<option value="">Seleccione una materia</option>
							<?php
							foreach($all_materias as $materia)
							{
								$selected = ($materia['materia_id'] == $this->input->post('id_materia')) ? ' selected="selected"' : "";

								echo '<option value="'.$materia['materia_id'].'" '.$selected.'>'.$materia['nombre_materia'].' - '.$materia['id_carrera'].'</option>';
							}
							?>
						</select>
						<span class="text-danger"><?php echo form_error('id_materia');?></span>
					</div>
				</div>

				<div class="form-row mb-4">
					<!-- formato de fecha año/mes/dia, con calendario desplgable -->
					<div class="col-sm-6 col-12">
						<label for="fecha" class="control-label">Desde</label>
						<div class="input-group">
							<input type="text" class="form-control mydatepicker mydatepicker-start" placeholder="dd/mm/yyyy" name="fecha" value="<?php echo $this->input->post('fecha'); ?>" id="fecha">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fa fa-calendar"></i></span>
							</div>

						</div>
					</div>
					<div class="col-sm-6 col-12">
						<label for="fecha" class="control-label">Hasta</label>
						<div class="input-group">
							<input type="text" class="form-control mydatepicker mydatepicker-end" placeholder="dd/mm/yyyy" name="fecha" value="<?php echo $this->input->post('fecha'); ?>" id="fecha">
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
</div>

<?php echo form_close(); ?>
