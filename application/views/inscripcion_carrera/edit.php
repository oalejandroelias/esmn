<?php echo form_open('inscripcion_carrera/edit/'.$inscripcion_carrera['id_persona'].'/'.$inscripcion_carrera['id_carrera'],array("class"=>"form-horizontal")); ?>

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
                $selected = ($p['persona_id'] == $inscripcion_carrera['id_persona']) ? ' selected="selected"' : "";

                echo '<option value="'.$p['persona_id'].'" '.$selected.'>'.$p['nombre'].' '.$p['apellido'].' ('.$p['numero_documento'].')</option>';
              }
              ?>
            </select>
            <span class="text-danger"><?php echo form_error('id_persona');?></span>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label">Carrera / Plan</label>
          <div class="col-sm-8 col-12">
            <select class="select2 form-control custom-select" name="id_carrera" required style="width: 100%; height:36px;">
              <option value="">Buscar</option>
              <?php
              foreach($all_carreras as $c)
              {
                $selected = ($c['carrera_id'] == $inscripcion_carrera['id_carrera']) ? ' selected="selected"' : "";

                echo '<option value="'.$c['carrera_id'].'" '.$selected.'>'.$c['carrera_nombre'].' ('.$c['carrera_id'].')</option>';
              }
              ?>
            </select>
            <span class="text-danger"><?php echo form_error('id_carrera');?></span>
          </div>
        </div>

        <div class="form-group">
          <!-- botones para guardar o cancelar el agregar nivel -->
          <div class="col-sm-offset-4 col-sm-8">
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="<?=site_url('inscripcion_carrera/index'); ?>" class="btn btn-danger">Cancelar</a>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<?php echo form_close(); ?>
