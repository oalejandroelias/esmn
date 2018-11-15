<?php echo form_open('mesa/add',array("class"=>"form-horizontal")); ?>
<div class="row">
	<div class="col-md-8 col-12">
		<div class="card">
			<div class="card-body">

				<div class="form-row mb-3">
					<div class="col-sm-8 col-12">
						<label for="id_materia" class="control-label"><span class="text-danger">*</span>Materia / Plan</label>
						<select name="id_materia" class="select2 form-control custom-select" required style="width: 100%; height:36px;">
							<option value="">Buscar</option>
							<?php
							foreach($all_materias as $materia)
							{
								$selected = ($materia['materia_id'] == $this->input->post('id_materia')) ? ' selected="selected"' : "";

								echo '<option value="'.$materia['materia_id'].'" '.$selected.'>'.$materia['nombre_materia'].'</option>';
							}
							?>
						</select>
						<span class="text-danger"><?php echo form_error('id_materia');?></span>
					</div>
				</div>

				<div class="form-row mb-3">
					<div class="col-sm-4 col-12">
						<label for="fecha" class="control-label"><span class="text-danger">*</span>Fecha</label>
						<div class="input-group">
							<input type="text" name="fecha" class="form-control mydatepicker" required placeholder="dd/mm/yyyy" value="<?php echo $this->input->post('fecha'); ?>" id="fecha" />
							<div class="input-group-append">
								<span class="input-group-text"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
						<span class="text-danger"><?php echo form_error('fecha');?></span>
					</div>

					<div class="col-sm-4 col-12">
						<label for="hora" class="control-label"><span class="text-danger">*</span>Hora</label>
						<div class="input-group">
							<input type="text" name="hora" class="form-control timepicker" required placeholder="" value="<?php echo $this->input->post('hora'); ?>" id="hora" />
							<div class="input-group-append">
								<span class="input-group-text"><i class="fa fa-clock"></i></span>
							</div>
						</div>
						<span class="text-danger"><?php echo form_error('hora');?></span>
					</div>

				</div>

				<div class="form-row mb-3">
					<div class="col-sm-8 col-12">
						<label class="control-label"><span class="text-danger">*</span>Tribunal: <em class="text-secondary">seleccione las personas a cargo de la mesa</em></label>
						<select name="id_persona[]" class="select2 form-control m-t-15" multiple="multiple" required style="width: 100%; height:36px;">
							<option value="">Buscar</option>
							<?php
							foreach($personas as $p)
              {
								$selected = (is_array($this->input->post('id_persona')) && in_array($p['persona_id'],$this->input->post('id_persona'))) ? ' selected="selected"' : "";
									echo '<option value="'.$p['persona_id'].'" '.$selected.'>'.$p['nombre'].' '.$p['apellido'].' ('.$p['numero_documento'].')</option>';
              }
              ?>
							?>
						</select>
						<span class="text-danger"><?php echo form_error('id_persona[]');?></span>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-success">Guardar</button>
						<a href="<?=site_url('mesa/index'); ?>" class="btn btn-danger">Cancelar</a>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<?php echo form_close(); ?>
