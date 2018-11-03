<div class="row">
	<div class="col-sm-6 col-12">
		<div class="card">
			<div class="card-body">
				<?php echo form_open('tipo_periodo/edit/'.$tipo_periodo['id'],array("class"=>"form-horizontal")); ?>

				<div class="form-group">
					<label for="descripcion" class="col-md-4 control-label"><span class="text-danger">*</span>Nombre</label>
					<div class="col-md-8">
						<input type="text" name="descripcion" value="<?php echo ($this->input->post('descripcion') ? $this->input->post('descripcion') : $tipo_periodo['descripcion']); ?>" class="form-control" id="descripcion" />
						<span class="text-danger"><?php echo form_error('descripcion');?></span>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-success">Guardar</button>
						<a href="<?=site_url('tipo_periodo/index'); ?>" class="btn btn-danger">Cancelar</a>
					</div>
				</div>

				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
