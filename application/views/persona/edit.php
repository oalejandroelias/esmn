<?php echo form_open_multipart('persona/edit/'.$persona['id'],array("class"=>"form-horizontal","onsubmit"=>"return validar_form(this);")); ?>

<?php 
    $marker = array();
    $coordenadas_direccion = array();
    
    
    $coordenadas_direccion= $this->googlemaps->get_lat_long_from_address($persona['domicilio']);
    
    $marker['position'] = $coordenadas_direccion[0].', '.$coordenadas_direccion[1];
    //$marker['position'] = '-68.0575352 , -38.9419357' ;
    $marker['draggable'] = true;
    $marker['ondragend'] = 'guardar_coordenadas(event.latLng.lat(), event.latLng.lng());';
    
    
    
    $this->googlemaps->add_marker($marker);
    $mapa = $this->googlemaps->create_map();
    echo $mapa['js'];
    $mapa_mostrar = '<label class="col-sm-3 control-label"><b>Ubicación</b></label><i>Puede arrastrar el marcador para posicionar exactamente la ubicación</i>' . $mapa['html'];
    
    ?>
        
        <script>
       	var datos_mapa='<?php echo $mapa_mostrar;?>';
        </script>

<fieldset>

  <div class="row">
    <div class="col-md-3 col-12">
      <div class="card" style="max-width:250px;max-height:250px">
        <div class="card text-center">
          <div class="card-header bg-cyan text-white">
            Foto de perfil
          </div>
          <img class="card-img-top" id="img_foto_perfil" src="<?= ($persona['foto'] == '') ? base_url('files/images/user.png') : $persona['foto'] ?>" alt="Foto perfil">
          <div class="card-body" id=card_foto_perfil>
            <label class="btn btn-primary">
              <input type="file" name="foto_perfil" accept="image/*"/>
              <i class="fa fa-upload"></i> Subir foto
            </label>
            <span class="form-text text-danger"><?= $this->upload->display_errors(); ?></span>
            <!-- <?php echo $this->upload->display_errors('<span class="form-text text-danger">', '</span>'); ?> -->
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-8 col-12">
      <div class="card">
        <div class="card-body">
          <div class="form-row mb-3">
            <div class="col-sm-6 col-12">
              <label for="id_tipo_documento" class="control-label"><span class="text-danger">*</span>Tipo Documento</label>
              <select name="id_tipo_documento" required class="form-control">
                <option value="">Seleccionar tipo de documento</option>
                <?php
                foreach($all_tipo_documento as $tipo_documento)
                {
                  $selected = ($tipo_documento['id'] == $persona['id_tipo_documento']) ? ' selected="selected"' : "";

                  echo '<option value="'.$tipo_documento['id'].'" '.$selected.'>'.$tipo_documento['nombre'].'</option>';
                }
                ?>
              </select>
              <span class="text-danger"><?php echo form_error('id_tipo_documento');?></span>
            </div>
            <div class="col-sm-6 col-12">
              <label for="numero_documento" class="control-label"><span class="text-danger">*</span>Numero Documento</label>
              <input type="number" min="0" maxlength="11" name="numero_documento" required value="<?php echo ($this->input->post('numero_documento') ? $this->input->post('numero_documento') : $persona['numero_documento']); ?>" class="form-control" id="numero_documento" />
              <span class="text-danger"><?php echo form_error('numero_documento');?></span>
            </div>
          </div>

          <div class="form-row mb-3">
            <div class="col-sm-6 col-12">
              <label for="nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
              <input type="text" maxlength="128" name="nombre" required value="<?php echo ($this->input->post('nombre') ? $this->input->post('nombre') : $persona['nombre']); ?>" class="form-control" id="nombre" />
              <span class="text-danger"><?php echo form_error('nombre');?></span>
            </div>
            <div class="col-sm-6 col-12">
              <label for="apellido" class="control-label"><span class="text-danger">*</span>Apellido</label>
              <input type="text" maxlength="128" name="apellido" required value="<?php echo ($this->input->post('apellido') ? $this->input->post('apellido') : $persona['apellido']); ?>" class="form-control" id="apellido" />
              <span class="text-danger"><?php echo form_error('apellido');?></span>
            </div>
          </div>

          <div class="form-row mb-3">
            <div class="col-sm-6 col-12">
              <label for="id_ciudad" class="control-label">Ciudad</label>
              <select name="id_ciudad" class="form-control">
                <option value="">Seleccionar Ciudad</option>
                <?php
                foreach($all_ciudades as $ciudad)
                {
                  $selected = ($ciudad['ciudad_id'] == $persona['id_ciudad']) ? ' selected="selected"' : "";

                  echo '<option value="'.$ciudad['ciudad_id'].'" '.$selected.'>'.$ciudad['ciudad'].'</option>';
                }
                ?>
              </select>
              <span class="text-danger"><?php echo form_error('id_ciudad');?></span>
            </div>
            <div class="col-sm-6 col-12">
              <label for="domicilio" class="control-label">Domicilio</label>
              <input type="text" maxlength="128" id="field-PER_CALLE" name="domicilio" value="<?php echo ($this->input->post('domicilio') ? $this->input->post('domicilio') : $persona['domicilio']); ?>" class="form-control" id="domicilio" />
              <span class="text-danger"><?php echo form_error('domicilio');?></span>
            </div>
          </div>

          <div class="form-row mb-3">
            <div class="col-sm-6 col-12">
              <label for="telefono" class="control-label">Telefono</label>
              <input type="text" maxlength="128" name="telefono" value="<?php echo ($this->input->post('telefono') ? $this->input->post('telefono') : $persona['telefono']); ?>" class="form-control" id="telefono" />
              <span class="text-danger"><?php echo form_error('telefono');?></span>
            </div>
            <div class="col-sm-6 col-12">
              <label for="email" class="control-label">Email</label>
              <input type="email" maxlength="128" name="email" value="<?php echo ($this->input->post('email') ? $this->input->post('email') : $persona['email']); ?>" class="form-control" id="email" />
              <span class="text-danger"><?php echo form_error('email');?></span>
            </div>
          </div>

          <label for="fecha" class="control-label"><span class="text-danger">*</span>Fecha de Nacimiento</label>
          <div class="form-row mb-3">
            <div class="col-12">
              <input type="text" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo ($this->input->post('fecha_nacimiento') ? $this->input->post('fecha_nacimiento') : $persona['fecha_nacimiento']); ?>"/> 
              <span class="text-danger d-none" data-error="fecha_nacimiento">Complete los datos de fecha de nacimiento.</span>
            </div>
          </div>
          
