<?php echo form_open('perfil/edit_permission/'.$perfil['id'],array("class"=>"form-horizontal")); ?>
<div class="row">

  <?php foreach ($permisos as $class => $methods): ?>
    <div class="col-12 col-sm-6 col-md-4">
      <div class="card">
        <div class="card-body">
          <div class="form-group row">
            <label class="col-md-3"><?=$class; ?></label>
            <div class="col-md-9">
              <?php $x=1; ?>
              <?php foreach ($permisos[$class] as $method => $value): ?>
                <!-- $value corresponde al valor de checked -->
                <div class="custom-control custom-checkbox mr-sm-2">
                  <input class="custom-control-input" name="permisos[<?=$class; ?>][<?=$method; ?>]"
                    id="customControlAutosizing<?=$class.$x;?>" type="checkbox" value="1" <?= $value; ?>>
                  <label class="custom-control-label" for="customControlAutosizing<?=$class.$x;?>"><?=$method; ?></label>
                </div>
                <?php $x++; ?>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>

    </div>
  <?php endforeach; ?>
</div>
<div class="form-group">
  <div class="col-sm-offset-4 col-sm-8">
    <button type="submit" class="btn btn-success">Guardar</button>
    <button type="submit" formaction="index" class="btn btn-danger">Cancelar</button>
  </div>
</div>
<?php echo form_close(); ?>
