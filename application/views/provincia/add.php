<div class="row">
	<div class="col-6">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title"><?=$page_title?></h5>
				<?php echo form_open('provincia/add',array("class"=>"form-horizontal")); ?>

				<div class="form-group">
					<label for="nombre" class="col-md-4 control-label"><span class="text-danger">*</span>Nombre</label>
					<div class="col-md-8">
						<input type="text" name="nombre" value="<?php echo $this->input->post('nombre'); ?>" class="form-control" id="nombre" required/>
						<span class="text-danger"><?php echo form_error('nombre');?></span>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-success">Save</button>
					</div>
				</div>

				<?php echo form_close(); ?>
			</div>

		</div>
	</div>

</div>
