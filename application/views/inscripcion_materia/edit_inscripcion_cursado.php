<?php echo form_open('inscripcion_materia/edit_inscripcion_cursado/'.$inscripcion_materia['id'],array("class"=>"form-horizontal")); ?>

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
                  $selected = ($p['persona_id'] ==  $inscripcion_materia['id_persona']) ? ' selected="selected"' : "";

                echo '<option value="'.$p['persona_id'].'" '.$selected.'>'.$p['nombre'].' '.$p['apellido'].' ('.$p['numero_documento'].')</option>';
              }
              ?>
            </select>
            <span class="text-danger"><?php echo form_error('id_persona');?></span>
          </div>
        </div>


        <div class="form-group">
          <label class="control-label">Cursado de Materia</label>
          <div class="col-sm-8 col-12">
            <select class="select2 form-control custom-select" name="id_curso" required style="width: 100%; height:36px;">
              <option value="">Buscar</option>
              <?php
              foreach($all_cursos as $curso)
              {
                  $selected = ($curso['curso_id'] == $inscripcion_materia['id_curso']) ? ' selected="selected"' : "";

                  echo '<option value="'.$curso['curso_id'].'" '.$selected.'>'.$curso['nombre'].' ('.$curso['id_carrera'].')
                        </option>';

              }
              ?>
            </select>
            <span class="text-danger"><?php echo form_error('id_curso');?></span>
          </div>
        </div>






        <div class="form-group">
          <!-- botones para guardar o cancelar el agregar nivel -->
          <div class="col-sm-offset-4 col-sm-8">
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="<?=site_url('inscripcion_materia/index_inscripcion_cursado'); ?>" class="btn btn-danger">Cancelar</a>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<?php echo form_close(); ?>