<!--           <div class="form-row mb-3 d-none" id="formdiv_usuario"> -->
<!-- 					<div class="col-sm-6 col-12"> -->
<!-- 						<label for="username" class="control-label"><span class="text-danger">*</span>Nombre de usuario</label> -->
<!--						<input type="text" maxlength="128" name="username" value="<?php echo $this->input->post('username') ? $this->input->post('username') : $usuario[0]['username']; ?>"  class="form-control" id="username" /> -->
<!--						<span class="text-danger"><?php echo form_error('username');?></span>
<!-- 					</div> -->

<!-- 					<div class="col-sm-6 col-12"> -->
<!-- 						<label for="password" class="control-label"><span class="text-danger">*</span>ContraseÃ±a</label> -->
<!--						<input type="password" maxlength="128" name="password" value="<?php echo $this->input->post('password') ? $this->input->post('password') : $usuario[0]['password']; ?>" class="form-control" id="password" />  -->
<!--						<span class="text-danger"><?php echo form_error('password');?></span>
<!-- 					</div> -->
<!-- 				</div> -->

<!-- 				<div class="form-row mb-4 d-none" id="formdiv_permisos"> -->
<!-- 					<div class="col-sm-6 col-12"> -->
<!-- 						<label for="id_ciudad" class="control-label"><span class="text-danger">*</span>Asignar permisos de</label> -->
<!-- 						<select name="id_perfil" class="form-control"> -->
<!-- 							<option value="">Seleccionar Rol</option> -->
							<?php
// 							foreach($all_roles as $rol)
// 							{
// 								$selected = ($rol['id'] == $this->input->post('id_perfil')) ? ' selected="selected"' : "";

// 								echo '<option value="'.$rol['id'].'" '.$selected.'>'.$rol['nombre'].'</option>';
// 							}
// 							?>
<!-- 						</select> -->
<!--						<span class="text-danger"><?php echo form_error('id_perfil');?></span>
<!-- 					</div> -->
<!-- 				</div> -->

				<div class="form-group">
					<label class="col-md-12"></label>
					<div class="col-md-12" id="tabla_mapa">
						
					</div>
				</div>

          <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" class="btn btn-success">Guardar</button>
              <a href="<?=site_url('persona/index'); ?>" class="btn btn-danger">Cancelar</a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</fieldset>

<?php echo form_close(); ?>
