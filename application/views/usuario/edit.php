<?php echo form_open('usuario/edit/'.$usuario['usuario_id'],array("class"=>"form-horizontal")); ?>

<div class="row">
	<div class="col-sm-6 col-12">
		<div class="card">
			<div class="card-body">

				<div class="form-group">
					<label for="activo" class="col-md-4 control-label">Estado activo</label>
					<?php $selected = ($this->input->post('activo') ? $this->input->post('activo') : $usuario['activo']); ?>
					<div class="col-md-8">
						<select class="form-control" name="activo" required>
							<option value="1"<?= ($selected=='1' ? ' selected="selected"' : '') ?>>Habilitado</option>
							<option value="0"<?= ($selected=='0' ? ' selected="selected"' : '') ?>>Deshabilitado</option>
						</select>
						<span class="text-danger"><?php echo form_error('activo');?></span>
					</div>
				</div>

				<div class="form-group">
					<label for="username" class="col-md-4 control-label">Username</label>
					<div class="col-md-8">
						<input type="text" name="username" required value="<?php echo ($this->input->post('username') ? $this->input->post('username') : $usuario['username']); ?>" class="form-control" id="username" />
						<span class="text-danger"><?php echo form_error('username');?></span>
					</div>
				</div>

				<div class="form-group">
					<label for="password" class="col-md-4 control-label">Password</label>
					<div class="col-md-8">
						<input type="password" name="password" value="" class="form-control" id="password" />
						<span class="text-danger"><?php echo form_error('password');?></span>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-success">Guardar</button>
						<a href="<?=site_url('usuario/index'); ?>" class="btn btn-danger">Cancelar</a>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<?php echo form_close(); ?>
