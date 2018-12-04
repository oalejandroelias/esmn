<?php echo form_open('inscripcion_materia/inscripcion_equivalencia',array("class"=>"form-horizontal")); ?>

<div class="row">
  <div class="col-sm-6 col-12">
    <div class="card">
      <div class="card-body">

        <div class="form-group">
          <label class="control-label">Persona / Alumno</label>
          <div class="col-sm-8 col-12">
            <select class="select2 form-control custom-select" name="id_persona" style="width: 100%; height:36px;">
              <option value="">Buscar</option>
              <?php
              foreach($personas as $p)
              {
                $selected = ($p['persona_id'] == $this->input->post('id_persona')) ? ' selected="selected"' : "";

                echo '<option value="'.$p['persona_id'].'" '.$selected.'>'.$p['nombre'].' '.$p['apellido'].' ('.$p['numero_documento'].')</option>';
              }
              ?>
            </select>
            <span class="text-danger"><?php echo form_error('id_persona');?></span>
          </div>
        </div>


        <div class="form-group">
          <label class="control-label">Materias</label>
          <div class="col-sm-8 col-12">
            <select class="select2 form-control custom-select" name="id_materia" required style="width: 100%; height:36px;">
              <option value="">Buscar</option>
              <?php
              foreach($all_materias as $materia)
              {
                $selected = ($materia['materia_id'] == $this->input->post('id_materia')) ? ' selected="selected"' : "";

                echo '<option value="'.$materia['materia_id'].'" '.$selected.'">'.$materia['nombre_materia'].' ('.$materia['id_carrera'].')
                </option>';
              }
              ?>
            </select>
            <span class="text-danger" id="spanIdMateria"><?php echo form_error('id_materia');?></span>
          </div>
        </div>

        <div class="form-group d-none" id="divEquivalentes">
          <label class="control-label">Equivalentes</label>
          <div class="col-sm-8 col-12">
            <select class="form-control" name="id_equivalencia" required>
            </select>
            <span class="text-danger"><?php echo form_error('id_equivalencia');?></span>
          </div>
        </div>

        <div class="form-group">
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