<?php echo form_open('mesa/edit/'.$mesa['id_mesa'],array("class"=>"form-horizontal")); ?>
<div class="row">
	<div class="col-md-8 col-12">
		<div class="card">
			<div class="card-body">

				<div class="form-group">
					<div class="col-sm-8 col-12">
					<label class="control-label"><span class="text-danger">*</span>Materia / Plan</label>
						<select name="id_materia" class="select2 form-control custom-select" required style="width: 100%; height:36px;">
							<option value="">Buscar</option>
							<?php
							foreach($all_materias as $materia)
							{
								$selected = ($materia['materia_id'] == $mesa['id_materia']) ? ' selected="selected"' : "";

								echo '<option value="'.$materia['materia_id'].'" '.$selected.'>'.$materia['nombre_materia'].'</option>';
							}
							?>
						</select>
						<span class="text-danger"><?php echo form_error('id_materia');?></span>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-8 col-12">
						<label for="fecha" class="control-label"><span class="text-danger">*</span>Fecha</label>
						<div class="input-group">
							<input type="text" class="form-control mydatepicker" placeholder="dd/mm/yyyy" name="fecha" value="<?php echo ($this->input->post('fecha') ? $this->input->post('fecha') : date("d/m/Y", strtotime($mesa['fecha']))); ?>" id="fecha">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fa fa-calendar"></i></span>
							</div>
							<span class="text-danger"><?php echo form_error('fecha');?></span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-success">Guardar</button>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>
