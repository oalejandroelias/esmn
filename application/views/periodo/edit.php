<?php echo form_open('periodo/edit/'.$periodo['id'],array("class"=>"form-horizontal")); ?>

<div class="row">
	<div class="col-md-8 col-12">
		<div class="card">
			<div class="card-body">

				<div class="form-row mb-4">
					<div class="col-sm-6 col-12">
						<label for="id_tipo_periodo" class="control-label"><span class="text-danger">*</span>Periodo</label>
						<select name="id_tipo_periodo" required class="form-control">
							<option value="">Seleccione un periodo</option>
							<?php
							foreach($all_tipo_periodo as $p)
							{
								$selected = ($p['id'] == $periodo['id_tipo_periodo']) ? ' selected="selected"' : "";

								echo '<option value="'.$p['id'].'" '.$selected.'>'.$p['descripcion'].'</option>';
							}
							?>
						</select>
						<span class="text-danger"><?php echo form_error('id_tipo_periodo');?></span>
					</div>
				</div>

				<div class="form-row mb-4">
					<div class="col-sm-6 col-12">
						<label for="desde" class="control-label">Desde</label>
						<div class="input-group">
							<input type="text" class="form-control mydatepicker mydatepicker-start" placeholder="dd/mm/yyyy" name="desde" required value="<?php echo ($this->input->post('desde') ? $this->input->post('desde') : date("d/m/Y", strtotime($periodo['desde']))); ?>" id="desde">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fa fa-calendar"></i></span>
							</div>

						</div>
					</div>
				</div>

				<div class="form-row mb-4">
					<div class="col-sm-6 col-12">
						<label for="hasta" class="control-label">Hasta</label>
						<div class="input-group">
							<input type="text" class="form-control mydatepicker mydatepicker-end" placeholder="dd/mm/yyyy" name="hasta" required value="<?php echo ($this->input->post('hasta') ? $this->input->post('hasta') : date("d/m/Y", strtotime($periodo['hasta']))); ?>" id="hasta">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-success">Guardar</button>
						<a href="<?=site_url('periodo/index'); ?>" class="btn btn-danger">Cancelar</a>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<?php echo form_close(); ?>
