<?php if (!empty($relacion)): ?>
  <?php var_dump($relacion); ?>
<?php else: ?>
  <h5 class="text-secondary">No hay relaciones con esta persona.</h5>
<?php endif; ?>
<hr>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Agregar</h5>
        <?php echo form_open('persona_tutor/relacion/'.$persona['id'],array("class"=>"form-horizontal")); ?>
        <input type="hidden" name="id_persona" value="<?=$persona['id']; ?>">
        <div class="form-group">
          <label class="col-md-4">Persona encargada</label>
          <div class="col-md-4 col-12">
            <select class="select2 form-control custom-select" name="id_responsable" style="width: 100%; height:36px;">
              <option>Buscar</option>
              <?php
              foreach($personas as $p)
              {
                $selected = ($p['persona_id'] == $this->input->post('persona_id')) ? ' selected="selected"' : "";
                if ($p['persona_id']!=$persona['id']) {
                  echo '<option value="'.$p['persona_id'].'" '.$selected.'>'.$p['nombre'].' '.$p['apellido'].' ('.$p['numero_documento'].')</option>';
                }
              }
              ?>
            </select>
            <span class="text-danger"><?php echo form_error('persona_id');?></span>
          </div>
        </div>
        <div class="form-group">
          <label for="id_tutor" class="col-md-4 control-label">Tutor</label>
          <div class="col-md-4 col-12">
            <select name="id_tutor" class="form-control">
              <option value="">Tipo de tutor</option>
              <?php
              foreach($all_tutores as $tutor)
              {
                $selected = ($tutor['id'] == $this->input->post('id_tutor')) ? ' selected="selected"' : "";

                echo '<option value="'.$tutor['id'].'" '.$selected.'>'.$tutor['nombre'].'</option>';
              }
              ?>
            </select>
            <span class="text-danger"><?php echo form_error('id_tutor');?></span>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-8">
            <button type="submit" class="btn btn-success">Guardar</button>
          </div>
        </div>

        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
