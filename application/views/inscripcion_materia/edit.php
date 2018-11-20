<?php echo form_open('inscripcion_materia/edit/'.$inscripcion_materia['id'],array("class"=>"form-horizontal")); ?>

<div class="row">
  <div class="col-sm-6 col-12">
    <div class="card">
      <div class="card-body">

        <div class="form-group">
          <label class="control-label">Persona / Alumno</label>
          <div class="col-sm-8 col-12">
            <select class="select2 form-control custom-select" name="id_persona" required style="width: 100%; height:36px;">
              <option value="">Buscar</option>
              <?php
              foreach($personas as $p)
              {
                  $selected = ($p['persona_id'] == $inscripcion_materia['id_persona']) ? ' selected="selected"' : "";

                echo '<option value="'.$p['persona_id'].'" '.$selected.'>'.$p['nombre'].' '.$p['apellido'].' ('.$p['numero_documento'].')</option>';
              }
              ?>
            </select>
            <span class="text-danger"><?php echo form_error('id_persona');?></span>
          </div>
        </div>

       <!--   <div class="form-group">
          <label class="control-label">Materia / Plan</label>
          <div class="col-sm-8 col-12">
            <select class="select2 form-control custom-select" name="id_materia" required style="width: 100%; height:36px;">
              <option value="">Buscar</option>
              <?php
              foreach($all_materias as $materia)
              {
                  $selected = ($materia['materia_id'] == $inscripcion_materia['id_materia']) ? ' selected="selected"' : "";

                echo '<option value="'.$materia['materia_id'].'" '.$selected.'>'.$materia['nombre_materia'].' ('.$materia['id_carrera'].')</option>';
              }
              ?>
            </select>
            <span class="text-danger"><?php echo form_error('id_materia');?></span>
          </div>
        </div>-->
        
        <div class="form-group">
          <label class="control-label">Mesa</label>
          <div class="col-sm-8 col-12">
            <select class="select2 form-control custom-select" name="id_mesa" required style="width: 100%; height:36px;">
              <option value="">Buscar</option>
              <?php
              foreach($all_mesas as $mesa)
              {
                  $selected = ($mesa['id_mesa'] == $inscripcion_materia['id_materia']) ? ' selected="selected"' : "";

                  echo '<option value="'.$mesa['id_mesa'].'" '.$selected.'>'.$mesa['nombre_materia'].' ('.$mesa['materia'].')</option>';
              }
              ?>
            </select>
            <span class="text-danger"><?php echo form_error('id_materia');?></span>
          </div>
        </div>
        
        <div class="form-group">
          <label class="control-label">Estado</label>
          <div class="col-sm-8 col-12">
            <select class="select2 form-control custom-select" name="id_estado_inicial" required style="width: 100%; height:36px;">
              <option value="">Buscar</option>
              <?php
              foreach($all_estados as $estado)
              {
                  $selected = ($estado['id'] == $inscripcion_materia['id_estado_inicial']) ? ' selected="selected"' : "";

                  echo '<option value="'.$estado['id'].'" '.$selected.'>'.$estado['nombre'].'</option>';
              }
              ?>
            </select>
            <span class="text-danger"><?php echo form_error('id_estado_inicial');?></span>
          </div>
        </div>

        <div class="form-group">
          <!-- botones para guardar o cancelar el agregar nivel -->
          <div class="col-sm-offset-4 col-sm-8">
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="<?=site_url('inscripcion_materia/index'); ?>" class="btn btn-danger">Cancelar</a>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<?php echo form_close(); ?>

