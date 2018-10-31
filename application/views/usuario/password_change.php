<div class="row">
  <div class="col-sm-6 col-12 m-auto">
    <div class="card">
      <div class="card-header border-bottom bg-cyan text-white">
        <h5 class="card-title">Cambiar contraseña</h5>
      </div>
      <div class="card-body">
        <?php echo form_open('usuario/password_change/'.$usuario['usuario_id'],array("class"=>"form-horizontal","onsubmit"=>"return validar_form();")); ?>

        <div class="form-group">
          <label for="actual_password" class="control-label"><span class="text-danger">*</span>Contraseña Actual</label>
          <div class="col-12">
            <input type="password" name="actual_password" value="" required placeholder="Ingrese su contraseña actual" class="form-control" id="actual_password" />
            <span class="text-danger"><?php echo form_error('actual_password');?></span>
          </div>
        </div>

        <div class="form-group">
          <label for="new_password" class="control-label"><span class="text-danger">*</span>Nueva Contraseña</label>
          <div class="col-12">
            <input type="password" name="new_password" value="" required placeholder="Ingrese la nueva contraseña" class="form-control" id="new_password" />
            <span class="text-danger"><?php echo form_error('password');?></span>
          </div>
        </div>

        <div class="form-group">
          <label for="repeat_new_password" class="control-label"><span class="text-danger">*</span>Repetir Nueva Contraseña</label>
          <div class="col-12">
            <input type="password" name="repeat_new_password" value="" required placeholder="Ingrese nuevamente la nueva contraseña" class="form-control" id="repeat_new_password" />
            <span class="text-danger"><?php echo form_error('repeat_new_password');?></span>
          </div>
        </div>

        <div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-success">Guardar</button>
						<a href="<?=site_url('perfil_usuario/index/').$usuario['usuario_id']; ?>" class="btn btn-danger">Cancelar</a>
					</div>
				</div>

        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
