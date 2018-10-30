<div class="row">
  <div class="col-sm-6 col-12">
    <div class="card">
      <div class="card-body">

        <?php if (!empty($relacion)): ?>
          <?php if ($relacion[0]->id_responsable == $persona['id']): ?>
            <h5><?= $persona['nombre'].' '.$persona['apellido'] ?> esta a cargo de:</h5>
            <div class="comment-widgets scrollable">

              <?php foreach ($relacion as $r): ?>
                <div class="d-flex flex-row comment-row">
                  <div class="p-2">
                    <img src="<?= ($r->foto_persona) ? $r->foto_persona : base_url('files/images/user.png') ?>" alt="user" class="rounded-circle" width="80">
                  </div>
                  <div class="comment-text w-100">
                    <h6 class="font-medium"><?= $r->nombre_persona.' '.$r->apellido_persona; ?></h6>

                    <?php foreach ($all_tipo_documento as $tipo_documento): ?>
                      <?php if ($tipo_documento['id'] == $r->id_tipo_documento_persona): ?>
                        <span class="m-b-15 d-block"><?= $tipo_documento['nombre'].' - '.$r->numero_documento_persona; ?></span>
                      <?php endif; ?>
                    <?php endforeach; ?>

                  </div>
                </div>
              <?php endforeach; ?>

            </div>
          <?php else: ?>
            <h5>Tutores / Encargados:</h5>
            <div class="comment-widgets scrollable">

              <?php foreach ($relacion as $r): ?>
                <div class="d-flex flex-row comment-row">
                  <div class="p-2">
                    <img src="<?= ($r->foto_responsable) ? $r->foto_responsable : base_url('files/images/user.png') ?>" alt="user" class="rounded-circle" width="80">
                  </div>
                  <div class="comment-text w-100">
                    <h6 class="font-medium"><?= $r->nombre_responsable.' '.$r->apellido_responsable; ?></h6>

                    <?php foreach ($all_tipo_documento as $tipo_documento): ?>
                      <?php if ($tipo_documento['id'] == $r->id_tipo_documento_responsable): ?>
                        <span class="m-b-15 d-block"><?= $tipo_documento['nombre'].' - '.$r->numero_documento_responsable; ?></span>
                      <?php endif; ?>
                    <?php endforeach; ?>

                    <div class="comment-footer">
                      <a href="<?php echo site_url('Persona/edit/'.$r->id_responsable); ?>" class="btn btn-info btn-sm">Ver</a>
                      <a href="<?php echo site_url('Persona_tutor/remove/'.$persona['id'].'/'.$r->id_responsable); ?>" data-confirm="remove" class="btn btn-danger btn-sm">Eliminar relacion</a>
                    </div>

                  </div>
                </div>
              <?php endforeach; ?>

            </div>

          <?php endif; ?>

        <?php else: ?>
          <h5 class="text-secondary">No hay relaciones con esta persona.</h5>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-6 col-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Agregar</h5>
        <?php echo form_open('persona_tutor/relacion/'.$persona['id'],array("class"=>"form-horizontal")); ?>
        <input type="hidden" name="id_persona" value="<?=$persona['id']; ?>">
        <div class="form-group">
          <label class="control-label">Persona encargada</label>
          <div class="col-sm-8 col-12">
            <select class="select2 form-control custom-select" name="id_responsable" style="width: 100%; height:36px;">
              <option value="">Buscar</option>
              <?php
              foreach($personas as $p)
              {
                $selected = ($p['persona_id'] == $this->input->post('id_responsable')) ? ' selected="selected"' : "";
                if ($p['persona_id']!=$persona['id']) {
                  echo '<option value="'.$p['persona_id'].'" '.$selected.'>'.$p['nombre'].' '.$p['apellido'].' ('.$p['numero_documento'].')</option>';
                }
              }
              ?>
            </select>
            <span class="text-danger"><?php echo form_error('id_responsable');?></span>
          </div>
        </div>
        <div class="form-group">
          <label for="id_tutor" class="control-label">Tutor</label>
          <div class="col-sm-8 col-12">
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
            <a href="<?=site_url('persona/index'); ?>" class="btn btn-danger">Volver</a>
          </div>
        </div>

        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
