<?php echo form_open('estado_cursado/add',array("class"=>"form-horizontal")); ?>

<div class="row">
	<div class="col-sm-6 col-12">
		<div class="card">
			<div class="card-body">

				<div class="form-group">
					<label for="nombre" class="col-md-4 control-label"><span class="text-danger">*</span>Nombre</label>
					<div class="col-md-8">
						<input type="text" name="nombre" required value="<?php echo $this->input->post('nombre'); ?>" class="form-control" id="nombre" />
						<span class="text-danger"><?php echo form_error('nombre');?></span>
					</div>
				</div>
				<div class="form-group">
					<label for="nomenclatura" class="col-md-4 control-label">Nomenclatura</label>
					<div class="col-md-8">
						<input type="text" name="nomenclatura" value="<?php echo $this->input->post('nomenclatura'); ?>" class="form-control" id="nomenclatura" />
						<span class="text-danger"><?php echo form_error('nomenclatura');?></span>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-success">Guardar</button>
						<a href="<?=site_url('estado_cursado/index'); ?>" class="btn btn-danger">Cancelar</a>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<?php echo form_close(); ?>