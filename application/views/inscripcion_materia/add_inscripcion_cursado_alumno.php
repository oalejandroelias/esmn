<?php echo form_open('inscripcion_materia/add_inscripcion_cursado_alumno',array("class"=>"form-horizontal","onsubmit"=>"return sendForm(this)")); ?>

<div class="row">
  <div class="col-sm-6 col-12">
    <div class="card">
      <div class="card-body">

        <div class="form-group">
          <label class="control-label">Persona / Alumno</label>
          <div class="col-sm-8 col-12">
                 <select name="id_carrera" required class="form-control" onchange='this.form.submit()'>

            <?php
            foreach($carreras_inscripcion as $carrera)
            {
              $selected = ($carrera['id'] == $this->input->post('id_carrera')) ? ' selected="selected"' : "";

              echo '<option value="'.$carrera['id'].'" '.$selected.'>'.$carrera['nombre'].' ('.$carrera['id'].')</option>';
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
                $selected = ($curso['curso_id'] == $this->input->post('id_curso')) ? ' selected="selected"' : "";

                echo '<option value="'.$curso['curso_id'].'" '.$selected.' data-idmateria="'.$curso['id_materia'].'">'.$curso['materia_nombre'].' ('.$curso['id_carrera'].')
                </option>';
              }
              ?>
            </select>
            <span class="text-danger"><?php echo form_error('id_curso');?></span>
          </div>
          <input type="hidden" name="id_materia" value="">
          <input type="hidden" name="id_persona" value=<?php echo $this->session->userdata['persona_id'];?>>
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
